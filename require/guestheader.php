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
</head>
<body>
<header class="newheader">
        <nav>

            <div class="topleft">
                <div class="logo">
                    <img src="image/goka-last-logo.png" alt="logo">
                </div>

                
                
                
            </div>
            <div class="topright">
                
                <i class="fas fa-moon"></i>
                <img src="image/pic-1.jpg" id='user-btn'>
                
            </div>
        </nav>
    </header>
</body>