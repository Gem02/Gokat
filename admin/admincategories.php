<?php

if (isset($_POST['submit'])) {

    require "../config/conne.php";

    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
    
    
    if (!empty($_FILES['image']['name'] && $_FILES['image']['error'] == 0)) {
        $folder = 'categoriesImages/';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
            
        }
        $image = $folder.time().'_'.mt_rand().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
        $image_added = true;
        $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
        

$insert_categories = $dbcon->prepare("INSERT INTO `categories`(title, description, image) VALUES(?, ?, ?)");
$insert_categories->execute([$title, $description, $image]);

}}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>TEMPORARY CATEGORIES WORK SPACE</h1>
    <form action="" method="post" enctype ="multipart/form-data">
        <input type="text" placeholder="category title" required name="title"><br>
        <input type="text" placeholder="category description" name="description" required><br>
        <input type="file" required name="image">
        <input type="Submit" name = "submit">
    </form>
</body>
</html>