<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/ödevboxicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../genel-css/header.css">
    <link rel="stylesheet" href="../genel-css/footer.css">
    <link rel="stylesheet" href="cevapla.css">
    <title>Cevapla</title>
</head>
<body>
  <?php
  include("../genel-php/session-query.php");
  include("../genel-php/profil-bilgileri.php");
  if($_GET['soruID']){
    $soruID = $_GET['soruID'];
    $sorgu = "select s.*,k.profilFoto,k.kullaniciTakmaAdi,k.profilFoto from sorular s join kullanicilar k on k.kullaniciID = s.kullaniciID   where soruID = $soruID";
    $result = mysqli_query($conn,$sorgu);
    $row = mysqli_fetch_assoc($result);
  }
  else{
    echo "<script>alert('Soru yüklenirken bir hata oluştu.')</script>";
  }
  ?>
    <header>
        <div class="left-side">
          <a href="../MainPage/index.php">
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
          <a href="#"> <span class="button-text">soru sor</span></a>
          <span class="icons">
            <i class="fa-regular fa-bell"></i>
          </span>
          <span class="icons">
            <i class="fa-regular fa-user" onclick="location.href = '../Profil/profil.php'"></i>
          </span>
        </div>
      </header>

    <form action="cevap-kaydet.php?soruID=<?php echo $soruID;?>" method="post" enctype = "multipart/form-data">
    <div class="replyContainer">
        <div class="quest" id="quest">
            <div class="content-header">
                <div class="profile">
                    <img src="../profile-images/<?php echo $row['profilFoto'];?>" alt="user-profil" />
                    <span><?php echo $row['kullaniciTakmaAdi'];?></span>
                  </div>
            </div>
            <div class="questionText">
                
                <div class="questText">
                  <?php if($row['fotograf']){
                  echo "<div src='qtImgDiv'><img src= '../Soru/soru-fotolari/{$row['fotograf']}'/></div>";
                } ?>
                <p><?php echo $row['soruAciklamasi']; ?></p></div>
            </div>
          </div>
            <div class="reply">
            <div class="content-header">
                <div class="profile">
                    <img src="../profile-images/<?php echo $profilFoto;?>" alt="user-profil" />
                    <span><?php echo $kullaniciTakmaAdi;?></span>
                  </div>
            </div>
            <div class="replies">
                <textarea class="replyText" placeholder="Cevabını buraya yaz." name="cevapMetni"></textarea>
            </div>
          </div>

    </div>
    <div class="buttonDiv">
        <button class="send" type="submit">Cevabını Gönder</button>
    </div>
    </form>

      <footer class="footer">
        <div class="footerLearnify">
            <a href="giris-ekrani.html"><img src="../images/ödevboxicon.png" alt="icon"></a>
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
            <a href="instagram.com"><i class="fa-brands fa-instagram" id="instagramIcon"></i></a>
            <a href="facebook.com"><i class="fa-brands fa-facebook" id="facebookIcon"></i></a>
            <a href="linkedin.com"><i class="fa-brands fa-linkedin" id="linkedinIcon"></i></a>
            <a href="x.com"><i class="fa-brands fa-x-twitter" id="twitterIcon"></i></a>
            <a href="youtube.com"><i class="fa-brands fa-youtube" id="youtubeIcon"></i></a>
        </div>
    </footer>
    <script src="cevapla.js"></script>
</body>
</html>