<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learnify";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die("Bağlantı başarısız" . mysqli_connect_error());
}

mysqli_set_charset($conn,"utf8mb4");

?>