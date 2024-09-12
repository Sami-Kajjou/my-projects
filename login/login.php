<?php
    if(isset($_GET["msg"])&&$_GET["msg"]=="failed")
    echo("
    <script>
    let failed =document.createElement('p');
    failed.innerHTML='the user name or the password is wrong try agin';
    let input = document.querySelectorAll('.input');
    input.forEach(e => {
        e.classList.add('error');
    });
    document.querySelector('.info').appendChild(failed);
    </script>
    
    ");
    
    if(isset($_POST)){
        $arr=array('sets'=>false);
        $userPass=$_POST["pass"];
        $email = $_POST["email"];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new mysqli($servername ,$username,$password,"E_Book");
        $result = $conn->query("SELECT ID FROM USER WHERE EMAIL='$email' AND PASSWORD ='$userPass'");
        if ($result->num_rows>0) {
            session_start();
            while($row=$result->fetch_assoc()){
                $_SESSION['id']=$row['ID'];
                setcookie("email",$email, time() - (86400 * 30), "/");
                setcookie("id",$row['ID'], time() -(86400 * 30), "/");
                $arr['sets']=true;
            }
            // $result = $conn->query("SELECT BOOKID FROM MYLIBRARY WHERE USERID= '$_SESSION[id]'");
            // if ($result->num_rows>0) {
            //     while($row=$result->fetch_assoc()){
            //         $_SESSION['books'][]=$row['ID'];
            //     }
            // }
            $_SESSION['user']=$email;
            echo(json_encode($arr));
        
            }
        else{
            echo(json_encode($arr));
            

        }
    
}   

