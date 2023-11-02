<?php

    session_start();
                
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];
        require "config/conne.php";
    }
    if(!isset($user_id)) {
        header('location:login.php');
        exit();
    }
    if (isset($_GET['postId'])) {
        $postId = $_GET['postId'];
        $set = $dbcon->prepare("SELECT * FROM `posts` WHERE `post_id` = ?");
        $set->execute([$postId]);
        $setdata = $set->fetch(PDO::FETCH_ASSOC);
    }
    

    $select_category = $dbcon->prepare("SELECT * FROM categories");
    $select_category->execute();

    $select_user = $dbcon->prepare("SELECT * FROM users WHERE id = ?");
    $select_user->execute([$user_id]);
    $user = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && !isset($postId)) {

        $category = filter_var($_POST['category'], FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_var($_POST['content'], FILTER_SANITIZE_SPECIAL_CHARS);
        $post_user_id = $user_id;
        $status = filter_var('active', FILTER_SANITIZE_SPECIAL_CHARS);
       
        $image_added = false;
            if (!empty($_FILES['image']['name'])) {
                $folder = 'postImages/';
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                    
                }
                $image = $folder.time().'_'.mt_rand().'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
                $image_added = true;
                $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
                
            }
            if ($image_added == true) {
                $make_post = $dbcon->prepare("INSERT INTO posts (poster_id, post_status, post_text, category, post_image) VALUES(?,?,?,?,?)");
                $make_post->execute([$user_id, $status, $content, $category, $image]);
                header('location: index.php?data=post_added');
                exit();
                
            }else {
                $make_post = $dbcon->prepare("INSERT INTO posts (poster_id, post_status, post_text, category) VALUES(?,?,?,?)");
                $make_post->execute([$user_id, $status, $content, $category]);
                header('location: index.php?data=post_added');
                exit();
            }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && isset($postId)) {
        $category = filter_var($_POST['category'], FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_var($_POST['content'], FILTER_SANITIZE_SPECIAL_CHARS);
       
        $image_added = false;
            if (!empty($_FILES['image']['name'])) {
                $folder = 'postImages/';
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                    
                }
                $image = $folder.time().'_'.mt_rand().'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
                $image_added = true;
                $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
                
            }
            if ($image_added == true) {
                $make_post = $dbcon->prepare("UPDATE `posts` SET `post_text` = ?, category = ?, `post_image` = ? WHERE `post_id` = ?");
                $make_post->execute([$content, $category, $image, $postId]);
                header('location: index.php?data=post_updated');
                exit();
                
            }else {
                $make_post = $dbcon->prepare("UPDATE `posts` SET `post_text` = ?, category = ? WHERE `post_id` = ?");
                $make_post->execute([$content, $category, $postId]);
                header('location: index.php?data=post_updated');
                exit();
            }
    }

    include "require/header.php";
?>
<div class="categorieshead">
        <h5>CREATE POST</h5>
</div>
<section class="creat-post">
            <div class="creat-area">
                <div class="user">
                    <?php
                    if ($user['image'] === null) { ?>
                        <img src="image/pic-1.jpg" id='user-btn'>
                   <?php }else { ?>
                         <img src="<?= $user['image'] ?>" id='user-btn'>
                  <?php } ?>
                    
                
                    <div class="info">
                        <h3><?= $user['firstname'] ?> <?= $user['lastname'] ?></h3>
                        <span><?= date('Y-m-d') ?></span>
                    </div>
                </div>
                <form action="" method="post" class="fill" enctype="multipart/form-data">
                    
                    <input type="hidden" name="firstname" value="<?= $user['firstname'] ?>">
                    <input type="hidden" name="lastname" value="<?= $user['lastname'] ?>">
                    <input type="hidden" name="posterImage" value="<?= $user['image'] ?>">
                    <input type="hidden" name="posterId" value="<?= $user['id'] ?>">

                        <select name="category" class="catoptions" required>
                            <?php if (!isset($setdata['category'])) { ?>
                                <option value="SELECT CATEGORY" selected disabled>SELECT CATEGORY...</option><br>
                           <?php }else { ?>
                                <option value="<?= $setdata['category'] ?>" selected disabled><?= $setdata['category'] ?></option><br>
                          <?php } ?>
                            
                            <?php 
                                while ($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)) {
                            ?>    <option value="<?= $fetch_category['title']?>"><?= $fetch_category['title']?></option>
                            <?php
                            }
                            ?>
                            
                            
                        </select>
                    <input type="file" accept="image/*" class="box" name="image">
                    <textarea name="content" class="box" maxlength="2000" cols="30" rows="10" placeholder="Type your text here" required><?php if (isset($setdata['post_text'])) { echo $setdata['post_text']; } ?></textarea>
                        
                    <button name="create" type="submit">Post</button>
                
                </form>
                
            </div>
        </section>