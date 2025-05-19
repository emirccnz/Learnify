<?php
$password = $_POST['password'] ?? '';
session_start();
include("../genel-php/db-connection.php"); 

$alertMessage = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    
    if ($email && $password) {
        
        $query = "SELECT * FROM kullanicilar WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            
            if ($password === $user['password']) {  
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nickname'] = $user['nickname'];

                header("Location: dashboard.php");
                exit;
            } else {
                
                $alertMessage = '<div class="alert alert-danger" role="alert">Şifre yanlış!</div>';
            }
        } else {
            
            $alertMessage = '<div class="alert alert-warning" role="alert">Kullanıcı sistemde kayıtlı değil!</div>';
        }
    } else {
        
        $alertMessage = '<div class="alert alert-danger" role="alert">Lütfen email ve şifreyi doldurun.</div>';
    }
}
?>
