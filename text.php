<?php
    require "config/conne.php";
    $select = $dbcon->prepare('SELECT posts.id, posts.post_image, posts.category, users.work FROM posts LEFT JOIN users ON posts.poster_id = users.id WHERE post_status = ?');
    $select->execute(['active']);
    
?>    

<?php
 while ($row = $select->fetch(PDO::FETCH_ASSOC) ) { ?>
    <p><?= $row['post_image'] ?></p>
<?php } ?>
