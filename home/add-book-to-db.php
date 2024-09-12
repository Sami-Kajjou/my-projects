<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $img = $_FILES['image'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $author = $_POST['author'];
    $url = $_POST['url'];

    $target_file="C:\\xampp\htdocs\\p1\\new_books_image\\".basename($img["name"]);
    $path="..\\new_books_image\\".basename($img["name"]);
    //get connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "E_Book";
    $conn = new mysqli($servername ,$username,$password,$dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //check if it is in DB
    $stmt = $conn->prepare("SELECT * FROM books WHERE title = ? AND author = ?");
    $stmt->bind_param("ss", $title, $author);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows>0){
        echo("the book is already in DB ");
        
    }
    //adding the book to DB & json file
    else{
        //DB
        $stmt=$conn->prepare("INSERT INTO books(title,author,subtitle,image_path,url)VALUES(?,?,?,?,?)");
        $stmt->bind_param("sssss", $title, $author, $subtitle, $path, $url);
        if($stmt->execute()){
            move_uploaded_file($img["tmp_name"], $target_file);

            $stmt = $conn->prepare("SELECT id FROM books WHERE title = ? AND author = ?");
            $stmt->bind_param("ss", $title, $author);
            $stmt->execute();
            $stmt->bind_result($theId);
            $stmt->fetch();
            //json
            $mkjson = json_encode([
                "id" => "$theId",
                "title" => $title,
                "subtitle" => $subtitle,

                "authors" => $author,
                "image" => $path,
                "url" => $url
            ]);
            $arr=json_decode($mkjson,true);
            $file=file_get_contents('C:\\xampp\htdocs\\p1\\js\\books.json');
            $json=json_decode($file,true);
            array_unshift($json['books'] ,$arr);
            $result=file_put_contents('C:\\xampp\htdocs\\p1\\js\\books.json',json_encode($json,JSON_PRETTY_PRINT));
            echo("uplouded successfully");
        }
        else{
            echo("something wrong");
        }
    }
}