<?php

session_start();

            
$code = '';
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
    
    require "config/conne.php";
}
if(!isset($user_id)) {
    header('location:login.php');
    exit();
}
if (isset($_SESSION['code'])) {
    $code = $_SESSION['code'];
    unset($_SESSION['code']);
}
if (!isset($_SESSION['code']) && isset($_POST['searchcode'])) {
    $precode = filter_var($_POST['inputcode'], FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = $dbcon->prepare("SELECT * FROM `work_request` WHERE `work_code` = ?");
    $sql->execute([$precode]);
    if ($sql->rowCount() < 1) {
        echo '<script>alert("Wrong Code, Check the code and try again")</script>';
    }else {

        $sql2 = $dbcon->prepare("SELECT * FROM `customer_payment_details` WHERE `work_code` = ?");
        $sql2->execute([$precode]);
        if ($sql2->rowCount() < 1) {
            $code = filter_var($_POST['inputcode'], FILTER_SANITIZE_SPECIAL_CHARS);
        }else

            echo '<script>alert("This transaction has already been carried out")</script>';
        
    }
    
}
    
   

if (empty($code)) {
    
}  

    $sql = $dbcon->prepare("SELECT * FROM `work_request` LEFT JOIN users ON users.id = requestor_id WHERE `work_code` = ?");
    $sql->execute([$code]);
    $info = $sql->fetch(PDO::FETCH_ASSOC);

 
?>

<?php include "require/header.php"; ?>


<body>
    <div class="categorieshead">
            <h5>Process Payment</h5>
    </div>
    <section class="categories form-container">
              <form action="" method="post" class="smallform">
                <p>Transaction code</p>
                <input type="text" name="inputcode" class="box" id="cname" placeholder="Enter code" required value="<?php if(isset($info['work_code'])){ echo $info['work_code'] ;} ?>">
                <input type="submit" value="Retrieve Info" name="searchcode" class="btn">
             </form>

            <form action="" method="post" enctype="multipart/form-data" id="paymentForm">

               <h3>Payment details</h3>
               
               <p>Firstname</p>
               <input type="text" name="Firstname" class="box" id="fname" required value="<?php if(isset($info['firstname'])){ echo $info['firstname'] ;} ?>">
               <p>Lastname</p>
               <input type="text" name="Lastname" class="box" id="lname" required value="<?php if(isset($info['lastname'])){ echo $info['lastname'] ;} ?>">
               <p>Email</p>
               <input type="email" name="email" id="email" class="box"  value="<?php if(isset($info['email'])){ echo $info['email'] ;} ?>">
               <p>Amount</p>
               <input type="number" name="" id="amount" class="box" required placeholder="Enter the amount">
               <p>Description</p> 
               <textarea type="text" name="workdesc" id="" class="box" required cols="48" rows="3"><?php if(isset($info['requestor_workdesc'])){ echo $info['requestor_workdesc'] ;} ?></textarea>
    
               <input type="submit" class="btn" name="request" value="Pay" onclick="payWithPaystack()">
            </form>
         
        </section>

        <script src="https://js.paystack.co/v1/inline.js"></script> 
         <script src="assets\js\payment.js"></script>
</body>

http://localhost/gokatsite/success.php?status=success