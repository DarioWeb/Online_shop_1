<?php
session_start();
$dsn = 'mysql:dbname=online_shop_1;host=localhost';
$user = 'root';
$password = '';
try
{
    $pdo = new PDO($dsn,$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection error".$e->getMessage();
    die();
}