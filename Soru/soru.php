<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../images/ödevboxicon.png" type="image/x-icon">
    <title>Soru Sor</title>
    <link rel="stylesheet" href="../genel-css/header.css" />
    <link rel="stylesheet" href="../genel-css/footer.css" />
    <link rel="stylesheet" href="soru.css" />
  </head>

  <body>
    <?php
      include("../genel-php/db-connection.php"); 
      include("../genel-php/profil-bilgileri.php")
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
        <a href="#"> <span class="button-text">soru sor</span></a>
        <span class="icons">
          <i class="fa-regular fa-bell"></i>
        </span>
        <span class="icons">
          <i class="fa-regular fa-user" onclick="location.href = '../Profil/profil.php'"></i>
        </span>
      </div>
    </header>

    <form action="soru-sor.php" method="post" enctype="multipart/form-data">
      <div class="container">
      <div class="box">
        <h2
          style="
            font-size: 2rem;
            margin-bottom: 10px;
            color: white;
            display: block;
          "
        >
          Soru Sor
        </h2>
        <textarea
          id="questionInput"
          placeholder="Sorunuzu buraya yazın..."
          name = "soruText"
        ></textarea>
        <div class="links">
          <div class="symbol">
            <input type="file" id="fileInput" style="display: none;" accept="image/*" name="foto">
            <a href="#"><i class="fa-solid fa-paperclip" id="paperclipIcon"></i></a>
          </div>
          <button id="fileButton" style="display: none; justify-content: space-between; align-items: center; background-color: white; color: #38587e;"> <img src="" alt="" style="width: 2rem; height: 2rem; object-fit: cover;"> <p style="margin-right: 10px;"></p> <i class="fa-solid fa-x" style="font-size: 1.2rem; color: #38587e;"></i></button>
          <button type="submit">Soruyu Gönder</button>
          <select id="lessonSelect" name="dersSelect" class="custom-select">
            <option value="0">Matematik</option>
            <option value="1">Türkçe</option>
            <option value="2">Yazılım</option>
            <option value="3">Fizik</option>
            <option value="4">Tarih</option>
            <option value="5">İngilizce</option>
          </select>
          <select id="pointSelect" name="puanSelect" class="custom-select">
            <option value="10" selected>10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
          </select>
          <div class="question">
            <a href="#"
              ><i
                class="fa-solid fa-circle-question"
                style="font-size: 2rem"
              ></i
              ><?php echo $kullaniciPuani; ?> puanın var</a
            >
          </div>
        </div>
      </div>
      <div class="DersLogosu">
        <img
          src="../images/education-graduation-academic-logo-academy-school-1625160-pxhere.com.jpg"
          alt="Ders Logosu"
        />
        <h1 style="margin-top: -4rem; font-size: 3rem; text-align: center">
          Sor,Öğren,Paylaş!
        </h1>
      </div>
    </div>
    </form>
    <footer class="footer">
      <div class="footerLearnify">
        <a href="giris-ekrani.html"
          ><img src="../images/ödevboxicon.png" alt="icon"
        /></a>
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
        <a href="instagram.com"
          ><i class="fa-brands fa-instagram" id="instagramIcon"></i
        ></a>
        <a href="facebook.com"
          ><i class="fa-brands fa-facebook" id="facebookIcon"></i
        ></a>
        <a href="linkedin.com"
          ><i class="fa-brands fa-linkedin" id="linkedinIcon"></i
        ></a>
        <a href="x.com"
          ><i class="fa-brands fa-x-twitter" id="twitterIcon"></i
        ></a>
        <a href="youtube.com"
          ><i class="fa-brands fa-youtube" id="youtubeIcon"></i
        ></a>
      </div>
    </footer>

    <script src="soru.js"></script>
  </body>
</html>
