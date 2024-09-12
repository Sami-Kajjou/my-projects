<?php
session_start();
if(isset($_POST)){
    $arr=array("userInfo"=>array("books"=>array()));
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername ,$username,$password,"E_Book");
    $userid=$_SESSION['id'];
    $stmt=$conn->query("SELECT USERNAME,IMAGE FROM USER WHERE ID='$userid'");
    if($stmt->num_rows>0){
        while($row=$stmt->fetch_assoc()){
            
            $arr["userInfo"]=array("name"=>$row["USERNAME"],"image"=>$row["IMAGE"]);
        }
        $stmt=$conn->query("SELECT BOOKID FROM MYLIBRARY WHERE USERID='$userid'");
        if($stmt->num_rows>0){
            while($row=$stmt->fetch_assoc()){
                $arr["userInfo"]['books'][]=$row['BOOKID'];
            }
        }
    }
    echo(json_encode($arr));
}