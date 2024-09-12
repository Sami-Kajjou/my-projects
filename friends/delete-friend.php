<?php
session_start();
if(isset($_POST)){
    $input=file_get_contents("php://input");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "E_Book";
    $userId=$_SESSION['id'];
    $conn = new mysqli($servername ,$username,$password,$dbname);
    if(!$conn){
        echo("error");
    }
    $stmt=$conn->query("DELETE FROM FRIENDS WHERE FID='$input' AND UID='$userId'OR FID='$userId' AND UID='$input'");
    if($stmt){
        echo('{"result":true}');
    }
    else{
        echo('{"result":"false}');
    }
}