<?php
    include("db-connection.php");
    $sql = "select k.*,od.odAdi,s.seviyeAdi from kullanicilar k join ogrenimdurumu od on od.odID = k.ogrenimSeviyesi join seviyeler s on s.seviyeID = k.seviye where kullaniciID = $userID";
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
      $seviye = $satir["seviyeAdi"];
    }
  ?>