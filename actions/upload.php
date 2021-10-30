<?php
require_once "connection.php";

$name = trim(strip_tags($_POST['name']));
$price = trim(strip_tags($_POST['price']));
$stock = trim(strip_tags($_POST['stock']));
$des = trim(strip_tags($_POST['description']));
$time = date("Ymdhis");
$success = "no";
$error = "";
$target_dir = "uploads/";
$target_file = $target_dir . "GJ_" .$time . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {

        $uploadOk = 1;
    } else {
        $error = "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $error = "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 99999999) {
    $error = "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $error .= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    if (empty($name) || empty($price) || empty($stock) || empty($des)){
        $error = "Pleas fill in all fields!";
    }else if(strlen($name) < 2){
        $error = "Name is too short min 2 chr.";
    }else if($price < 1){
        $error = "Price can't be less than 1$";
    }else{

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $sql = $pdo->prepare("INSERT INTO products (name, price, stock, des, img) VALUE (:name,:price,:stock,:des,:img)");

            try{



                $sql->execute(array(':name'=>$name,':price'=>$price,':stock'=>$stock,':des'=>$des,':img'=>$target_file));

                $success = "ok";

            }
            catch(PDOException $e){
                $errors[] = $e->getMessage();
            }

        } else {
            $error .= "Sorry, there was an error uploading your file.";
        }
    }



}

if ($error != ""){
    $_SESSION['error'] = $error;
    header("location:../admin/index.php");
}else{

    if ($success == "ok"){

    $_SESSION['error'] = "Your product was successfuly uploaded!";
    header("location:../admin/index.php");
}
}