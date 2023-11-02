<?php


session_start();

if (isset($_SESSION['user'])) { 
   $user_id = $_SESSION['user'];
}
if (!isset($user_id)) {
   header('location:login.php');
   exit();
}

if (isset($_GET['user'])) {
    $user = $_GET['user'];
}
else {
    header('location:login.php');
    exit();
}
include 'config/conne.php';


/* if (isset($_POST['submit'])) {

    $outgoing_id = $_SESSION['user'];
    $incoming_id = filter_var($_POST['incoming_id'], FILTER_SANITIZE_SPECIAL_CHARS);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);
    $time = date('H:i');

    if(!empty($message)){
        try {
            $insert = $dbcon->prepare("INSERT INTO messages (sender_id, reciever_id, message, time) VALUES(?, ?, ?, ?)");
            $insert->execute([$outgoing_id, $incoming_id, $message, $time]);
        } catch (PDOException $e) {
            echo'
                <script> window.alert("Sorry something went wrong") </script>';
        }


    }

} */





$output = "";

        $getmessage = $dbcon->prepare("SELECT * FROM messages LEFT JOIN users ON users.id = messages.id
         WHERE (sender_id = ? AND reciever_id = ?)
        OR (sender_id = ? AND reciever_id = ?) ORDER BY messages.id");
        $getmessage->execute([$user_id, $user, $user_id, $user]);

        if ($getmessage->rowCount() > 0) {
            while ($message = $getmessage->fetch(PDO::FETCH_ASSOC)) {
                if ($message['sender_id'] === $user_id) {
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'. $message['message'] .'</p>
                                    </div>
                                </div>';
                }else {
                    $output .= '<div class="chat incoming">
                                    <img src="'.$message['image'].'" alt="">
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                </div>';
                }
            }
        }else {
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Area</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>
        .chatenviroment .text{
        position: absolute;
        top: 45%;
        left: 50%;
        width: calc(100% - 50px);
        text-align: center;
        transform: translate(-50%, -50%);
        }
        .chatenviroment .chat{
        margin: 15px 0;
        }
        .chatenviroment .chat p{
        word-wrap: break-word;
        padding: 8px 16px;
        box-shadow: 0 0 32px rgb(0 0 0 / 8%),
                    0rem 16px 16px -16px rgb(0 0 0 / 10%);
        }
        .chatenviroment .outgoing{
        display: flex;
        }
        .chatenviroment .outgoing .details{
        margin-left: auto;
        max-width: calc(100% - 130px);
        }
        .outgoing .details p{
        background: #333;
        color: #fff;
        border-radius: 18px 18px 0 18px;
        }
        .details span{
            font-size: 11px
        }
        .chatenviroment .incoming{
        display: flex;
        align-items: flex-end;
        }
        .chatenviroment .incoming img{
        height: 35px;
        width: 35px;
        }
        .chatenviroment .incoming .details{
        margin-right: auto;
        margin-left: 10px;
        max-width: calc(100% - 130px);
        }
        .incoming .details p{
        background: #fff;
        color: #333;
        border-radius: 18px 18px 18px 0;
        }
    </style>
    <section>
        <?php 
            
$user_acct= $dbcon->prepare("SELECT * FROM users WHERE id = ?");
$user_acct->execute([$user]);
$user_info = $user_acct->fetch(PDO::FETCH_ASSOC);

        ?>
        <div class="chatarea">
            <div class="chathead">
                <div><img src="<?= $user_info['image'] ?>" alt=""></div>

                <div class="namez"><h3><?= $user_info['firstname'] ?> <?= $user_info['lastname'] ?></h3></div>
                
                <div class="options">
                    <div>
                        
                        <a href="userprofile.php?user=<?= $user_info['id'] ?>" class="moretmpt">Profile</a>
                        <a href="requestpage.php?user=<?= $user_info['id'] ?>" class="moretmpt">Request work now</a>
                        <button class="btn">More</button>

                    </div>
                    <div class="morebtn">
                        <a href="userprofile.php?user=<?= $user_info['id'] ?>">Profile</a>
                        <a href="requestpage.php?user=<?= $user_info['id'] ?>">Request work now</a>
                    </div>
                </div>
            </div>
            <div class="chatenviroment">

            </div>
                <form action="#" class="messageform" method="post">
                    <input type="text" class="incoming_id" name="incoming_id" value="<?= $user ?>" hidden>
                    <div class="formflex">
                        <input type="text" name="message" class="messageinput" placeholder="Type a message here..." autocomplete="off">
                        <button type="submit" name="submit">Send</button>
                    </div>
              </form>
            
        </div>
            
    </section>

    <script>
       const MoreBtn =  document.querySelector(".btn"),
             More = document.querySelector(".morebtn");

        MoreBtn.addEventListener("click", () => {
            More.classList.toggle("active")
        })

    </script>
    <script src="chatscript.js"></script>

</body>
</html>