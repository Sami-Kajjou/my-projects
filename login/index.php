
<!DOCTYPE html>
<?php
if(isset($_COOKIE["email"])&&isset($_COOKIE["email"])){
        session_start();
        $_SESSION['user']=$_COOKIE["email"];
        $_SESSION['id']=$_COOKIE["id"];
        header("location:../home");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="sign.css">
    <title>Document</title>
</head>
<body>
    
    
    <div class="container">
        <div class="info">
            <h2>Log in</h2>
            <form class="login">
                <div class="con">
                    <label for="email email">Email: </label>
                    <input class="input" type="email" name="email" id="email" required>
                </div>
                <div  class="con pass">
                    <label for="pass">Password: </label>
                    <input class="input" type="password" name="pass" id="pass" required>
                </div>
                <input type="submit" class="submit" value="send">
            </form>
            <a href="../set-password">Forget Your Password ?</a>
        </div>
    </div>
    <?php
    if(isset($_GET["msg"])&&$_GET["msg"]=="failed")
    echo("
    <script>
    let failed =document.createElement('p');
    failed.innerHTML='the user name or the password is wrong try agin';
    let input = document.querySelectorAll('.input');
    input.forEach(e => {
        e.classList.add('error');
    });
    document.querySelector('.info').appendChild(failed);
    </script>

    ");
?>
<script src="sign.js"></script>

</body>
</html>