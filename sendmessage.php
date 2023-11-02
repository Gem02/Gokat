<?php 
    session_start();
    if(isset($_SESSION['user'])){

        include 'config/conne.php';

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
    }else{
        header("location:logout.php");
    }


    
?>