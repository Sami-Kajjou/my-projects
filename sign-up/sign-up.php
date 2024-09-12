<?php
if(isset($_POST)){
    $arr=array('sets'=>false);
    $user = $_POST["user-name"];
    $userPass=$_POST["pass"];
    $email = $_POST["email"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername ,$username,$password,"E_Book");
    $emailcheck = $conn->query("SELECT * FROM user WHERE email = '$email'");
    if (mysqli_num_rows($emailcheck)===0) {
        $result = $conn->query("INSERT INTO user(Username,Email,PASSWORD) VALUES 
        ('$user','$email', '$userPass')"); 
        if($result){
            $result = $conn->query("SELECT ID FROM USER WHERE EMAIL='$email' AND PASSWORD ='$userPass'");
            if ($result->num_rows>0) {
                session_start();
                $_SESSION['user']=$email;
                while($row=$result->fetch_assoc()){
                    $_SESSION['id']=$row['ID'];
                    setcookie("email",$email, time() - (86400 * 30), "/");
                    setcookie("id",$row['ID'], time() -(86400 * 30), "/");
                    $arr['sets']=true;
                }
                $_SESSION['user']=$email;
                
            }
        }
        echo(json_encode($arr));
    }else{
        echo(json_encode($arr));
    }
    
    
}
