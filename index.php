<?php

session_start();
            
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];
}
if(!isset($userId)) {
    header('location:login.php');
    exit();
}

    require "config/conne.php";
    $select_user = $dbcon->prepare("SELECT * FROM users WHERE id = ?");
    $select_user->execute([$userId]);
    $user = $select_user->fetch(PDO::FETCH_ASSOC);
    
    include "require/header.php";

    if (isset($_GET['data'])) {
        if ($_GET['data'] == 'post_updated') {
            echo '<script> toastr.success("Post updated successfully", "Success")
            setTimeout(() => {
                window.location = "index.php"
               }, 3000)
            </script>';
        }elseif ($_GET['data'] == 'post_added') {
            echo '<script> toastr.success("Post added successfully", "Success")
            setTimeout(() => {
                window.location = "index.php"
               }, 3000);
            </script>';
        }
    }
?>

    <main>

        <div class="right"> 
            
            <div class="first_warpper">

                <div class="page">

                    <h2>INFORMATION</h2>

                </div>

                <div class="page_img">
                    <img src="image/page.jpg">
                    <p>Web Designer</p>
                </div>

                <a href="paymentpage.php" class="page_icon">
                    <i class="fas fa-bell"></i>
                    <p>Make Payment</p>
                </a>

                <a href="confirmPayment.php" class="page_icon">
                    <i class="fas fa-bullhorn"></i>
                    <p>Confirm Payment</p>
                </a>

            </div>

            <hr>

            <div class="second_warpper">

                <h2 class="workupdate">WORK UPDATE</h2>

                <div class="img_and_tag">

                    <img src="image/gift.png">
                    <p>Work in progress...</p>
                    <a href="" class="pregressbtn">View progress...</a>
                </div>

            </div>

            <hr>


            <div class="third_warpper">

                <div class="contact_tag">

                    <h2>FOLLOWERS</h2>
                </div>

                <a href="#" class="contact">

                    <img src="image/contact_1.jpg">
                    <p>Senuda De Silva</p>

                </a href="#">

                <a href="#" class="contact">

                    <img src="image/contact_2.jpg">
                    <p>Senuda De Silva</p>

                </a>

                <a href="#" class="contact">

                    <img src="image/contact_3.jpg">
                    <p>Senuda De Silva</p>

                </a>

                <a href="#" class="contact">

                    <img src="image/contact_4.jpg">
                    <p>Senuda De Silva</p>

                </a>

                <a href="#" class="contact">

                    <img src="image/contact_5.jpg">
                    <p>Senuda De Silva</p>

                </a href="#">

                <a href="#" class="contact">

                    <img src="image/profile_1.jpg">
                    <p>Senuda De Silva</p>

                </a>

                <a href="#" class="contact">

                    <img src="image/profile_2.jpg">
                    <p>Senuda De Silva</p>

                </a>

                <a href="#" class="contact">

                    <img src="image/profile_3.jpg">
                    <p>Senuda De Silva</p>

                </a>

                <a href="#" class="contact">

                    <img src="image/profile_4.png">
                    <p>Senuda De Silva</p>

                </a >

                <a href="#" class="contact">

                    <img src="image/profile_5.png">
                    <p>Senuda De Silva</p>

                </a >

                <a href="#" class="contact">

                    <img src="image/profile_6.png">
                    <p>Senuda De Silva</p>

                </a >

                <a href="#" class="contact">

                    <img src="image/profile_7.png">
                    <p>Senuda De Silva</p>

                </a >

            </div>

        </div>
       

        <div class="centered">

            <div class="my_post">
                <h5>WELCOME HOME</h5>
                <hr>
                <div class="post_top">
                   <div> <img src="<?= $user['image'] ?>" id='user-btn'> </div>
               
                    <form action="" style="width:100%">
                        <input type="text" placeholder="What's on you mind, John?">
                    </form>
                </div>

                <hr>

                <a href="createpost.php" class="post_bottom">

                    <div class="post_icon">
                        <i class="fas fa-plus"></i>
                        <p>Post Work</p>
                    </div>
                </a>

            </div>
            <div class="feedposts">

            </div>
        </div>

    <?php

        include('jquery.php');

    ?>
    </main>

