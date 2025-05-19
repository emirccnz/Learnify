<?php
$password = $_POST['password'] ?? '';
session_start();
include("../genel-php/db-connection.php"); // DB bağlantı dosyan

$alertMessage = ''; // Bootstrap alert mesajı için

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST'tan gelen verileri güvenli şekilde al
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    
    if ($email && $password) {
        // Kullanıcı var mı kontrol et
        $query = "SELECT * FROM kullanicilar WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Şifre kontrolü (şifre hashlenmiş ise password_verify kullanılmalı)
            if ($password === $user['password']) {  
                // Giriş başarılı
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nickname'] = $user['nickname'];

                header("Location: dashboard.php");
                exit;
            } else {
                // Şifre yanlış
                $alertMessage = '<div class="alert alert-danger" role="alert">Şifre yanlış!</div>';
            }
        } else {
            // Kullanıcı yok
            $alertMessage = '<div class="alert alert-warning" role="alert">Kullanıcı sistemde kayıtlı değil!</div>';
        }
    } else {
        // Email veya şifre boş
        $alertMessage = '<div class="alert alert-danger" role="alert">Lütfen email ve şifreyi doldurun.</div>';
    }
}
?>
