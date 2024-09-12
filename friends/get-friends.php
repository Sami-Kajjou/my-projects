<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "E_Book";
$conn = new mysqli($servername ,$username,$password,$dbname);
if(!$conn){
    echo("error");
}
$friends=array("friends"=>array());
$stmt=$conn->query("SELECT FID FROM FRIENDS WHERE UID='$_SESSION[id]'");
if($stmt->num_rows>0){
    while($row=$stmt->fetch_assoc()){
        $friend=$row['FID'];
        $temp[]=$friend;
    }
    foreach ($temp as $key => $value) {
        $stmt=$conn->query("SELECT USERNAME,EMAIL,ID,IMAGE FROM USER WHERE ID='$value'");
        if($stmt->num_rows>0){
            while($row=$stmt->fetch_assoc()){
                $user=$row['USERNAME'];
                $email=$row['EMAIL'];
                $id=$row['ID'];
                $image=$row['IMAGE'];
                $friends["friends"][]=array('user'=>$user,'email'=>$email,'id'=>$id,'image'=>$image);
            }
            
        }
    }
}
$stmt=$conn->query("SELECT UID FROM FRIENDS WHERE FID='$_SESSION[id]'");
if($stmt->num_rows>0){
    while($row=$stmt->fetch_assoc()){
        $friend=$row['UID'];
        $tmp[]=$friend;
    }
    foreach ($tmp as $key => $value) {
        $stmt=$conn->query("SELECT USERNAME,EMAIL,ID,IMAGE FROM USER WHERE ID='$value'");
        if($stmt->num_rows>0){
            while($row=$stmt->fetch_assoc()){
                $user=$row['USERNAME'];
                $email=$row['EMAIL'];
                $id=$row['ID'];
                $image=$row['IMAGE'];
                $friends["friends"][]=array('user'=>$user,'email'=>$email,'id'=>$id,'image'=>$image);
            }
            
        }
    }
}
echo(json_encode($friends));