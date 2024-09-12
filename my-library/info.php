<?php
    session_start();
    $user=$_SESSION['user'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "E_Book";
    $conn = new mysqli($servername ,$username,$password,$dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $id;
    $stmt= $conn->query("SELECT id FROM user WHERE email = '$user'");
    if($stmt->num_rows>0){
        while($rows=$stmt->fetch_assoc())
            $id=$rows['id'];
    }
    $stmt=$conn->query("SELECT BOOKID FROM MYLIBRARY WHERE USERID= $id");
    $booksArr=[];
    if($stmt->num_rows>0){
        while( $rows=$stmt->fetch_assoc()){
            array_push($booksArr,array_values($rows));
        }
        echo(json_encode($booksArr));
    }else{
        echo('{"massage":"You Did Not Add Any Book"}');
    }
    
