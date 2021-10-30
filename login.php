<?php
require_once "actions/connection.php";

if (isset($_SESSION['login']) && $_SESSION['login']){
    header("location:admin/index.php");
}


$error = "error";
$visible = "hidden";
if (isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    $visible = "visible";
    unset($_SESSION['error']);
}



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Men CLOTHES</title>

    <!--Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <!--custom css-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-image: url('img/pexels-andrea-piacquadio-845434.jpg');background-size: cover" >

<a class="btn btn-danger back" href="index.php">Back</a>

<center>
    <form action="actions/login_action.php"  method="post" class="login_form" >
        <h2>Login for admin</h2>
        <br>
        <br>
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="password" name="password" placeholder="Your Password" required>
        <button name="submit" type="submit"  class="btn btn-primary" >Login</button>
        <br>
        <br>
        <span class="error" style="visibility: <?php echo $visible; ?>" ><?php echo $error; ?></span>
    </form>
</center>

</body>
</html>