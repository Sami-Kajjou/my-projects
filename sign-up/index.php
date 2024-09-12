<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="info">
            <h2>Sign in</h2>
            <form class="login" >
                <div class="con">
                    <label for="user-name">User Name</label>
                    <input class="input" type="text" name="user-name" id="user-name" required>
                </div>
                <div class="con">
                    <label for="email">Email: </label>
                    <input class="input" type="email" name="email" id="email" required>
                </div>
                <div class="con pass">
                    <label for="pass">Password: </label>
                    <input class="input" type="password" name="pass" id="pass" required>
                </div>
                <input type="submit" class="submit" value="send" >
            </form>
            <a href="../login">I Have an Accuont</a>
        </div>
    </div>
    <script src="sign.js"></script>
    
</body>
</html>
<?php
if(isset($_GET["msg"])&&$_GET["msg"]=="email-failed")
echo("
<script>
   let failed =document.createElement('p');
   failed.innerHTML='the Email is already exsist';
   let input = document.querySelectorAll('#email')
   input.forEach(e => {
   e.classList.add('error');
});
document.querySelector('.info').appendChild(failed);
</script>
");
?>