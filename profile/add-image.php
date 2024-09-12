<?php
session_start();

if(isset($_POST)){
    $image=$_FILES['image'];
    if($image['type']==="image/png"||$image['type']==="image/jpg"||$image['type']==="image/jpeg"){
        //to get the type
        $tmp=explode('.', $image["name"]);
        $file_ext = end($tmp);
        $tmp=explode('.', $_SESSION['user']);
        $name=$tmp[0];
        $image['name']= $name.'.'.$file_ext;
        $target_file="C:\\xampp\htdocs\\p1\\users-image\\".basename($image["name"]);
        $path="..\\users-image\\".basename($image["name"]);
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "E_Book";
        $conn = new mysqli($servername ,$username,$password,$dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("UPDATE USER SET IMAGE=? WHERE ID=?");

        $stmt->bind_param("si", $path, $_SESSION['id']);
        if ($stmt->execute()) {
            $files=scandir('C:\\xampp\htdocs\\p1\\users-image');
            foreach($files as $file){
                $tmp=explode('.',$file);
                $file_name=$tmp[0];
                if($file_name===$name){
                    unlink("C:\\xampp\htdocs\\p1\\users-image\\".$file);
                }
            }
            if (move_uploaded_file($image['tmp_name'], $target_file)) {
                echo "true";
            }
        } else {
            echo "false";
        }
        $stmt->close();
    }
}
