<?php
require_once "connection.php";
if (isset($_POST['submit'])){
    $username= trim(strip_tags($_POST['name']));
    $password = trim(strip_tags($_POST['password']));

    if (empty($username) || empty($password)){
        $_SESSION['error'] = "Fill in all fields";
        header("location:../login.php");
    }else{
    $sql = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $sql->execute(array(":username"=>$username));
    if ($sql->rowCount() > 0){
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password,$row['password'])){

            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $password;
            header("location:../admin/index.php");

        }else{
            $_SESSION['error'] = "Incorrect password or username!";
            header("location:../login.php");
        }
    }else{
        $_SESSION['error'] = "Incorrect password or username!";
        header("location:../login.php");
    }
     }
}else{
    header("location:../login.php");
}
