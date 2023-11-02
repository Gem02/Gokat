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
            <h5>Settings</h5>
    </div>
    <section class="categories settings">
    
        <div class="settings-container">
            <a href="profile.php" class="" >
                <span><i class="fas fa-user"></i></span>
                <h3>Profile Information</h3>
            </a>
            <a href="changepassword.php" class="">
                <span><i class="fas fa-lock"></i></span>
                <h3>Passwords</h3>
            </a>
            <a href="bank.php" class="">
                <span><i class="fas fa-credit-card"></i></span>
                <h3>Bank details</h3>
            </a>
            <a href="" class="">
                <span><i class="fas fa-user-shield"></i></span>
                <h3>Privacy/Policy</h3>
            </a>
            <a href="TandC.php" class="">
                <span><i class="fas fa-exclamation-circle"></i></span>
                <h3>Terms & Condition</h3>
            </a>
        </div>

    </section>
</body>