<?php

    session_start();
    
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user'];
    }else {
        header('location:login.php');
        exit();
    }

    if (isset($_GET['post'])) {

        $post_id = $_GET['post'];
    }else {
        header('location:index.php');
        exit();
    }
    
    include "require/header.php";
?>

<div class="centered">

    <div class="feed" data-postid="<?= $post_id ?>">



    </div>

</div>

<script>

    const postdiv = document.querySelector('.centered .feed');

    fetch_post();

    function fetch_post(){
        var action = 'fetchThispost';
        var post_id = postdiv.getAttribute('data-postid');
        $.ajax({
        url:'thispostaction.php',
        method:"POST",
        data:{post_id:post_id, action:action},
        success:function(data){
           $('.feed').html(data);
           fetch_post();
        }
        })
    }

    $(document).on('click', '.like_button', function(){
        window.alert('helllllllll');
        
        
    })


</script>
