<?php

session_start();
            
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
}
if(!isset($user_id)) {
    header('location:login.php');
    exit();
}

    require "config/conne.php";
    $select_user = $dbcon->prepare("SELECT * FROM users WHERE id = ?");
    $select_user->execute([$user_id]);
    $userinfo = $select_user->fetch(PDO::FETCH_ASSOC);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatemyprofile'])) {



        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
        $work = filter_var($_POST['work'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);


        $image_added = false;
        if (!empty($_FILES['image']['name'] && $_FILES['image']['error'] == 0)) {
            $folder = 'uploads/';
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
                
            }
            $image = $folder.time().'_'.mt_rand().'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
            $image_added = true;
            $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
            
        }
        if ($image_added == true) {
            $update_image = $dbcon->prepare("UPDATE users SET image = ? WHERE id = ?");
            $update_image->execute([$image, $user_id]);
        }
        
        if(!empty($phone)){
            $check_no = $dbcon->prepare("SELECT * FROM users WHERE phone = ?");
            $check_no->execute([$phone]);
            if ($check_no->rowCount() > 0) {
                //show = email already taken;
            }else{
                $update_no = $dbcon->prepare("UPDATE users SET phone = ? WHERE id = ?");
                $update_no->execute([$phone, $userinfo['id']]);
            }
        }

        if (!empty($description)) {
            $update_description = $dbcon->prepare("UPDATE users SET description = ? WHERE id = ?");
            $update_description->execute([$description, $userinfo['id']]);
         }

         if (!empty($work)) {
            $update_about = $dbcon->prepare("UPDATE users SET work = ? WHERE id = ?");
            $update_about->execute([$work, $userinfo['id']]);
         }

         if(!empty($email)){
            $check_email = $dbcon->prepare("SELECT * FROM users WHERE email = ?");
            $check_email->execute([$email]);
         }
            if ($check_email->rowCount() > 0) {
                //show = email already taken;
            }else{
                $update_email = $dbcon->prepare("UPDATE users SET email = ? WHERE id = ?");
                $update_email->execute([$email, $userinfo['id']]);

            }

            header('location:profile.php');
            exit();
            
         }

         
        

?>

<body>
    <?php include "require/header.php"; ?>
        <div class="categorieshead">
            <h5>UPDATE DATA</h5>
        </div>
        <section class="registerpage update">
            <form action="" class="form" method="post" autocomplete="ON" enctype="multipart/form-data">

                
                 <span> 
                       
                            <div class="alert alert-success">
                                
                            </div>

                  
                            <div class="alert alert-danger">
                               
                            </div>
                   
                 </span>
                
                <div class="form-area">
                   
                    <div class="reginfo contactinfo">
                        <h5>EDIT CONTACT INFORMATION</h5>

                        <div class="eachinput">
                            <label for="phone">Update Phone Number</label>
                            <input type="tel" name="phone" id="phone" placeholder="Edit Phone No" maxlength="30"
                            value="<?=$userinfo['phone']; ?>">
                            <span style="color:red"></span>
                        </div>

                        <div class="eachinput">
                            <label for="email">Update Email*</label>
                            <input type="email" name="email" id="email" placeholder="Edit eMail" maxlength="60"
                            value="<?=$userinfo['email']; ?>">
                            <span style="color:red"></span>
                        </div>

                        <div class="eachinput"> 
                            <label for="">Update Address</label>   
                            <input type="text" name="address" id="address" placeholder="Edit address" maxlength="60"
                            value="<?=$userinfo['address']; ?>">
                            <span style="color:red"></span>
                        </div>
                        <div class="eachinput"> 
                            <label for="work">Update Work</label>   
                            <input type="text" name="work" id="work" placeholder="Edit Work" maxlength="60"
                            value="<?=$userinfo['work']; ?>">
                            <span style="color:red"></span>
                        </div>
                        <div class="eachinput"> 
                            <label for="workdec">Describ what You Do</label>  
                            <input name="description" type="text" id="workdec" cols="30" rows="5" maxlength="1000" placeholder="Edit Work description"
                            value="<?=$userinfo['description']; ?>" style="width:100%; padding:10px"> 
                            <span style="color:red"></span>
                        </div>
                        <div class="eachinput"> 
                            <label for="profile">Update Profile Picture</label>   
                            <input type="file" name="image" id="profile" >
                            <span style="color:red"></span>
                        </div>
                    </div>


                    <button type="submit" name="updatemyprofile">UPDATE</button>
                    
                </div>
            </form>
        </section>
</body>