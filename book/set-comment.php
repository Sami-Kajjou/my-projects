<?php
session_start();
if(isset($_POST)){
    $comment=$_POST["comment"];
    $bookid=$_POST["bookid"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $userid=$_SESSION['id'];
    $conn = new mysqli($servername ,$username,$password,"E_Book");
    $stmt=$conn->query("INSERT INTO COMMENTS(USERID,BOOKID,COMMENT)VALUES('$userid','$bookid','$comment')");
    if($stmt){
        echo('{"massage":true}');
    }else{
        echo('{"massage":false}');
    }
}