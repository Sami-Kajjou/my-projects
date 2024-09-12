<?php
if(isset($_POST)){
    $input=file_get_contents("php://input");
    $arr=array('comments'=> array());
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername ,$username,$password,"E_Book");
    $stmt=$conn->query("SELECT COMMENT,USERID FROM COMMENTS WHERE BOOKID='$input'");
    if($stmt->num_rows>0){
        while($row=$stmt->fetch_assoc()){
            $arr['comments'][]=array("comment"=>$row['COMMENT'],"userId"=>$row['USERID']);
        }
        foreach ($arr['comments'] as $key => $value) {
            // print_r($value); it is an array 
            $stmt=$conn->query("SELECT IMAGE,USERNAME FROM USER WHERE ID='$value[userId]'");
            if($stmt->num_rows>0){
                while($row=$stmt->fetch_assoc()){
                    $value["userImage"]=$row['IMAGE'];
                    $value["userName"]=$row['USERNAME'];
                    $arr['comments'][$key]=$value;
                }
            }
        }
       
    }
    else{
        $arr['comments']=NULL;
    }
    echo(json_encode($arr)); 
   
}