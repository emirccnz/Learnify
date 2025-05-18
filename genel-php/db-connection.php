<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "learnify";

    $conn = mysqli_connect($servername,$username,$password,$database);

    if(!$conn){
        die("Bağlantı Hatası: " . mysqli_connect_error());
    }
?>