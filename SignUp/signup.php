<?php
session_start(); 
include("db.php");

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["SignUp-button"])) {
    $name = $_POST["Ad"];
    $soyad = $_POST["Soyad"];
    $kullaniciadi = $_POST["nickname"];
    $email = $_POST["email"];
    $sifre = hash('sha512', $_POST["password"]);
    $dogumtarihi = $_POST["dogumTarihi"];
    $egitimduzeyi = $_POST["educationselect"];
    $cinsiyet = $_POST["genderselect"];

  
    $ekle = "INSERT INTO kullanicilar (kullaniciAdi, kullaniciTakmaAdi, kullaniciSoyadi, email, sifre, dogumGunu, ogrenimSeviyesi, cinsiyet)
             VALUES ('$name', '$kullaniciadi', '$soyad', '$email', '$sifre', '$dogumtarihi', '$egitimduzeyi', '$cinsiyet')";

    $calistirekle = mysqli_query($conn, $ekle);

    if (true) {
        
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        $_SESSION['username'] = $kullaniciadi;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['logged_in'] = true;
       
       echo "<script> alert('Kayıt Başarılı!'); window.location.href = '../MainPage/index.php';</script>";

    } else {
        echo "<script>
        alert('Kayıt Oluşturulamadı!');
        window.location.href = 'SignUp.html';
       </script>";
    }

    mysqli_close($conn);
}
?>
