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

<div class="customershead">
        <h5>CUSTOMERS/ARTISANS</h5>
</div>
<hr>
<section class="customersarea">


    <div class="eachcustomer">

        <div class="top">
            <div class="text">
                <h5>LAGOS ENGINEER</h5>
                <p class="name">Godwin PET</p>
                <p class="about"><span> About: </span> Builder/Painter/Chatching fun</p>
                <p class="c fas fa-home"> Address: <span>Victoria Island Lagos</span></p>
                <p class="c fas fa-phone"> Phone: <span>09019606073</span></p>

            </div>
            <div class="image">
                <img src="image/contact_5.jpg" alt="customer image">
            </div>
        </div>
        <div class="buttom">
            <a href=""><i class="fas fa-envelope"></i></a>
            <a href="@"><i class="fas fa-user"> View Profile</i></a>
        </div>

    </div>

    <div class="eachcustomer">

        <div class="top">
            <div class="text">
                <h5>CHIEF CATERER</h5>
                <p class="name">Blessing Sami</p>
                <p class="about"><span> About: </span> Builder/Painter/Chatching fun</p>
                <p class="c fas fa-home"> Address: <span>No 23 Aje Street Rivers State</span></p>
                <p class="c fas fa-phone"> Phone: <span>09019606073</span></p>

            </div>
            <div class="image">
                <img src="image/contact_4.jpg" alt="customer image">
            </div>
        </div>
        <div class="buttom">
            <a href=""><i class="fas fa-envelope"></i></a>
            <a href=""><i class="fas fa-user"> View Profile</i></a>
        </div>

    </div>

    <div class="eachcustomer">

        <div class="top">
            <div class="text">
                <h5>UI/UX DESIGMER</h5>
                <p class="name">John Doe</p>
                <p class="about"><span> About: </span> Developer/Designer/Programmer</p>
                <p class="c fas fa-home"> Address: <span>Zarmaganda Rayfield Road Jos</span></p>
                <p class="c fas fa-phone"> Phone: <span>09019606073</span></p>

            </div>
            <div class="image">
                <img src="image/contact_3.jpg" alt="customer image">
            </div>
        </div>
        <div class="buttom">
            <a href=""><i class="fas fa-envelope"></i></a>
            <a href=""><i class="fas fa-user"> View Profile</i></a>
        </div>

    </div>

    <div class="eachcustomer">

        <div class="top">
            <div class="text">
                <h5>PHONES REPAIRS</h5>
                <p class="name">Katnan Jerry</p>
                <p class="about"><span> About: </span> Buy/Sell/Repair</p>
                <p class="c fas fa-home"> Address: <span>Zarmaganda Rayfield Road Jos</span></p>
                <p class="c fas fa-phone"> Phone: <span>09019606073</span></p>

            </div>
            <div class="image">
                <img src="image/contact_2.jpg" alt="customer image">
            </div>
        </div>
        <div class="buttom">
            <a href=""><i class="fas fa-envelope"></i></a>
            <a href=""><i class="fas fa-user"> View Profile</i></a>
        </div>

    </div>

    <div class="eachcustomer">

        <div class="top">
            <div class="text">
                <h5>PROFESSIONAL PLUMBER</h5>
                <p class="name">Joseph Gowon</p>
                <p class="about"><span> About: </span> Fix pipes/Repair/Sell</p>
                <p class="c fas fa-home"> Address: <span>Zarmaganda Rayfield Road Jos</span></p>
                <p class="c fas fa-phone"> Phone: <span>09019606073</span></p>

            </div>
            <div class="image">
                <img src="image/contact_6.jpg" alt="customer image">
            </div>
        </div>
        <div class="buttom">
            <a href=""><i class="fas fa-envelope"></i></a>
            <a href=""><i class="fas fa-user"> View Profile</i></a>
        </div>

    </div>

    <div class="eachcustomer">

        <div class="top">
            <div class="text">
                <h5>ENGINEER AT BUSTON</h5>
                <p class="name">Godwin Mangai</p>
                <p class="about"><span> About: </span> Builder/Painter/Chatching fun</p>
                <p class="c fas fa-home"> Address: <span>Zarmaganda Rayfield Road Jos</span></p>
                <p class="c fas fa-phone"> Phone: <span>09019606073</span></p>

            </div>
            <div class="image">
                <img src="image/contact_5.jpg" alt="customer image">
            </div>
        </div>
        <div class="buttom">
            <a href=""><i class="fas fa-envelope"></i></a>
            <a href=""><i class="fas fa-user"> View Profile</i></a>
        </div>

    </div>
</section>




