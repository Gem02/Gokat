<?php

session_start();
            
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
}
if(!isset($user_id)) {
    header('location:login.php');
    exit();
}

    if (isset($_GET['user']) && $_GET['user'] != $user_id) {

        $userHere = $_GET['user'];
    }else {
        header('location:index.php');
        exit();
    }

    require "config/conne.php";
    
    $select_info = $dbcon->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_info->execute([$userHere]);
    $user_info = $select_info->fetch(PDO::FETCH_ASSOC);

    
    include "require/header.php";
?>
<body>
    <div class="head-wrapper">
      <div class="div"></div>
            <div class="left">
                <div class="img-container">
                <?php
                 if ($user_info['image'] === null){ ?>
                    <img src="image/pic-1.jpg" id='user-btn'>
                <?php }else { ?>
                    <img src="<?= $user_info['image'] ?>" id='user-btn'>
               <?php } ?>
                    
                    <span></span>
                </div>
                <div class="info">
                    <h2><?= $user_info['firstname'] ?> <?= $user_info['lastname'] ?></h2>
                   <?php if ($user_info['work'] === null){ ?>
                        <p style="color:red">Edit and enter Work</p>
                    <?php }else { ?>
                        <p><?= $user_info['work'] ?></p>
                    <?php } ?>

                    <p><?= $user_info['email'] ?></p>
                    
                    <p class="lastline"><?= $user_info['phone'] ?></p>

                    <a href="">Follow</a>
                    
                    <ul class="audience">
                        <li><span>4,073</span>Followers</li>
                        <li><span>322</span>Following</li>
                        <li><span>200,543</span>Works Posted</li>
                        <li><span>543</span>Successful Works</li>
                    </ul>
                    
                    <div class="about">
                        <?php if($user_info['description'] === null) { ?>
                            <p style="color:red">Edit and enter Work description</p>
                        <?php }else { ?>
                            <p>
                            <?= $user_info['description'] ?>
                            </p>
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

            <div class="feedpost">

                <div class="mainpost">
                    <div class="friend_post_top">

                        <div class="img_and_name">

                            <img src="image/post_1.jpg">

                            <div class="friends_name">
                                <p class="name">
                                    Senuda De Silva
                                </p>
                                <p class="time">13mins Ago - Developer</p>
                            </div>
                            

                        </div>

                        <div class="menu">

                            <i class="fas fa-ellipsis-v"></i>

                        </div>

                    </div>
                        <hr>
                    <div class="postcontent">

                        <img src="image/post_5.jpg">
                        <p>I took this photo this morning. What do you guys think?</p>
                        <div class="buttons">
                            <div class="but">
                                <button type="button" class="post-btn"><i class="fas fa-share"></i> Share</button>
                                <button type="button" class="post-btn"><i class="far fa-thumbs-up"></i> Like</button>
                            </div>
                            <div class="likescount">
                                <span class="showlikes">127 likes - 3 comments</span>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="commentsection">

                    <div class="commenterinfo">
                        <img src="image/profile.png" class="">
                        <div class="">
                            <div class="maincommenttext">
                                <h3>Godwin Mangai</h3>
                                <p>This is the first comment testing im doing</p>
                            </div>
                            <div class="comments_options">
                                <span>12min Ago</span>
                                
                                <a href="#"><i class="fas fa-trash deleteReply"></i> Delete</a>
                                <a href="#"><i class="fas fa-edit editReply"></i> Edit</a>
                            
                            </div>
                            
                        </div>
                    </div>

                    <div class="commenterinfo">
                        <img src="image/profile.png" class="">
                        <div class="">
                            <div class="maincommenttext">
                                <h3>Godwin Ezekiel</h3>
                                <p>i intensionally made this comment long just to see how it would like so that i can adjust the spaces. So now what can i say to make it even longer chai...wahala</p>
                            </div>
                            <div class="comments_options">
                                <span>2min Ago</span>
                                
                                <a href="#"><i class="fas fa-trash deleteReply"></i> Delete</a>
                                <a href="#"><i class="fas fa-edit editReply"></i> Edit</a>
                            
                            </div>
                            
                        </div>
                    </div>

                    <form action="">
                        
                            <input type="text" placeholder="Press Enter to submit Comment" required>
                        
                    </form>

                </div>

            </div>

            <div class="feedpost">

                <div class="mainpost">
                    <div class="friend_post_top">

                        <div class="img_and_name">

                            <img src="image/post_1.jpg">

                            <div class="friends_name">
                                <p class="name">
                                    Senuda De Silva
                                </p>
                                <p class="time">13mins Ago - Developer</p>
                            </div>
                            

                        </div>

                        <div class="menu">

                            <i class="fas fa-ellipsis-v"></i>

                        </div>

                    </div>
                    <hr>
                    <div class="postcontent">

                        <img src="image/post_4.jpg">
                        <p>I took this photo this morning. What do you guys think?</p>
                        <button type="button" class="post-btn"><i class="fas fa-share"></i> Share</button>
                        <button type="button" class="post-btn"><i class="far fa-thumbs-up"></i> Like</button>
                        <span class="float-right text-muted">127 likes - 3 comments</span>
                    </div>

                </div>
                <hr>
                <div class="commentsection">

                    <div class="commenterinfo">
                        <img src="image/profile.png" class="">
                        <div class="">
                            <div class="maincommenttext">
                                <h3>Godwin Mangai</h3>
                                <p>This is the first comment testing im doing</p>
                            </div>
                            <div class="comments_options">
                                <span>12min Ago</span>
                                
                                <a href="#"><i class="fas fa-trash deleteReply"></i> Delete</a>
                                <a href="#"><i class="fas fa-edit editReply"></i> Edit</a>
                            
                            </div>
                            
                        </div>
                    </div>

                    <div class="commenterinfo">
                        <img src="image/profile.png" class="">
                        <div class="">
                            <div class="maincommenttext">
                                <h3>Godwin Ezekiel</h3>
                                <p>i intensionally made this comment long just to see how it would like so that i can adjust the spaces. So now what can i say to make it even longer chai...wahala</p>
                            </div>
                            <div class="comments_options">
                                <span>2min Ago</span>
                                
                                <a href="#"><i class="fas fa-trash deleteReply"></i> Delete</a>
                                <a href="#"><i class="fas fa-edit editReply"></i> Edit</a>
                            
                            </div>
                            
                        </div>
                    </div>

                    <form action="">
                            <img src="image/profile.png" alt="">
                            <input type="text" placeholder="Press Enter to submit Comment" required>
                        
                    </form>

                </div>

            </div>
        </div>

        <div class="profile-right">
            <h5>EXTRA INFORMATION</h5>

            <p>Some extra informations regarding profile would be added here but for thats it</p>
        </div>
        
    </main>

     
    
  </body>