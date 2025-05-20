<?php
session_start(); 
include("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["SignUp-button"])) {
    $name = $_POST["Ad"];
    $soyad = $_POST["Soyad"];
    $kullaniciadi = $_POST["nickname"];
    $email = $_POST["email"];
    $sifre = hash('sha512', $_POST["password"]);
    $dogumtarihi = $_POST["dogumTarihi"];
    $egitimduzeyi = $_POST["educationselect"];
    $cinsiyet = $_POST["genderselect"];

    $emailKontrol = "SELECT * FROM kullanicilar WHERE email = '$email'";
    $emailSorgu = mysqli_query($conn, $emailKontrol);

    if (mysqli_num_rows($emailSorgu) > 0) {
        echo "<script>
        alert('Girilen E-mail zaten kayıtlı!');
        window.location.href = '../Login/LearnifyLogin.php';
        </script>";
        exit();
    }

    
    $kullaniciAdiKontrol = "SELECT * FROM kullanicilar WHERE kullaniciTakmaAdi = '$kullaniciadi'";
    $kullaniciAdiSorgu = mysqli_query($conn, $kullaniciAdiKontrol);

    if (mysqli_num_rows($kullaniciAdiSorgu) > 0) {
        echo "<script>
        alert('Kullanıcı Adı Daha Önceden Kullanılmış!');
        window.location.href = '../Login/LearnifyLogin.php';
        </script>";
        exit();
    }


    $ekle = "INSERT INTO kullanicilar (kullaniciAdi, kullaniciTakmaAdi, kullaniciSoyadi, email, sifre, dogumGunu, ogrenimSeviyesi, cinsiyet)
             VALUES ('$name', '$kullaniciadi', '$soyad', '$email', '$sifre', '$dogumtarihi', '$egitimduzeyi', '$cinsiyet')";

    $calistirekle = mysqli_query($conn, $ekle);

    if ($calistirekle) {
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        $_SESSION['username'] = $kullaniciadi;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['logged_in'] = true;

        echo "<script>
        alert('Kayıt Başarılı!');
        window.location.href = '../Login/LearnifyLogin.php';
        </script>";
    } else {
        echo "<script>
        alert('Kayıt Oluşturulamadı!');
        window.location.href = '../Login/LearnifyLogin.php';
        </script>";
    }

    mysqli_close($conn);
}
?>
