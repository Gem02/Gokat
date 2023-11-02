<?php

session_start();
            
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
}
if(!isset($user_id)) {
    header('location:login.php');
    exit();
}
if (!isset($_GET['user'])) {
    header('location:index.php');
}
    require "config/conne.php";
    $select_category = $dbcon->prepare("SELECT * FROM categories");
    $select_category->execute();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request'])) {
        $scale = filter_var($_POST["scale"], FILTER_SANITIZE_SPECIAL_CHARS);
        $category = filter_var($_POST["category"], FILTER_SANITIZE_SPECIAL_CHARS);
        $fullname = filter_var($_POST["fullname"], FILTER_SANITIZE_SPECIAL_CHARS);
        $phoneno = filter_var($_POST["phoneno"], FILTER_SANITIZE_NUMBER_INT);
        $phoneno2 = filter_var($_POST["phoneno2"], FILTER_SANITIZE_NUMBER_INT);
        $address = filter_var($_POST["address"], FILTER_SANITIZE_SPECIAL_CHARS);
        $work_desc = filter_var($_POST["workdesc"], FILTER_SANITIZE_SPECIAL_CHARS);
        $worker_id = filter_var($_POST["worker_id"], FILTER_SANITIZE_SPECIAL_CHARS);
        $worker_name = filter_var($_POST["worker_name"], FILTER_SANITIZE_SPECIAL_CHARS);
    
        $generator = "QWERTYUIOPASDFGHJKLZXCVBNM0987654321";
        $work_code = substr(str_shuffle($generator), 0, 8);
        $image_added = false;
        if (!empty($_FILES['image']['name'])) {
            $folder = 'samplespics/';
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
                
            }
            $image = $folder.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
            $image_added = true;
            $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
            
        }
        if ($image_added == true) {
            $request_work = $dbcon->prepare("INSERT INTO work_request (work_code, requestor_id, worker_id, worker_name, requestor_name, requestor_phoneno, requestor_phoneno2, requestor_address, requestor_workdesc, scale, category, work_samplepic) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
            $request_work->execute([$work_code, $user_id, $worker_id, $worker_name, $fullname, $phoneno, $phoneno2, $address, $work_desc, $scale, $category, $image]);
            $_SESSION['code'] = $work_code;
            include "requestpop.php" ;
        }else {
            $request_work = $dbcon->prepare("INSERT INTO work_request (work_code, requestor_id, worker_id, worker_name, requestor_name, requestor_phoneno, requestor_phoneno2, requestor_address, requestor_workdesc, scale, category) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
            $request_work->execute([$work_code, $user_id, $worker_id, $worker_name, $fullname, $phoneno, $phoneno2, $address, $work_desc, $scale, $category]);
            $_SESSION['code'] = $work_code;
            include "requestpop.php" ;
        }
        
    }
    
    include "require/header.php";
?>

<body>

    <section class="requestwork">
        <h1 class="heading">Request Work</h1>
        <div class="requestcon">
            <div class="requestnote">
                <h2>YOU ARE ABOUT TO REQUEST A WORK FROM </h2>
                <?php 
                    $stmt = $dbcon->prepare("SELECT * FROM users WHERE id=?");
                    $stmt->execute([$_GET['user']]);
                    if ($stmt->rowCount() == 0) {
                        echo 'SORRY THIS USER IS CURRENTLY NOT AVAILABLE';
                        die();
                    }else {
                        $worker = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                ?>
                <div class="workerinfo">
                    <div class="image">
                        <img src="<?= $worker['image'] ?>" alt="" >
                    </div>
                    <P class="name"><strong><?= $worker['firstname'].'  '.$worker['lastname'] ?></strong></P>
                    <P class="title"><?= $worker['work'] ?></P>
                    <P class="phone"><?= $worker['phone'] ?></P>
                    <p class="address"><strong>Address: </strong><?= $worker['address'] ?></p>
                    <p class="desc"><?= $worker['description'] ?></p>
                </div>
                
            </div>
            <div class="requestform">
                <p>PLEASE TELL US ABOUT THE WORK</p>
                <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="worker_id" value="<?= $worker['id'] ?>">
                        <input type="hidden" name="worker_name" value="<?= $worker['firstname'].'  '.$worker['lastname'] ?>">
                    <select name="scale" id="" required class="scales">
                        <option name="" id="" selected disabled>--Choose the scale of work--</option>
                        <option value="Small Scale">Small Scale work</option>
                        <option value="Medium Scale">Medium Scale work</option>
                        <option value="Large Scale">Large Scale work</option>
                    </select>

                    <select name="category" class="scales" required>
                    <option value="" selected disabled>--Select category--</option>
                    <?php 
                        while ($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)) {
                    ?>    <option value="<?= $fetch_category['title']?>"><?= $fetch_category['title']?></option>
      <?php
                    }
                    ?>
                    
                </select>
                    <div class="inputholder">
                        <input type="text" name="fullname" id="" required placeholder="Enter fullname">
                        <input type="tel" name="phoneno" id="" required placeholder="Enter Phone number">
                    </div>
                    <div class="inputholder">
                        <input type="tel" name="phoneno2" id=""  placeholder="Second Phone number">
                        <input type="text" name="address" id="" required placeholder="Enter full address">
                    </div>
                    
                    <textarea type="text" name="workdesc" id="" required placeholder="Describe the work" maxlength="1000" cols="30" rows="3"></textarea>
                    <div class="inputimage">
                        <span>DO YOU HAVE A SAMPLE OF THE WORK?</span>
                        <input type="file" name="image">
                    </div>
                    
                    <div>
                        <button type="submit" class="submit" name="request">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        
    </section>
</body>