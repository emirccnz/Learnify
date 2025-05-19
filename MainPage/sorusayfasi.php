<?php

include '../genel-php/session-query.php';
require 'db.php';
include '../genel-php/profil-bilgileri.php';

$soruID = intval($_GET['soruID'] ?? 0);
if($soruID <= 0){
    die("Geçersiz soru numarası");
}

$soruQuery = "select s.soruID,s.soruAciklamasi,s.soruPuani,d.dersAdi,k.kullaniciTakmaAdi as soruSahibiAdi
from sorular s
join dersler d on s.dersID = d.dersID
join kullanicilar k on s.kullaniciID = k.kullaniciID
where s.soruID = ?
";

$stmt = mysqli_prepare($conn, $soruQuery);
mysqli_stmt_bind_param($stmt, "i", $soruID);
mysqli_stmt_execute($stmt);
$soruSonuc = mysqli_stmt_get_result($stmt);
$soru = mysqli_fetch_assoc($soruSonuc);

$cevapQuery = "select c.cevapID,c.cevapMetni,ku.kullaniciTakmaAdi AS cevapSahibiAdi,ku.profilFoto AS cevapSahibiFoto
  FROM cevaplar c
  JOIN kullanicilar ku ON c.kullaniciID = ku.kullaniciID
  WHERE c.soruID = ?
 
";

$stmt2 = mysqli_prepare($conn, $cevapQuery);
mysqli_stmt_bind_param($stmt2, "i", $soruID);
mysqli_stmt_execute($stmt2);
$cevapSonuc = mysqli_stmt_get_result($stmt2);
$cevaplar = mysqli_fetch_all($cevapSonuc, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../genel-css/header.css" />
  <link rel="stylesheet" href="../genel-css/footer.css" />
  <link rel="stylesheet" href="soru.css" />
  
  <title>Soru Detayı</title>
</head>
<body>

 
<header>
        <div class="left-side">
          <a href="../MainPage/indeks.html">
            <img src="../images/ödevboxicon.png" alt="Learnify" />
          </a>
          <h3>learnify</h3>
        </div>
        <div class="input-container">
          <i class="fa-solid fa-magnifying-glass icon"></i>
          <input
            class="search-input"
            type="search"
            placeholder="Herhangi bir soru arayabilirsin..."
          />
        </div>
        <div class="right-side">
          <a href="../Soru/soru.html"> <span class="button-text">soru sor</span></a>
          <span class="icons">
            <i class="fa-regular fa-bell"></i>
          </span>
          <span class="icons">
            <i class="fa-regular fa-user" onclick="location.href = '../Profil/profil.html'"></i>
          </span>
        </div>
      </header>

  <main class="soru-container">

    <div class="soru-detay">
      <div class="soru-header">
        <div class="profil-kutu">
          <img
            src="../profile-images/<?php echo $profilFoto; ?>"
            alt="Profil"
            class="profil-img"
          />
          <span class="kullanici-adi">
            <?php echo htmlspecialchars($soru['soruSahibiAdi']); ?>
          </span>
        </div>
        <div class="ders-etiket">
          <?php echo htmlspecialchars($soru['dersAdi']); ?>
        </div>
      </div>

      <div class="soru-icerik">
        <p><?php echo nl2br(htmlspecialchars($soru['soruAciklamasi'])); ?></p>
      </div>
      <div class="soru-puan">
        <span>+<?php echo intval($soru['soruPuani']); ?> puan</span>
      </div>
    </div>

    <div class="cevaplar-bolumu">
      <h3>Cevaplar</h3>

      <?php if (count($cevaplar) === 0): ?>
        <p>Henüz bu soruya cevap verilmemiş.</p>
      <?php else: ?>
        <?php foreach ($cevaplar as $cevap): ?>
          <div class="cevap-kutu">
            <div class="cevap-header">
              <div class="profil-kutu">
                <img
                  src="<?php echo htmlspecialchars($cevap['cevapSahibiFoto']); ?>"
                  alt="Profil"
                  class="profil-img"
                />
                <span class="kullanici-adi">
                  <?php echo htmlspecialchars($cevap['cevapSahibiAdi']); ?>
                </span>
              </div>
             
            </div>
            <div class="cevap-icerik">
              <p><?php echo nl2br(htmlspecialchars($cevap['cevapMetni'])); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>

 <footer class="footer">
    <div class="footerLearnify">
      <a href="giris-ekrani.html">
        <img src="../images/ödevboxicon.png" alt="icon" />
      </a>
      <h3>Learnify</h3>
    </div>
    <div class="aLinks">
      <a href="" class="footerLinks">Basında</a>
      <a href="" class="footerLinks">Güvenlik</a>
      <a href="" class="footerLinks">Yasal</a>
      <a href="" class="footerLinks">Hizmet Şartları</a>
      <a href="" class="footerLinks">Gizlilik Politikası</a>
      <a href="" class="footerLinks">Destek</a>
      <a href="" class="footerLinks">E-Verify</a>
      <a href="" class="footerLinks">Erişilebilirlik</a>
    </div>
    <div class="socialMediaLinks">
      <a href="https://instagram.com">
        <i class="fa-brands fa-instagram" id="instagramIcon"></i>
      </a>
      <a href="https://facebook.com">
        <i class="fa-brands fa-facebook" id="facebookIcon"></i>
      </a>
      <a href="https://linkedin.com">
        <i class="fa-brands fa-linkedin" id="linkedinIcon"></i>
      </a>
      <a href="https://x.com">
        <i class="fa-brands fa-x-twitter" id="twitterIcon"></i>
      </a>
      <a href="https://youtube.com">
        <i class="fa-brands fa-youtube" id="youtubeIcon"></i>
      </a>
    </div>
  </footer>
</body>
</html>