<?php
require_once "actions/connection.php";

if (isset($_SESSION['login']) && $_SESSION['login']){
header("location:admin/index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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

    <title>Men CLOTHES | Online - SHOP</title>
</head>
<body>
<div class="header_line">
<div class="container">

    <div class="row">
        <div class="col-sm-4">

            <div class="left">
                <ul>
                    <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href=""><i class="fab fa-youtube"></i></a></li>
                    <li><a href=""><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-4">
            <div  class="logo">
                <h1>GJ</h1>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="right">

                <a class="login_link" href="login.php"><i class="fas fa-user"></i>Login</a>

            </div>
        </div>
    </div>






</div>
</div>
<div class="header_tools">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">

                <div style="margin-top: 10px" class="left ">

                    <span class="tel_logo" >  <i class="fas fa-phone-volume"></i></span>
                    <div class="tel">

                        <span style="color: #b88e4f" >CALL US</span>
                        <br>
                        <span>077 557 066</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <center>
                    <h5 class="jones" >GENTALMEN JONES</h5>
                </center>
            </div>
            <div class="col-sm-4">
                <div class="right jj">

                    <ul>
                        <li>
                            <i class="fas fa-search"></i>
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#myModal" >
                            <i class="far fa-heart"></i>
                            <label for=""><span id="count_product" ></span></label>
                        </li>


                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<header>

    <br>

       <nav id="nav" >
           <div class="container">
           <ul style="float: left" >
               <li><a href="">Home</a></li>
               <li><a href="">About Us</a></li>
               <li><a href="">New Collection</a></li>
               <li><a href="">Contact Us</a></li>
           </ul>
               <div class="search">
                   <input id="search" type="search" placeholder="Search..." >
               </div>
   </div>
       </nav>


</header>

<section class="hero">
<div class="container">


        <h1>men's <br> collection</h1>
        <span>From t-shirt, jeans,shirt, watches bogs, sunglasses</span>
        <a href="">Shop Now</a>

</div>
</section>

<section class="products">
    <center>
        <h1 class="product_naslov" >Our new products</h1>
    </center>
    <br>
    <br>

    <div class="container">
        <div id="row" class="row">
    <?php

    $sql = $pdo->prepare("SELECT * FROM products");
    $sql->execute(array());
    if ($sql->rowCount() > 0){

        while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
            ?>

          <div id="col2" class="col-md-4">
              <div class="card" style="width: 100%;box-shadow: 0 0 20px #000000;border: solid 5px #fff">
                  <img width="100%" height="240px" src="actions/<?php echo $row['img'] ?>" class="card-img-top" alt="...">
                  <div class="card-body">
                      <h5 id="col" class="card-title"><?php echo $row['name'] ?></h5>
                   
                      <span style="font-weight: bold;color: #000" ><?php echo $row['price'] ?>$</span> <br> <br>
                      <a
                         onclick="add_to_cart(this)"
                         data-name="<?php echo $row['name'] ?>"
                         data-price="<?php echo $row['price'] ?>"
                         data-des="<?php echo $row['des'] ?>"
                         data-img="<?php echo $row['img'] ?>"
                         data-stock="<?php echo $row['stock'] ?>"
                         data-id="<?php echo $row['id'] ?>"
                         class="btn btn-primary">Add to cart
                      </a>
                      <a href="product.php?id=<?php echo $row['id'] ?>" class="btn btn-info">Info</a>
                  </div>
              </div>
          </div>

            <?php
        }


    }else{
        echo "<h3>No products!</h3>";
    }


    ?>
        </div>
    </div>
</section>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Your Cart</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <div id="myCart"></div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div id="alert_div" class="alert_div">
    <span>Your product has been added</span>
</div>

<!--custom js-->
<script src="js/main.js"></script>

</body>
</html>