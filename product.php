<?php
require_once "actions/connection.php";

$id = $_GET['id'];

$sql = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$sql->execute(array(":id"=>$id));
if($sql->rowCount() > 0){
      $row = $sql->fetch(PDO::FETCH_ASSOC);  
}else{
    die("Error");
}

$stock = "";
$color_stock = "";
if($row['stock'] > 0){
$stock = "In stock";
$color_stock = "green";
}else{
    $stock = "Out of stock";
    $color_stock = "red";
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Men CLOTHES |</title>

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
<body>
<a class="btn btn-danger back" href="index.php">Back</a>



<div class="container">
   <div class="details">
    <center>
        <h1>Product details</h1>
    </center>   
    <br>
       <br>
       <br>
   <div class="row">
        <div class="col-md-6">
            <img width="100%" src="actions/<?php echo $row['img'] ?>" alt="Product">
        </div>

        <div class="col-md-6">
            <h1><?php echo $row['name'] ?></h1>
            <br>
            <p><?php echo $row['des'] ?></p>
            <span style="color: <?php echo $color_stock ?>;" ><?php echo $stock ?></span>
            <br>
            <br>
            <h3><?php echo $row['price'] ?>$</h3> 
            <br>
            <button onclick="alert('Coming soon!')" class="btn btn-secondary" >Buy now</button>  
            <button class="btn btn-primary" 
                         onclick="add_to_cart(this)"
                         data-name="<?php echo $row['name'] ?>"
                         data-price="<?php echo $row['price'] ?>"
                         data-des="<?php echo $row['des'] ?>"
                         data-img="<?php echo $row['img'] ?>"
                         data-stock="<?php echo $row['stock'] ?>"
                         data-id="<?php echo $row['id'] ?>"
            >add to cart</button>  
        </div>
    </div>
   </div>
</div>
<br>
<br>
<br>
<p id="myCart" style="display: none;" ></p>
<p id="count_product" style="display: none;" ></p>
<br>
<div id="alert_div" class="alert_div">
    <span>Your product has been added</span>
</div>
<script src="js/main.js"></script>
</body>
</html>