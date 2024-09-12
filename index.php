<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main/index.css">
    <title>welcome</title>
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="home.php"><img src="image/logo.png" alt="logo"></a>
        </div>
        <div class="log-sign">
            <a href="login">login</a>
            <a href="sign-up">sign</a>
        </div>
    </div>
    <div class="container">
        <div class="welcome-div">
            <div class="text">
                <h2>Welcome</h2>
                <p>To E-Book Website</p>
            </div>
        </div>
        <div class="friends-div">
            <div class="con">
                <div class="image">
                    <img src="image/Screenshot_4-9-2024_203552_localhost.jpeg" alt="">
                </div>
                <p>you can add your friends and see what there library to see there books</p>
            </div>
        </div>
        
    </div>
    <footer>
    <?php echo("<p class='copy'>Created By Sami Kajjou &copy;2024-".date("Y")."</p>");?>
    <div class="media">
        <ul>
            <li><a href="https://www.facebook.com/"><img src="image/facbook.png"><span> facebook</span> </a></li>
            <li><a href="https://www.youtube.com/"><img src="image/youtube.png"><span> youtube</span> </a></li>
            <li><a href="https://www.instagram.com/"><img src="image/instagram.png"><span> instagram</span> </a></li>
            <li><a href="https://x.com/"><img src="image/x.png"><span> x</span> </a></li>
            <li><a href="https://github.com/"><img src="image/gethub.png"><span> github</span></a></li>
        </ul>
    </div>
</footer>
</body>
</html>