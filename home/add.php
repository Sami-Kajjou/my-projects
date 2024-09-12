<?php
//adding book to user
session_start();
$post_id = file_get_contents("php://input");
$bookid=json_decode($post_id);
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername ,$username,$password,"E_Book");
$id=$_SESSION['id'];
$chick=$conn->query("SELECT * FROM mylibrary WHERE userID='$id' and bookID= '$bookid'");
if($chick->num_rows>0){
echo("you alreadey added it");
}
else{
    $result=$conn->query("INSERT INTO mylibrary(userID,bookID)VALUES('$id','$bookid')");
    if($result){
        echo ("you now added it to your library");
        $conn->close();
    }
    else {
        echo ("dose not added");
        $conn->close();
    }
}

