<?php
session_start();

include 'config/conne.php';

$update = $dbcon->prepare("UPDATE users SET `status` = ? WHERE id = ?");
$update->execute(['offline', $_SESSION['user']]);
session_unset();
session_destroy();

header('location:login.php');
die();
?>