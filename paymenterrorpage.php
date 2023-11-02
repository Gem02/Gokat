<?php

session_start();
            
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];
}
if(!isset($userId)) {
    header('location:login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets\css\style.css">
</head>
<body>
    <div class="error">
        <h3>Error</h3>
        <img src="image\warning-icon-png-2775.png" alt="error icon">
        <p>Sorry!, an error occured. Try loging out and logging in again and carry out your transaction.</p>
        <span>If the error persist then contact any of our customer care line and report your issue</span>

        <div class="buttons">
            <a href="logout.php">Logout here</a>
            <a href="index.php">Home</a>
        </div>
    </div>
</body>
</html>