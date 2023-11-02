<?php

        
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
}
if(!isset($user_id)) {
    header('location:login.php');
    die();
}

require "config/conne.php";
$select_user = $dbcon->prepare("SELECT * FROM users WHERE id = ?");
$select_user->execute([$user_id]);
$user = $select_user->fetch(PDO::FETCH_ASSOC);
    
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="assets/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="loader">
        <div class="ring"></div>
        <span>Loading...</span>
    </div>
    <header class="newheader">
        <nav>

            <div class="topleft">
                <div class="logo">
                    <img src="image/goka-last-logo.png" alt="logo">
                </div>

                
                <form action="search.html" method="post" class="search-form">
                    <input type="text" name="search_box" required placeholder="search..." maxlength="20">
                    <button type="submit" class="fas fa-search"></button>
                </form>
                
            </div>
            <div class="topright">
                
                <i class="fas fa-list-ul"></i>
                <i class="fas fa-search topnavsearch"></i>
                <i class="fas fa-bell"></i>
                <i class="fas fa-sun" id="toggle-btn"></i>

                <?php if($user['image'] === null){ ?>
                    <img src="image/pic-1.jpg" id='user-btn'>
                <?php }else { ?>
                    <img src="<?= $user['image'] ?>" id='user-btn'>
               <?php } ?> 
                
            </div>

            <div class="profile">
                <ul>
                    <li><h5><?= $user['firstname'] ?> <?= $user['lastname'] ?></h5></li>
                    <li>
                        <a href="profile.php?id=<?= $user_id ?>">Profile</a>
                    </li>
                    <li>
                        <a href="settings.php">Settings</a>
                    </li>
                    <li>
                        <a href="">Help</a>
                    </li>
                    <li>
                        <a  class="logoutbtn">Logout</a>
                    </li>
                </ul>
            </div>

            <div class="notification">
                <h5>NOTIFICATIONS</h5>
                <hr>
                <div class="notificationarea">
                    <p>No Notifications</p>
                </div>
            </div>
        </nav>
    </header>

    <main class="navleftside">
        <div  class="leftside" style="position:fixed">
            <a href="profile.php?id=<?= $user_id ?>" class="img">
            <?php if($user['image'] === null){ ?>
                    <img src="image/pic-1.jpg" id='user-btn'>
                <?php }else { ?>
                    <img src="<?= $user['image'] ?>" id='user-btn'>
               <?php } ?> 
              
                <p><strong>Profile</strong> </p>
            </a>

            <a href="index.php" class="img">
                <img src="image/home.png">
                <p>Home</p>
            </a>

            <a href="customers.php" class="img">
                <img src="image/group.png">
                <p>Customers</p>
            </a>

            <a href="chatindex.php" class="img">
                <img src="image/toppng.com-messages-icon-ios-7-512x512.png">
                <p>Messages</p>
            </a>

            <a href="categories.php" class="img">
                <img src="image/marketplace.png">
                <p>Categories</p>
            </a>
            <a href="transactions.php" class="img">
                <img src="image/toppng.com-dollar-logo-png-transparent-background-219x219.png">
                <p>Transactions</p>
            </a>
            <a href="extras.php" class="img">
                <img src="image/toppng.com-tools-settings-options-round-blue-icon-504x504.png">
                <p>Extras</p>
            </a>
            <a href="settings.php" class="img">
                <img src="image/toppng.com-options-settings-gear-icon-free-1838x1920.png">
                <p>Settings</p>
            </a>
            
            <br>
             <h2>Recent Customers</h2>

        
            <a class="img">
                <img src="image/contact_3.jpg">
                <p>Web Designer</p>
            </a>

            <a class="img">
                <img src="image/contact_4.jpg">
                <p>Web Designer</p>
            </a>

            <a class="shortcuts">
                <img src="image/contact_5.jpg">
                <p>Web Designer</p>
            </a>

            <a class="shortcuts">
                <img src="image/contact_6.jpg">
                <p>Web Designer</p>
            </a>

            <a class="shortcuts">
                <img src="image/shortcuts_5.webp">
                <p>PC Shop</p>
            </a>
        </div>
    </main>
    

 
    <script src="assets/jquery/jquery-3.6.0.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="sweetalert.min.js" type="text/javascript"></script>
    <script src="assets/toastr/toastr.min.js"></script>
    <script>
        const Loader = document.querySelector('.loader');
        window.addEventListener("load", () => {
            Loader.style.display = "none"
        })
        let profile = document.querySelector('.newheader nav .profile');

        try {
            document.querySelector('#user-btn').onclick = () =>{
            profile.classList.toggle('active');
            leftmenu.classList.remove('active');
            searchbar.classList.remove('active');
            notification.classList.remove('active');
            }
        } catch (error) {
            //window.alert('To enjoy the experience You need to login first');
        }

        window.onscroll = () =>{
            leftmenu.classList.remove('active');
        }


        let leftmenu = document.querySelector('main .leftside');

        document.querySelector('.fa-list-ul').onclick = () =>{
        leftmenu.classList.toggle('active');
        searchbar.classList.remove('active');
        notification.classList.remove('active');
        profile.classList.remove('active');
        }
        

        let searchbar = document.querySelector('.newheader .topleft .search-form');

        document.querySelector('.topnavsearch').onclick = () =>{
        searchbar.classList.toggle('active');
        leftmenu.classList.remove('active');
        notification.classList.remove('active');
        profile.classList.remove('active');
        }

        let notification = document.querySelector('.newheader nav .notification');
        document.querySelector('.topright .fa-bell').onclick = () =>{
        notification.classList.toggle('active');
        leftmenu.classList.remove('active');
        searchbar.classList.remove('active');
        profile.classList.remove('active');
        }

        const navList = document.querySelectorAll('.navleftside .leftside a');
        navList.forEach(element => {
            element.onclick = () =>{
                element.classList.add('active');
            }
        });

        document.querySelector('.logoutbtn').onclick = () => {
            swal({
                  title: "Are you sure?",
                  text: "You will be logged out from Gokat Services!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                  })
                  .then((logout) => {
                  if (logout) {
                        window.location.href = "logout.php"
                  } else {
                  }
            })
      }
        

            
        let toggleBtn = document.getElementById('toggle-btn');
        let body = document.body;
        let darkMode = localStorage.getItem('dark-mode');

        const enableDarkMode = () =>{
            toggleBtn.classList.replace('fa-sun', 'fa-moon');
            body.classList.add('dark');
            localStorage.setItem('dark-mode', 'enabled');
        }

        const disableDarkMode = () =>{
            toggleBtn.classList.replace('fa-moon', 'fa-sun');
            body.classList.remove('dark');
            localStorage.setItem('dark-mode', 'disabled');
        }

        if(darkMode === 'enabled'){
            enableDarkMode();
        }
        toggleBtn.onclick = (e) =>{
        darkMode = localStorage.getItem('dark-mode');
        if(darkMode === 'disabled'){
            enableDarkMode();
        }else{
            disableDarkMode();
        }
        }
    </script>
</body>
</html>