<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/ödevboxicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../genel-css/header.css">
    <link rel="stylesheet" href="../genel-css/footer.css">
    <link rel="stylesheet" href="profil.css">
    
    <title>Profilin</title>
</head>
<body>
  <?php
  
    include("../genel-php/session-query.php");
    include("../genel-php/db-connection.php");
    include("../genel-php/profil-bilgileri.php");
  ?>
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
    
    <div class="container">
        <div class="leftSide">
            <div class="userInfoMain">
                <img class="userImg"src="../profile-images/<?php echo $profilFoto ?>" alt="">  
                <div class="userNames">
                  <h1 class="nickname"><?php echo $kullaniciTakmaAdi; ?></h1>
                  <h3 class="username"><?php echo $kullaniciAdi . " " . $kullaniciSoyadi; ?></h3>
                </div>
                
            </div>
            <div class="userDegree" style="display:inline-block;"><p><?php echo $seviye;?></p></div>
            <div class="puanify">
              <img src="../images/puanify.png" alt="">
              <p><?php echo $kullaniciPuani?> puanify</p>
              <i class="fa-solid fa-circle-question"></i>
            </div>
            <div class="stats">
              <div class="cevaplarStat">
                <p>Cevaplar</p>
                <h2><?php echo $cevapSayisi; ?></h2>
              </div>
              <div class="sorularStat">
                <p>Sorular</p>
                <h2><?php echo $soruSayisi; ?></h2>
              </div>
              <div class="tesekkurStat">
                <p>Teşekkürler</p>
                <h2>0</h2>
              </div>
            </div>
            <div class="userAbout">
              <h2>Hakkında</h2>
              <div class="school">
                <i class="fa-solid fa-building-columns"></i> <h5>Eğitim Durumun: </h5> <p><?php echo $ogrenimSeviyesi; ?></p>
              </div>
              <div class="loginDate">
                <i class="fa-solid fa-calendar-days"></i> <h5>Katılma Tarihin: </h5> <p><?php echo $kayitTarihi; ?></p>
              </div>
            </div>
            <div class="setProfile">
              <button onclick="window.location.href = '../set-profile/set-profile.php'"><i class="fa-solid fa-pen"></i> Profilini Düzenle</button>
            </div>
        </div>
        <div class="rightSide">
          <div class="navBar">
            <button id="repliesBtn">Cevapların</button>
            <button id="questionsBtn">Sorular</button>
          </div>
          <div class="content" id="contentDiv">
              <div class="replies">
                <p>Henüz soru cevaplamadın.</p>
              </div>
              <div class="questions">
                    <?php 
                    $sql = "select s.*,d.dersAdi from sorular s join dersler d on d.dersID = s.dersID where s.kullaniciID = $userID order by s.soruID desc";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='soruDiv'>";
                        echo "<img src='../profile-images/$profilFoto' alt=''>";
                        echo "<p class='soruAciklamasi'>" . substr($row["soruAciklamasi"],0,40) . "...</p>";
                        echo "<p class='soruDers'>{$row['dersAdi']}</p>";
                        echo "</div>";
                      }
                    }
                    else{
                      echo "<p>Henüz soru sormadın.</p>";
                    }
                    ?>
              </div>
          </div>
        </div>
    </div>

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

    <script src="profil.js"></script>
</body>
</html>