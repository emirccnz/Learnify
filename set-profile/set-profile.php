<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/ödevboxicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../genel-css/header.css">
    <link rel="stylesheet" href="../genel-css/footer.css">
    <link rel="stylesheet" href="../set-profile/set-profile.css">
    <title>Learnify</title>
</head>

<body>
    <?php 
        session_start();
  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$userID = $_SESSION["user_id"];
        include("../genel-php/profil-bilgileri.php"); 
        include("../genel-php/db-connection.php");
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
            <input class="search-input" type="search" placeholder="Herhangi bir soru arayabilirsin..." />
        </div>
        <div class="right-side">
            <a href="../soru/soru.php"> <span class="button-text">soru sor</span></a>
            <span class="icons">
                <i class="fa-regular fa-bell"></i>
            </span>
            <span class="icons">
                <i class="fa-regular fa-user" onclick="location.href = '../Profil/profil.php'"></i>
            </span>
        </div>
    </header>

    <form action="submit.php" method="post" enctype="multipart/form-data">
        <div class="mainContent" id="mainContent">
                <h1>Profilini Düzenle</h1>
            <div class="setAbout">
                <h3>Hakkında</h3>
                <div class="setAboutContent content">
                    <div class="setGenderDiv">
                        <h3>Cinsiyet: </h3>
                        <select class="setGenderSelect" name="gender">
                            <option value="NULL">Belirtmek istemiyorum.</option>
                            <option value="Erkek">Erkek</option>
                            <option value="Kız">Kız</option>
                        </select>
                    </div>
                    <div class="setEducationalStatusDiv">
                        <h3>Öğrenim Durumu: </h3>
                        <select class="setGenderSelect" name="educationalStatus">
                            <option value="0">İlkokul</option>
                            <option value="1">Ortaokul</option>
                            <option value="2">Lise</option>
                            <option value="3">Üniversite+</option>
                        </select>
                    </div>
                    <div class="setName" id="setNameDiv">
                        <h3>Ad: </h3>
                        <h3 style="text-align: center;"><?php echo $kullaniciAdi; ?></h3>
                        <i class="fa-regular fa-pen-to-square" style="font-size: 1.2rem;"></i>
                        <input type="text" placeholder="<?php echo $kullaniciAdi; ?>" name="name" autocomplete = "none">
                    </div>
                    <div class="setName" id="setSurnameDiv">
                        <h3>Soyad: </h3>
                        <h3 style="text-align: center;"><?php echo $kullaniciSoyadi; ?></h3>
                        <i class="fa-regular fa-pen-to-square" style="font-size: 1.2rem;"></i>
                        <input type="text" placeholder="<?php echo $kullaniciSoyadi; ?>" name="surname" autocomplete = "none">
                    </div>
                    <div class="setUsername" id="setUsernameDiv">
                        <h3>Takma Ad: </h3>
                        <h3 style="text-align: center;"><?php echo $kullaniciTakmaAdi; ?></h3>
                        <i class="fa-regular fa-pen-to-square" style="font-size: 1.2rem;"></i>
                        <input type="text" placeholder="<?php echo $kullaniciTakmaAdi; ?>" name="userName" autocomplete = "none">
                    </div>
                </div>
            </div>
            <div class="setPassword">
                <h3>Şifren</h3>
                <div class="setPasswordContent content">
                    <div>
                        <h3>Güncel Şifre: </h3>
                        <input type="text" name="oldPsw" id="oldPsw" autocomplete = "none">
                    </div>
                    <div>
                        <h3>Yeni Şifre: </h3>
                        <input type="text" name="password" id="password" autocomplete = "none">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <div>
                        <h3>Yeni Şifre Tekrar:</h3>
                        <input type="text" name="agPsw" id="agPsw" autocomplete = "none">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
            </div>
            <div class="setEmail">
                <h3 style="display: flex; justify-content: space-between;">E-mailin <span style="color: gray;"><?php echo $email; ?></span></h3>
                <div class="setEmailContent content">
                    <div>
                        <h3>Güncel Şifre: </h3>
                        <input type="text" autocomplete = "none">
                    </div>
                    <div>
                        <h3>Yeni E-mail: </h3>
                        <input type="text" name="email">
                    </div>
                </div>
            </div>
            <div class="setUserIcon" id="SetUserIconDiv">
                <h3>Fotoğrafın</h3>
                <div class="setUserIconContent">
                    <h3>Güncel Fotoğrafın</h3>
                    <img src="../profile-images/<?php echo $profilFoto; ?>" alt="" id="userPhoto">
                    <br>
                    <input type="file" accept="image/*" id="uploadPhoto" name="foto">
                    <p style="margin-top: 10px;">Uyarı: En güzel sonuç için fotoğrafınızın boyutu 1:1(kare) oranında olmalıdır.</p>
                </div>
            </div>
            <div class="saveChangesDiv"><button class="saveChangesBtn" type="submit">Değişikliklikleri Kaydet</button></div>
           
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
    <script src="setProfile.js"></script>
</body>

</html>