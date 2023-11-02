<?php

session_start();
            
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
}
if(!isset($user_id)) {
    header('location:login.php');
    exit();
}   

if (isset($_GET['status'])) {
    $workCode = $_GET['status'];
}
if (!isset($_GET['status'])) {
    header('Location:paymentpage.php');
    die();
}
    
    include "require/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
    <div class="categorieshead">
        <h5>Successful Payment</h5>
    </div>
    <section class="categories ">
        <div >
            <h1 style="color:green">Congratulations you have successfully made your payment</h1>
            <p>Your Work would start immediately</p>
            <p>Download your reciept and work request approval because you will need it when applying for a refund or change of work</p>
           <br> <br> <a href="invoice.php?code=<?= $workCode ?>" class="btn">Download attachment</a>
        </div>

    </section>

    <style>
        .categories div{
            padding: 20px 30px
        }
        .categories h1{
            font-size: 20px;
        }
        p{
            margin-top: 5px;
            font-size: 13px;
        }
        .categories a{
            padding: 10px;
            border: none;
            margin-top: 50px;
            font-size: 13px;
            color: white;
            background: green;

        }
    </style>
</body>
</html>