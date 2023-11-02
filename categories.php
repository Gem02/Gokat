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
<div class="categorieshead">
        <h5>CATEGORIES</h5>
</div>
<section class="categories">

        <div class="rows">

             <img src="image/l2.jpg" alt="">
           
            <div class="info">
                <h4>SERVICE FOR YOU</h4>
                <h1>CLEANING SERVICE</h1>
                <p>Meet the best cleaning services you can ever asked for. Artisan listed
                    here are professional industrial/household cleaners. feel free to go through different post
                    and choose the best artisan you think can deliver the most.
                </p>
                <button>See Posts</button>
            </div>
        </div>


        <div class="rows">
            
            <div class="info">
                <h4>SERVICE FOR YOU</h4>
                <h1>ELECTRICIANS</h1>
                <p>Meet the best cleaning services you can ever asked for. Artisan listed
                    here are professional industrial/household cleaners. feel free to go through different post
                    and choose the best artisan you think can deliver the most.
                </p>
                <button>See Posts</button>
            </div>

            
            <img src="image/4.jpg" alt="">
           
        </div>

        <div class="rows">

            <img src="image/3.jpg" alt="">

            <div class="info">
                <h4>SERVICE FOR YOU</h4>
                <h1>WELDING</h1>
                <p>Meet the best cleaning services you can ever asked for. Artisan listed
                    here are professional industrial/household cleaners. feel free to go through different post
                    and choose the best artisan you think can deliver the most.
                </p>
                <button>See Posts</button>
            </div>

        </div>

</section>
<div class="categorieshead foot">
        <h5>NO CATEGORY ?</h5>
        <P><strong>You cant find a specific category?</strong></P>
        <hr>
        <form action="">
            <input type="text" placeholder="Enter Category name">
            <button type="submit">Send</button>
        </form>

</div>