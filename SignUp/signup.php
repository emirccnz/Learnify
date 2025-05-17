<link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
<?php

include("db.php");

if (isset($_POST["SignUp-button"])) {
  $name = $_POST["Ad"];
  $soyad = $_POST["Soyad"];
  $kullaniciadi = $_POST["nickname"];
  $email = $_POST["email"];
  $sifre = hash('sha512',$_POST["password"]);
  $dogumtarihi = $_POST["dogumTarihi"];
  $egitimduzeyi = $_POST["educationselect"];
  $cinsiyet = $_POST["genderselect"];


  $ekle = "INSERT INTO kullanicilar (kullaniciAdi, kullaniciTakmaAdi, kullaniciSoyadi, email, sifre, dogumGunu,ogrenimSeviyesi,cinsiyet)
           VALUES ('$name', '$kullaniciadi', '$soyad', '$email', '$sifre', '$dogumtarihi','$egitimduzeyi', $cinsiyet)";

  $calistirekle = mysqli_query($conn, $ekle);

  if ($calistirekle) {
    echo '<div class="alert alert-success" role="alert">
     Kayıt Başarılı Bir Şekilde Eklendi
     </div>';

  } else {
    echo '<div class="alert alert-danger" role="alert">
     Kayıt Oluşturulurken Bir Hata Oluştu
     </div>';
  }

  mysqli_close($conn);
}
?>
