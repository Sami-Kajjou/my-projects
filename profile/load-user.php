<?php
session_start();
if(isset($_POST)){
    $input_post=$_SESSION['id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "E_Book";
    $conn = new mysqli($servername ,$username,$password,$dbname);
    $stmt=$conn->query("SELECT USERNAME,EMAIL,IMAGE FROM USER WHERE ID='$input_post'");
    $input=array("info"=>array(),"books"=>array(),"friend"=>false,'myProfile'=>false);
    if($stmt->num_rows>0){
        while($row=$stmt->fetch_assoc()){
            $name=$row["USERNAME"];
            $email=$row["EMAIL"];
            $image=$row["IMAGE"];
            $input["info"]=array('name'=>$name,'email'=>$email,'image'=>$image);
            
        }
        $stmt=$conn->query("SELECT BOOKID FROM MYLIBRARY WHERE USERID='$input_post'");
        if($stmt->num_rows>0){
            while($row=$stmt->fetch_assoc()){
                $input["books"][]=$row["BOOKID"];
            }
            $stmt=$conn->query("SELECT * FROM friends WHERE UID='$_SESSION[id]'");
            if($stmt->num_rows>0){
                $input["friend"]=true;
            }
            else{
                $input["friend"]=false;
            }
        }
        
    }
    echo(json_encode($input));
}
