<?php 
    session_start();
    if(isset($_SESSION['user'])){
        include 'config/conne.php';

        $sender_id = $_SESSION['user'];
        $reciever_id = filter_var($_POST['thisincoming_id']);
        $output = "";

        $getmessage = $dbcon->prepare("SELECT * FROM messages WHERE reciever_id = ?
        OR sender_id = ? AND sender_id = ? 
        OR reciever_id = ?");
        $getmessage->execute([$sender_id, $sender_id, $reciever_id, $reciever_id]);

        if ($getmessage->rowCount() > 0) {
            while ($message = $getmessage->fetch(PDO::FETCH_ASSOC)) {
                if ($message['sender_id'] === $sender_id) {
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'. $message['message'] .'</p>
                                        <span>'.$message['time'].'</span>
                                    </div>
                                </div>';
                }else {
                    $output .= '<div class="chat incoming">
                                    <div class="details">
                                        <p>'. $message['message'] .'</p>
                                        <span>'.$message['time'].'</span>
                                    </div>
                                    
                                </div>';
                }
            }
        }else {
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
    }else {
        header("location:login.php");
    }
    echo $output;
?>