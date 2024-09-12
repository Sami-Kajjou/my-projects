<?php
session_start();
if(isset($_POST)){
    $id=file_get_contents("php://input");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername ,$username,$password,"E_Book");
    $stmt=$conn->query("SELECT ID FROM USER WHERE EMAIL='$_SESSION[user]'");
    $userId;
    if($stmt->num_rows>0){
        while($row=$stmt->fetch_assoc())
            $userId=$row['ID'];
    }
    $stmt=$conn->query("DELETE FROM MYLIBRARY WHERE USERID='$userId' AND BOOKID='$id'");
    if($stmt){
        echo('deleted');
    }

}