<?php
session_start();

if (isset($_SESSION['user'])) {

    $user_id = $_SESSION['user'];

}else {
    header('location:logout.php');
    exit();
}
require "config/conne.php";

$select_user = $dbcon->prepare("SELECT * FROM users WHERE id = ?");
$select_user->execute([$user_id]);
$user_info = $select_user->fetch(PDO::FETCH_ASSOC);
$output = "";
if (isset($_POST['action'])){

    if ($_POST['action'] == 'fetchThispost') {
        $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_SPECIAL_CHARS );
        $post = $dbcon->prepare("SELECT * FROM `posts` LEFT JOIN users ON users.id = posts.poster_id WHERE posts.id = ? AND post_status = ?");
        $post->execute([$post_id, 'active']);
        $total_row = $post->rowCount();
        $follow_or_edit = '';
        if($total_row > 0){
            while ($post_info = $post->fetch(PDO::FETCH_ASSOC)) {
                if ($post_info["poster_id"] == $user_id) {
                    
                    $follow_or_edit = '<a href="#" class="posteditbtn">EDIT</a>';
                     
                        
                     
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
                if (strlen($post_info['post_text']) > 150) {
                    $cut_text = substr($post_info['post_text'], 0, 150);
                    $lastSpace = strrpos($cut_text, ' '); 
                    $content = substr($cut_text, 0, $lastSpace). '... '.' <a href="viewpost.php?post='.$post_info['id'].'"><button name="viewmore" class="seemore" id="seemore"> See More</button></a>';
                }

                $count_likes = $dbcon->prepare("SELECT * FROM `likes` WHERE `post_id` = ?");
                $count_likes->execute([$post_info['id']]);
                $total_likes = $count_likes->rowCount();

                $count_comments = $dbcon->prepare("SELECT * FROM `comments` WHERE `post_id` = ?");
                $count_comments->execute([$post_info['id']]);
                $comment_num = $count_comments->rowCount();


                $confirm_likes = $dbcon->prepare("SELECT * FROM `likes` WHERE liker_id = ? AND post_id = ?");
                $confirm_likes->execute([$user_id, $post_info['id']]);

                if ($confirm_likes->rowCount() > 0) {

                    $like_liked = '<button type="button" class="post_info-btn likebtn liked" id='.$post_info['id'].'><i class="far fa-thumbs-up"></i> Liked</button>';

                }else {
                    $like_liked = '<button type="button" class="post_info-btn likebtn" id='.$post_info['id'].'><i class="far fa-thumbs-up"></i> Like</button>';
                    
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
                if ($post_info['poster_id'] == $user_id) {
                    $profileDirectory =  '<a href="profile.php" class="img_and_name">';
                }else {
                    $profileDirectory = '<a href="userprofile.php?user='.$post_info['poster_id'].'" class="img_and_name">';
                } 

                    echo
                        '<div class="feedpost" data-postid="">

                            <div class="mainpost">
                                <div class="friend_post_top">
                                     
                                   '.$profileDirectory.' 
                                    
                                    <img src="'.$post_info['image'].'">
    
                                    <div class="friends_name">
                                        <p class="name">
                                            '.$post_info['firstname'].' '.$post_info['lastname'].'
                                        </p>
                                        <p class="time">13mins Ago - '.$post_info['category'].'</p>
                                    </div>
                                    
        
                                    </a>
                                    
                                    '.$follow_or_edit.'
                                </div>
                                    <hr>
                                <div class="postcontent">
                                    
                                    '.$post_image.'    
                                    
                                    <p>'.$post_info['post_text'].'</p>
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
                                        <a href="chatarea.php?user_id='.$post_info["poster_id"].'" class="chatnowbtn">Chat Now</a>
                                        <a href="requestpage.php?user='.$post_info["poster_id"].'" class="requestnowbtn">Request Similar work</a>
                                    </div>
                                </div>
        
                            </div>
                            <hr>
                            <div class="commentsection">
        
                                <div class="commentandpostlink">
                                    <h3>'.$comment_num.' Comments.</h3>
                                    <a class="viewpostlink" href="viewpost.php?post='.$post_info['id'].'">View Comments</a>
                                </div>
        
                                <form action="" method="post">
                                        <input type="text" name="postcomment" id="comment'.$post_info['id'].'" placeholder="Enter Comment" required>
                                        <button type="submit" id="'.$post_info['id'].'" name="submitcomment" class="submitcomment">Comment</button>
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
            echo "you just liked";
        }
    }
}


?>