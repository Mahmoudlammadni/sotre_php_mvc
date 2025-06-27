<?php 
$host="localhost";
$database_name ="store_mvc";
$user="root";
$psw="";
try{
    $connection = new PDO("mysql:host=$host;dbname=$database_name",$user,$psw);
    $connection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
    die('Error de connection:'. $e->getMessage());
}