<?php


session_start();

if (isset($_SESSION['user'])) { 
   $user_id = $_SESSION['user'];
}
if (!isset($user_id)) {
   header('location:login.php');
   exit;
}
include 'config/conne.php';
$output = "";
$users = $dbcon->prepare("SELECT * FROM users WHERE NOT id = ? ORDER BY id DESC");
$users->execute([$user_id]);
if ($users->rowCount() == 0) {
    $output .= "No users are available to chat with";
}elseif ($users->rowCount() > 0) {
    while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
        $chat = $dbcon->prepare("SELECT * FROM messages WHERE reciever_id = ?
        OR sender_id = ? AND sender_id = ? 
        OR reciever_id = ? ORDER BY id DESC LIMIT 1");
        $chat->execute([$row['id'], $row['id'], $user_id, $user_id]);
        $chatting = $chat->fetch(PDO::FETCH_ASSOC);
        $you = "";


        //checking who send message last
        if (isset($chatting['sender_id'])) {
            ($user_id == $chatting['sender_id']) ? $you = "You: " : $you = "";
        }else {
            $you = "";
        }
       
       
       //checking online or offline
        $statuscheck = "";
        ($row['status'] == "Online") ? $statuscheck = '<span class="indicator online">Online</span>' : $statuscheck = '<span class="indicator offline">Offline</span>';
        
        
        
        //checking last available message
        ($chat->rowCount() > 0) ? $display = $chatting['message'] : $display ="No message available";
        (strlen($display) > 25) ? $message = substr($display, 0, 25) : $message = $display;




        $output .='<a href="chatarea.php?user='.$row['id'].'" class="user">
                        <div><img src="'. $row['image'].'" alt=""></div>
                        <div >
                            <p>'. $row['firstname']. " " . $row['lastname'] .'</p>
                            <span>'. $you . $message .'</span>
                        </div>
                        '. $statuscheck .'
                    </a>';
    }
}
include 'require/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class=" categories users">
        <div class="all">
            <div class="head">
                <p>ALL USERS</p>
            </div><br>
            <div class="userslist">
                
                <?= $output ?>    

            </div>
        </div>
    </div>
</body>
</html>


