<?php
    session_start();
            
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];
    }
    if(!isset($user_id)) {
        header('location:login.php');
        die();
    }

    include "require/header.php";
?>
<div class="categorieshead">
        <h5>Extras and Navigation</h5>
</div>
<section class="categories settings">
    
        <div class="settings-container">
            <a href="workprogress.php" class="" >
                <span><i class="fa fa-tasks"></i></span>
                <h3>Check work status</h3>
            </a>
            <a href="paymentpage.php" class="" >
                <span><i class="fa fa-credit-card"></i></span>
                <h3>Make a payment</h3>
            </a>
            <a href="confirmPayment.php" class="" >
                <span><i class="fa fa-check-circle"></i></span>
                <h3>Confirm payment</h3>
            </a>
            <a href="transactionhistory.php" class="">
                <span><i class="fa fa-history"></i></span>
                <h3>Transaction History</h3>
            </a>
            <a href="faq.php" class="">
                <span><i class="fa fa-question-circle"></i></span>
                <h3>FaQ</h3>
            </a>
            <a href="about.php" class="">
                <span><i class="fas fa-layer-group"></i></span>
                <h3>About</h3>
            </a>
            <a href="TandC.php" class="">
                <span><i class="fas fa-exclamation-circle"></i></span>
                <h3>Terms & Condition</h3>
            </a>
        </div>

    </section>