<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "learnify";

    $conn = mysqli_connect($servername,$username,$password,$database);

    if(!$conn){
        die("Bağlantı Hatası: " . mysqli_connect_error());
    }

    $sql = "select k.*,od.odAdi from kullanicilar k join ogrenimdurumu od on od.odID = k.ogrenimSeviyesi where kullaniciID = 1";
    $sonuc = mysqli_query($conn,$sql);
    if ($satir = mysqli_fetch_assoc($sonuc)) {
      $kullaniciAdi = $satir["kullaniciAdi"];
      $kullaniciTakmaAdi = $satir["kullaniciTakmaAdi"];
      $kullaniciSoyadi = $satir["kullaniciSoyadi"];
      $kayitTarihi = $satir["kayitTarihi"];
      $cevapSayisi = $satir["cevapSayisi"];
      $soruSayisi = $satir["soruSayisi"];
      $ogrenimSeviyesi = $satir["odAdi"];
      $profilFoto = $satir["profilFoto"];
      $kullaniciPuani = $satir["kullaniciPuani"];
      $email = $satir["email"];
      $cinsiyet = $satir["cinsiyet"];
    }
  ?>