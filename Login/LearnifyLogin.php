<?php
session_start();
include("../genel-php/db-connection.php");

$alertMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $query = "SELECT * FROM kullanicilar WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);
            $hashedPassword = hash('sha512', $password);

            if ($hashedPassword === $user['sifre']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nickname'] = $user['kullaniciTakmaAdi'];
               header("Location: http://localhost/learnify/Learnify/MainPage/index.php");
                exit;

            } else {
                $alertMessage = '<div class="alert alert-danger" role="alert">E-Mail veya şifre hatalı!</div>';
            }
        } else {
            $alertMessage = '<div class="alert alert-danger" role="alert">E-Mail veya şifre hatalı!</div>';
        }
    } else {
        $alertMessage = '<div class="alert alert-danger" role="alert">Lütfen email ve şifreyi doldurun.</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../images/ödevboxicon.png" type="image/x-icon">
  <title>Giriş Yap</title>
  <link rel="stylesheet" href="../genel-css/footer.css">
  <link rel="stylesheet" href="Login.css">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <header class="mainHeader">
    <div class="leftSideH">
      <a href="../Giris-Ekrani/giris-ekrani.html"><img src="../images/ödevboxicon.png" alt="odevboxicon"></a>
      <h1>Learnify</h1>
    </div>
    <div class="rightSideH">
      <a href="LearnifyLogin.php" class="loginBtn"><button>Giriş Yap</button></a>
      <a href="../SignUp/SignUp.html" class="signUpBtn"><button>Kayıt Ol</button></a>
    </div>
  </header>

  <div class="container">
    <h2>Tekrar Hoşgeldin...</h2>
    <p class="initial-text">Aradığın Cevaplar Burada... </p>
    <?php if (!empty($alertMessage)): ?>
      <?= $alertMessage ?>
    <?php endif; ?>

    <div class="login-container">
      <form class="loginForm" action="LearnifyLogin.php" method="POST">
        <div class="form-group">
          <label for="email">E-Mail : </label>
          <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
          <label for="password">Şifre : </label>
          <input type="password" name="password" id="password" required>
        </div>
        <button type="submit" class="login-button">Giriş Yap</button>
      </form>
      <br>
      <p>Hesabın Yok Mu? <a href="../SignUp/SignUp.html" style="color: #38587e;">Üye Ol</a></p>
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

</body>

</html>
