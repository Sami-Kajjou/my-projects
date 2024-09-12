<?php
session_start();
if(isset($_POST)){
    $input=file_get_contents('php://input');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "E_Book";
    $conn = new mysqli($servername ,$username,$password,$dbname);
        $stmt=$conn->query("INSERT INTO FRIENDS(UID,FID) VALUES($_SESSION[id],$input)");
        if($stmt){
            echo("you become friend with it");
           
        }
    
}