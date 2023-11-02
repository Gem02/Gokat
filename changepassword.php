<?php

    session_start();
                
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];
    }
    if(!isset($user_id)) {
        header('location:login.php');
        exit();
    }

    include "require/header.php";
?>

<body>
    <div class="categorieshead">
            <h5>Change password</h5>
    </div>
    <section class="categories form-container">

            <form action="" method="post" enctype="multipart/form-data">
               <h3>update password</h3>
               <p>previous password</p>
               <input type="password" name="old_pass" placeholder="enter your old password" maxlength="20" class="box">
               <p>new password</p>
               <input type="password" name="new_pass" placeholder="enter your old password" maxlength="20" class="box">
               <p>confirm password</p>
               <input type="password" name="c_pass" placeholder="confirm your new password" maxlength="20" class="box">
               <input type="submit" value="Update" name="submit" class="btn">
            </form>
         
        </section>

</body>