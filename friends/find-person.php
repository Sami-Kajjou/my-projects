<?php
session_start();
if(isset($_POST)){
    $search_friend=file_get_contents("php://input");
    $user=$_SESSION['user'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "E_Book";
    $conn = new mysqli($servername ,$username,$password,$dbname);
    if(!$conn){
        echo("error");
    }
    $stmt=$conn->query("SELECT USERNAME,EMAIL,ID,IMAGE FROM USER WHERE USERNAME='$search_friend'");
    if($stmt->num_rows>0){
        while($row=$stmt->fetch_assoc()){
            $user=$row['USERNAME'];
            $email=$row['EMAIL'];
            $id=$row['ID'];
            $image=$row['IMAGE'];
            $temp["users"][]=array('user'=>$user,'email'=>$email,'id'=>$id,'image'=>$image);
        }
        $temp['userId']=$_SESSION['id'];
        echo(json_encode($temp));
       
    }
    else{
        echo('{"error":"not found"}');
    }
    
}
