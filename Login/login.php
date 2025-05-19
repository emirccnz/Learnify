<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include("../genel-php/db-connection.php");

    $pswrd = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : null;
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;

    if($pswrd && $email){
        $sql = "select * from kullanicilar where email = '$email'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $hashedpswrd = hash('sha512',$pswrd);
        if($hashedpswrd == $row['sifre']){
            session_start();
            $_SESSION['user_id'] = $row['kullaniciID'];
            header("location: ../MainPage/index.php");
        }
        else{
            echo "<script>alert('Şifre yanlış!'); window.location.href='LearnifyLogin.html'</script>";
            exit;
        }
    }
    else{
        echo "<script>alert('Email veya şifre yanlış!'); location.href= 'LearnifyLogin.html'</script>";
        exit;
    }
}
?>
