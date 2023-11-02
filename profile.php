<?php

    session_start();
            
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];
    }
    if(!isset($user_id)) {
        header('location:login.php');
        die();
    }
    if (isset($_GET['id'])) {
        $thisUser = filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);
    }else {
        header('location:index.php');
        die();
    }
require "config/conne.php";
$select_user = $dbcon->prepare("SELECT * FROM users WHERE id = ?");
$select_user->execute([$thisUser]);
$userinfo = $select_user->fetch(PDO::FETCH_ASSOC);
    
    include "require/header.php";
?>

  <body>
    <div class="head-wrapper" id="<?= $thisUser ?>">
      <div class="div"><img src="image\bg.jpeg" alt="profile background"></div>
            <div class="left">
                <div class="img-container">
                <?php if($userinfo['image'] === null){ ?>
                    <img src="image/pic-1.jpg" id='user-btn'>
                <?php }else { ?>
                    <img src="<?= $userinfo['image'] ?>" id='user-btn'>
               <?php } ?> 
                    <span></span>
                </div>
                <div class="info">
                    <h2><?= $userinfo['firstname'] ?> <?= $userinfo['lastname'] ?></h2>

                    <?php if (($userinfo['work'] === null) && ($user_id == $thisUser) ) { ?>
                        <p style="color:red">Edit and enter Work</p>
                   <?php }elseif ($userinfo['work'] === null) { ?>
                            <p style="color:red">Blank</p>
                    <?php }else { ?>
                        <p><?= $userinfo['work'] ?></p>
                  <?php } ?>

                    <p><?= $userinfo['email'] ?></p>
                    
                    <p class="lastline"><?= $userinfo['phone'] ?></p>


                    <?php if ($user_id == $thisUser) { ?>
                        <a href="updateuser.php">Edit</a>
                        <a href="createpost.php"><i class="fas fa-plus"></i> Post</a>
                    <?php }else { ?>
                       <br> <a href="">Follow</a>
                    <?php } ?>
                        
                    <?php
                        $followers = $dbcon->prepare("SELECT * FROM `followers` WHERE `following_id` = ?");
                        $followers->execute([$thisUser]);
                        $followers_num = $followers->rowCount();

                        $followings = $dbcon->prepare("SELECT * FROM `followers` WHERE `follower_id` = ?");
                        $followings->execute([$thisUser]);
                        $followings_num = $followings->rowCount();

                        $myworks = $dbcon->prepare("SELECT * FROM `posts` WHERE `poster_id` = ?");
                        $myworks->execute([$thisUser]);
                        $myworks_num = $myworks->rowCount();
                    ?>
                    <ul class="audience">
                        <li><span><?= $followers_num ?></span>Followers</li>
                        <li><span><?= $followings_num ?></span>Following</li>
                        <li><span><?= $myworks_num ?></span>Works Posted</li>
                        <li><span>0</span>Successful Works</li>
                    </ul>
                    
                    <div class="about">
                        <?php if (($userinfo['description'] === null) && ($user_id == $thisUser)) { ?>
                            <p style="color:red">Edit and enter Work description</p>
                        <?php }elseif ($userinfo['description'] === null) { ?>
                            <p style="color:red">Blank</p>
                        <?php }else { ?>
                            <p><?= $userinfo['description'] ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
    </div>

    <main class="profile-main">

        <div class="centered">

            <div class="my_post">
                <h5>RECENT POST</h5>
            </div>

            <div class="feedposts">

            </div>
        </div>

        <div class="profile-right">
            <h5>EXTRA INFORMATION</h5>

            <p>Some extra informations regarding profile would be added here but for thats it</p>
        </div>
        
    </main>

     <script>
        
        function fetch_post(){
            var action = 'fetch_profilepost';
            var profile_id = $(".head-wrapper").attr('id');
            
            $.ajax({
            url:'profileaction.php',
            method:"POST",
            data:{action:action, profile_id:profile_id},
            success:function(data){
                $('.feedposts').html(data);
            }
            })
        }

                
        $(document).on('click', '.followbtn', function(e){
            e.preventDefault();
            var poster_id = $(this).attr('id');
            var action = 'follow';
            
            $.ajax({
                url:"profileaction.php",
                method:"POST",
                data:{poster_id:poster_id, action:action},
                success:function(data){
                    $('.follow').html(data);
                        fetch_post();
                        toastr.success("Action was successful", "Success");
                }
            })
        }); 

        $(document).on('click', '.likebtn', function(e){
            e.preventDefault();
            var post_id = $(this).attr('id');
            var action = 'like';

            $.ajax({
                url:"action.php",
                method:"POST",
                data:{post_id:post_id, action:action},
                success:function(data) {
                    fetch_post();
                    toastr.success("Action was successful", "Success");
                    
                }
            })
        })

        $(document).on('click', '.submitcomment', function(e){
                e.preventDefault();
                post_id = $(this).attr('id');
                var comment = $('#comment'+post_id).val();
                var action = 'submitcomment';
                if(comment != ''){
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{post_id:post_id, comment:comment, action:action},
                        success:function(data)
                        {

                            fetch_post();
                            toastr.success("Comment added successfully", "Success");
                        }
                    })
                }else {
                    alert('Comment cannot be empty');
                }
        });

        $(document).on('click', '.deletepost', function(e){
            e.preventDefault();
            post_id = $(this).attr('id');
            var action = 'deletepost';
            swal({
                title: 'Are you sure?',
                text: 'Once deleted, you will not be able to recover this  Post!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                            var post_id = $(this).attr("id");
                            var action = 'deletepost';
                            $.ajax({
                                url:'action.php',
                                method:'POST',
                                data:{post_id:post_id, action:action},
                                success:function(data){
                                    toastr.success("Your post has been deleted successfully", "Success");
                                    fetch_post();
                                }
                            })
                        
                    }else {
                        swal("saved");
                    }
                })
                
        })


        fetch_post();
        
     </script>
    
  </body>
