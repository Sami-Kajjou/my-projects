<?php
if(isset($_POST)){
    $to = $_POST['email'];
    $random=random_int(1000,9999);
    $subject = "new password";
    $message = "the code is "."$random";
    $headers = "From: E_book@gmail.com";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "E_Book";
    $conn = new mysqli($servername ,$username,$password,$dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt=$conn->query("SELECT ID FROM USER WHERE EMAIL='$to'");
    if($stmt->num_rows>0){
        if(mail( $to,$subject,$message,$headers)){
            echo('{"result":true}');
        }
        else{
            echo('{"result":false}');
        }
    }
}