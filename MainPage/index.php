<?php

require 'db.php';
include '../genel-php/session-query.php';

$userID = intval($_SESSION['kullaniciID']);
$userQ = mysqli_prepare($conn, "SELECT kullaniciTakmaAdi, profilFoto FROM kullanicilar WHERE kullaniciID = ?");
mysqli_stmt_bind_param($userQ, "i", $userID);
mysqli_stmt_execute($userQ);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($userQ));


$dersQ = mysqli_query($conn, "SELECT dersID, dersAdi FROM dersler");
$dersler = mysqli_fetch_all($dersQ, MYSQLI_ASSOC);

$profilFoto = !empty($user['profilFoto']) ? '../profile-images/' . $user['profilFoto'] : '';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../images/ödevboxicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="../genel-css/header.css" />
  <link rel="stylesheet" href="../genel-css/footer.css" />
  <link rel="stylesheet" href="styles.css" />
  <title>Learnify</title>
</head>
<body id="body">

  <header>
    <div class="left-side">
      <a href="index.php">
        <img src="../images/ödevboxicon.png" alt="Learnify" />
      </a>
      <h3>learnify</h3>
    </div>

    <div class="input-container">
      <i class="fa-solid fa-magnifying-glass icon"></i>
      <input
        id="searchInput"
        class="search-input"
        type="search"
        placeholder="Herhangi bir soru arayabilirsin..."
      />
    </div>

    <div class="right-side">
      <a href="../Soru/soru.php"><span class="button-text">soru sor</span></a>
      <div class="notificationWrapper">
        <span class="icons notification-icon">
          <i class="fa-regular fa-bell"></i>
        </span>
        <div class="notificationPopup" style="display:none;">
          <div class="popupArrow"></div>
          <h2>Bildirimler</h2>
          <p>Learnify' a Hoşgeldiniz.</p>
          <p>Kayıt başarılı</p>
          <div class="notificationItem">
            <img style="height: 15%; width: 15%;" src="/images/puanify.png" alt="" />
            <span>+5 puan hesabına eklendi.</span>
          </div>
        </div>
      </div>

      <span class="user-profile">
        <a href="../set-profile/set-profile.php">
          <img class="userProfile"
          src="<?php echo $profilFoto; ?>"
          alt="Profil"
          
        />
        </a>
        
    </div>
  </header>


  <div class="container">
 
    <nav class="nav-bar">
      <div>
        <h3>Konular</h3>
        <ul class="nav-bar-items" id="dersListesi">

          <li>
            <div class="nav-bar-items-icon nav-bar-item">
           
              <a href="#" data-dersid="">Bütün konular</a>
            </div>
          </li>
          <?php foreach ($dersler as $d): ?>
            <li>
              <div class="nav-bar-items-icon nav-bar-item">
              
                <a href="#" data-dersid="<?php echo $d['dersID']; ?>">
                  <?php echo htmlspecialchars($d['dersAdi']); ?>
                </a>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </nav>
  
    <main class="content">

      <div class="box">
        <div class="box-header">
          <img src="../images/brain.jpg" alt="" />
          <span>Beyin-Yardımcı</span>
        </div>
        <div class="box-content">
          <div>
            <p>Ne öğrenmek istersin?</p>
          </div>
          <div class="selects">
    
            <select id="filterDers">
              <option value="">Bütün Konular</option>
              <?php foreach ($dersler as $d): ?>
                <option value="<?php echo $d['dersID']; ?>">
                  <?php echo htmlspecialchars($d['dersAdi']); ?>
                </option>
              <?php endforeach; ?>
            </select>

     
            <select id="filterSeviye">
              <option value="">Tüm seviyeler</option>
              <option value="0">İlkokul</option>
              <option value="1">Ortaokul</option>
              <option value="2">Lise</option>
              <option value="3">Üniversite+</option>
            </select>

           
            <select id="filterCevap">
              <option value="">Bütün</option>
              <option value="unc">Çözülmemiş</option>
              <option value="sol">Çözülmüş</option>
            </select>
          </div>
        </div>
      </div>

 
      <div class="selects-part2">
        <select class="select-mini" id="filterDers-mobile">
          <option value="">Bütün Konular</option>
          <?php foreach ($dersler as $d): ?>
            <option value="<?php echo $d['dersID']; ?>">
              <?php echo htmlspecialchars($d['dersAdi']); ?>
            </option>
          <?php endforeach; ?>
        </select>
        <select class="select-mini" id="filterSeviye-mobile">
          <option value="">Tüm seviyeler</option>
          <option value="0">İlkokul</option>
          <option value="1">Ortaokul</option>
          <option value="2">Lise</option>
          <option value="3">Üniversite+</option>
        </select>
        <select class="select-mini" id="filterCevap-mobile">
          <option value="">Bütün</option>
          <option value="unc">Çözülmemiş</option>
          <option value="sol">Çözülmüş</option>
        </select>
      </div>

      <div id="soruListesi"></div>
    </main>

    <aside class="side-bar">
      <div class="side-bar-title">
        <i class="fa-solid fa-crown icon"></i>
        <h3>En Çok Soru Çözenler</h3>
      </div>
      <select name="" id="side-bar-select">
        <option value="1">Günlük</option>
        <option value="2">Haftalık</option>
        <option value="3">Aylık</option>
        <option value="4">Genel</option>
      </select>
      <ul class="side-bar-items">
        <li class="side-bar-item">
          <img src="../images/sercan.jpg" alt="" />
          <span class="user-name">sercancintosunn</span>
          <span class="score">1424p</span>
        </li>
        <li class="side-bar-item">
          <img src="../images/IMG-20241215-WA0007.jpg" alt="" />
          <span class="user-name">enes.kvtt</span>
          <span class="score">1017p</span>
        </li>
        <li class="side-bar-item">
          <img src="../images/IMG-20241215-WA0005.jpg" alt="" />
          <span class="user-name">muhammedalgil_</span>
          <span class="score">901p</span>
        </li>
        <li class="side-bar-item">
          <img src="../images/IMG-20241215-WA0006.jpg" alt="" />
          <span class="user-name">emirc_cngz2</span>
          <span class="score">726p</span>
        </li>
      </ul>
    </aside>
 

    <section class="scroll-top">
      <a href="#body">
        <i class="fas fa-angle-up"></i>
      </a>
    </section>
  </div>

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


  <script src="app.js"></script>
</body>
</html>
