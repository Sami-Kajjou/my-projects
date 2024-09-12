<?php
session_start();
if(!isset($_SESSION["user"])){
    header("location:../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../main/all.min.css">
    <link rel="stylesheet" type="text/css" href="../main/main.css">
    <link rel="stylesheet" type="text/css" href="friends.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,300;0,400;1,200;1,500;1,600;1,800&display=swap" rel="stylesheet">
    <title>friends</title>
</head>
<body>
<div class="header">
        <div class="user">
            <a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
        </div>
        <div class="logo">
            <a href="../home"><img src="../image/logo.png" alt="logo"></a>
        </div>
        <div class="more-info">
            <a href="#"><i class="fa fa-bars" title="Align Justify"></i></a>
        </div>
</div>
<div class="container">
    <div class="info">
         <ul>
                <li><a href="../home">Home</a></li>
                <li><a href="../my-library">My library</a></li>
                <li><a href="../friends">friends</a></li>
        </ul>
    </div>
    <div class="search-con">
        <div class="search">
            <div class="search-bar">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input type="text" name="search">
            </div>
        </div>
        <div class="nav">
        <div class="people">
        </div>
        <div class="friends">

        </div>
        </div>
    </div>
</div>
<footer>
    <?php echo("<p class='copy'>Created By Sami Kajjou &copy;2024-".date("Y")."</p>");?>
    <div class="media">
        <ul>
            <li><a href="https://www.facebook.com/"><img src="../image/facbook.png"><span> facebook</span> </a></li>
            <li><a href="https://www.youtube.com/"><img src="../image/youtube.png"><span> youtube</span> </a></li>
            <li><a href="https://www.instagram.com/"><img src="../image/instagram.png"><span> instagram</span> </a></li>
            <li><a href="https://x.com/"><img src="../image/x.png"><span> x</span> </a></li>
            <li><a href="https://github.com/"><img src="../image/gethub.png"><span> github</span></a></li>
        </ul>
    </div>
</footer>
<script src="friends.js"></script>
</body>
</html>