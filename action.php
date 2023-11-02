<?php
session_start();
        
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
}
if(!isset($user_id)) {
    header('location:login.php');
    exit();
}
require "config/conne.php";

$select_user = $dbcon->prepare("SELECT * FROM users WHERE id = ?");
$select_user->execute([$user_id]);
$user_info = $select_user->fetch(PDO::FETCH_ASSOC);
$output = "";
if (isset($_POST['action'])) {
    
    if ($_POST['action'] == 'fetch_post') {
        $select_post = $dbcon->prepare("SELECT * FROM posts LEFT JOIN users ON users.id = posts.poster_id WHERE `post_status` = ? ORDER BY `post_id` DESC LIMIT 10");
        $select_post->execute(["active"]);
        $total_row = $select_post->rowCount();
        $follow_or_edit = '';
        if($total_row > 0){
            while ($post_info = $select_post->fetch(PDO::FETCH_ASSOC)) {
                if ($post_info["poster_id"] == $user_id) {
                    
                    $follow_or_edit = '<div class="userextras">
                                        <div class="extrasoptions">
                                            <a href="" id="'.$post_info['post_id'].'" class="posteditbtn deletepost" ><i class="fas fa-trash"></i> Delete</a>
                                            <a href="createpost.php?postId='.$post_info['post_id'].'" class="posteditbtn"><i class="fas fa-edit"></i> Edit</a>
                                        </div>
                                        
                                    </div>';
                        
                     
                }else {
                    $checkfollow = $dbcon->prepare("SELECT * FROM followers WHERE follower_id = ? AND following_id = ?");
                    $checkfollow->execute([$user_id, $post_info['poster_id']]);
                    if ($checkfollow->rowCount() > 0) {
                        $follow_or_edit = '<div>
                                                <button class="followbtn positive" id="'.$post_info['poster_id'].'">Following</button>
                                            </div>';
                    }else {
                        $follow_or_edit = '<div>
                                                <button class="followbtn" id="'.$post_info['poster_id'].'">Follow</button>
                                            </div>';
                    }
                    
                    
                }    
                $post_image='';

                
                $content = $post_info['post_text'];
                if (strlen($post_info['post_text']) > 200) {
                    $cut_text = substr($post_info['post_text'], 0, 200);
                    $lastSpace = strrpos($cut_text, ' '); 
                    $content = substr($cut_text, 0, $lastSpace). '... '.' <a href="viewpost.php?post_info='.$post_info['id'].'"><button name="viewmore" class="seemore" id="seemore"> See More</button></a>';
                }

                $count_likes = $dbcon->prepare("SELECT * FROM `likes` WHERE `post_id` = ?");
                $count_likes->execute([$post_info['post_id']]);
                $total_likes = $count_likes->rowCount();

                $count_comments = $dbcon->prepare("SELECT * FROM `comments`  WHERE `post_id` = ?");
                $count_comments->execute([$post_info['post_id']]);
                $comment_num = $count_comments->rowCount();


                $confirm_likes = $dbcon->prepare("SELECT * FROM `likes` WHERE liker_id = ? AND post_id = ?");
                $confirm_likes->execute([$user_id, $post_info['post_id']]);

                $comment_here = "";
                $check_comments = $dbcon->prepare("SELECT * FROM comments LEFT JOIN users ON users.id = commenter_id WHERE post_id = ? ORDER BY comment_id DESC LIMIT 2");
                $check_comments->execute([$post_info['post_id']]);
                if ($check_comments->rowCount() > 0) {

                    while ($comment_info = $check_comments->fetch(PDO::FETCH_ASSOC)) {

                        $comment_here .= '<div class="commenterinfo">
                                        <img src="'.$comment_info['image'].'" class="">
                                        <div class="">
                                            <div class="maincommenttext">
                                                <h3>'.$comment_info['firstname'].' '.$comment_info['lastname'].'</h3>
                                                <p>'.$comment_info['comment_text'].'</p>
                                            </div>
                                            <div class="comments_options">
                                                <span>12min Ago</span>
                                                
                                                <a href="#"><i class="fas fa-trash deleteReply"></i> Delete</a>
                                                <a href="#"><i class="fas fa-edit editReply"></i> Edit</a>
                                            
                                            </div>
                                            
                                        </div>
                                    </div>';

                                    
                    }
                    
                }else {
                    $comment_here = '<p class="nocomment">No Comment yet</p>';
                }


                if ($confirm_likes->rowCount() > 0) {

                    $like_liked = '<button type="button" class="post_info-btn likebtn liked" id='.$post_info['post_id'].'><i class="far fa-thumbs-up"></i> Liked</button>';

                }else {
                    $like_liked = '<button type="button" class="post_info-btn likebtn" id='.$post_info['post_id'].'><i class="far fa-thumbs-up"></i> Like</button>';
                    
                }

                if ($confirm_likes->rowCount() > 0){
                    $color= 'color: red';
                    
                }else {
                    $color= 'color: gray';
                }
                if ($post_info['post_image'] === null) {
                    $post_image .= '';
                }else {
                    $post_image .= '<img src="'.$post_info['post_image'].'" alt="">';
                    
                }
                

                    echo
                        '<div class="feedpost" data-postid="">

                            <div class="mainpost">
                                <div class="friend_post_top">
                                     
                                    <a href="profile.php?id='.$post_info['poster_id'].'" class="img_and_name">
                                    
                                        <div><img src="'.$post_info['image'].'"></div>
        
                                        <div class="friends_name">
                                            <p class="name">
                                                '.$post_info['firstname'].' '.$post_info['lastname'].'
                                            </p>
                                            <div class="nameandcat">
                                                <p class="time">13mins Ago -  </p>
                                                <p class="time">'.$post_info['category'].'</p>
                                            </div>
                                        </div>
                                    
        
                                    </a>
                                    
                                    '.$follow_or_edit.'
                                </div>
                                    <hr>
                                <div class="postcontent">
                                    
                                    '.$post_image.'    
                                    
                                    <p>'.$content.'</p>
                                    <div class="buttons">
                                        <div class="but">
                                            <button type="button" class="post_info-btn"><i class="fas fa-share"></i> Share</button>
                                           
                                            '.$like_liked.'
                                           
                                        </div>
                                        <div class="likescount">
                                            <span class="showlikes">'.$total_likes.' likes - '.  $comment_num.' comments</span>
                                        </div>
                                    </div>

                                    <div class="directorysection">
                                        <a href="./chat/mainchatarea.php?user_id='.$post_info["poster_id"].'" class="chatnowbtn">Chat Now</a>
                                        <a href="requestpage.php?user='.$post_info["poster_id"].'" class="requestnowbtn work">Request Similar work</a>
                                    </div>
                                </div>
        
                            </div>
                            <hr>
                            <div class="commentsection">
        
                                <div class="commentandpostlink">
                                    <h3>'.$comment_num.' Comments.</h3>
                                    <a class="viewpostlink" href="viewpost.php?post='.$post_info['post_id'].'">View Comments</a>
                                </div>

                                '.$comment_here.'
        
                                <form action="" method="post">
                                        <input type="text" name="postcomment" id="comment'.$post_info['post_id'].'" placeholder="Enter Comment" required>
                                        <button type="submit" id="'.$post_info['post_id'].'" name="submitcomment" class="submitcomment">Comment</button>
                                </form>
        
                            </div>
    
                        </div>';
        }}

        
    }

    if ($_POST['action'] == 'follow') {
        $poster_id = $_POST['poster_id'];
        $checkfollow = $dbcon->prepare("SELECT * FROM followers WHERE follower_id = ? AND following_id = ?");
        $checkfollow->execute([$user_id, $poster_id]);
        if($checkfollow->rowCount() > 0){
            $sub_follow = $dbcon->prepare("DELETE FROM `followers` WHERE follower_id = ? AND following_id = ?");
            $sub_follow->execute([$user_id, $poster_id]);
            $reduce_follow = $dbcon->prepare("UPDATE `users` SET `followers_num`= followers_num - 1  WHERE `id` = ?;");
            $reduce_follow->execute([$following]);
            echo '<script>
                    swal("Note!", "You are no longer a follower", "error", {
                    button: "Ok",
                        });
                </script>';
        }else {
            $insert_follow = $dbcon->prepare("INSERT INTO `followers` (following_id, follower_id) VALUES(?, ?)");
            if ($insert_follow->execute([$poster_id, $user_id])) {
                $sub_follow->execute([$following]);
                echo '<script>
                    swal("Good job!", "You are now a follower!", "success", {
                    button: "Ok",
                        });
                </script>';
            }else {
                echo '<script>
                    swal("Error!", "Sorry please try again later!", "error", {
                    button: "Ok",
                        });
                </script>';
            }
        }
    }

    if ($_POST['action'] == 'like') {
        $post_id = $_POST['post_id'];
        $checklike = $dbcon->prepare('SELECT * FROM `likes` WHERE `liker_id` = ? AND `post_id` = ?');
        $checklike->execute([$user_id, $post_id]);
        if ($checklike->rowCount() > 0) {
            $unlike = $dbcon->prepare("DELETE FROM `likes` WHERE post_id = ? AND liker_id = ?");
            $unlike->execute([$post_id, $user_id]);
            echo "Unlike";
        }else {
            $add_like = $dbcon->prepare("INSERT INTO `likes`(liker_id, post_id) VALUES(?,?)");
            $add_like->execute([$user_id, $post_id]);
            echo '
            <script> 
                
            </script>';
        }
    }

    if ($_POST['action'] == 'submitcomment') {
        $post_id = filter_var($_POST["post_id"], FILTER_SANITIZE_NUMBER_INT);
        $comment = filter_var($_POST["comment"], FILTER_SANITIZE_SPECIAL_CHARS);

        $make_comment = $dbcon->prepare("INSERT INTO `comments` (post_id, commenter_id, comment_text) VALUES(?,?,?)");
        $make_comment->execute([$post_id, $user_id, $comment]);
        echo 'Comment Added';
    }

    
    if ($_POST['action'] == 'deletepost') {
        $post_id = filter_var($_POST["post_id"], FILTER_SANITIZE_NUMBER_INT);

        $delete = $dbcon->prepare("DELETE FROM `posts` WHERE `post_id`= ?");
        $delete->execute([$post_id]);
        echo "deleted";
    }
}