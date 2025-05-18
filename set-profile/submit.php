<?php
// session_start();
// if (!isset($_SESSION["kullanici_id"])) {
//     header("Location: login.php");
//     exit();
// }
include("../genel-php/db-connection.php");
if($_SERVER["REQUEST_METHOD"]== "POST"){
    

    $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : null;
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null;
    $surname = isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : null;
    $nickname = isset($_POST['userName']) ? htmlspecialchars($_POST['userName']) : null;
    $pswrd = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : null;
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
    $oldPsw = isset($_POST['oldPsw']) ? htmlspecialchars($_POST['oldPsw']) : null;
    $educationalStatus = isset($_POST['educationalStatus']) ? htmlspecialchars($_POST['educationalStatus']) : null;

    // $userID = $_SESSION["kullaniciID"]; 
    $userID = 1;

    if($educationalStatus){
        $sql = "update kullanicilar set ogrenimSeviyesi = $educationalStatus where  kullaniciID = {$userID}";
        mysqli_query($conn,$sql);
    }

    if($gender){
        $sql = "update kullanicilar set cinsiyet = '{$gender}' where  kullaniciID = {$userID}";
        mysqli_query($conn,$sql);
    }

    if($name){
        $sql = "update kullanicilar set kullaniciAdi = '{$name}' where  kullaniciID = {$userID}";
        mysqli_query($conn,$sql);
    }

    if($surname){
        $sql = "update kullanicilar set kullaniciSoyadi = '{$surname}' where  kullaniciID = {$userID}";
        mysqli_query($conn,$sql);
    }

    if($nickname){
        $sql = "update kullanicilar set kullaniciTakmaAdi = '{$nickname}' where  kullaniciID = {$userID}";
        mysqli_query($conn,$sql);
    }

    if($pswrd){
        $passSql = "select sifre from kullanicilar where kullaniciID = {$userID}";
        $sonuc = mysqli_query($conn,$passSql);
        $row = mysqli_fetch_row($sonuc);
        if(hash('sha512',$oldPsw) == $row[0]){
            $sql = "update kullanicilar set sifre = ? where  kullaniciID = {$userID}";
            $stmt = mysqli_prepare($conn, $sql);
            if (!$stmt) {
                die("Sorgu hazırlanamadı: " . mysqli_error($conn));
            }
            $hashedPswrd = hash('sha512',$pswrd);
            mysqli_stmt_bind_param($stmt,"s",$hashedPswrd);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        else{
            echo "<script> alert('Şifren doğru değil!'); window.location.href= 'set-profile.php' </script>";
            mysqli_close($conn);

        }
        
    }

    if($email){
        if(hash('sha512',$oldPsw) == $row[0]){
            $sql = "update kullanicilar set email = '{$email}' where  kullaniciID = {$userID}";
            mysqli_query($conn,$sql);
        }
        else{
            echo "<script> alert('Şifren doğru değil!'); window.location.href= 'set-profile.php' </script>";
            mysqli_close($conn);

        }
    }


    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK){
        $gecici_yol = $_FILES['foto']['tmp_name']; // geçici klasördeki yol
        $orijinal_isim = $_FILES['foto']['name'];  // kullanıcıdan gelen dosya adı
        $uzanti = strtolower(pathinfo($orijinal_isim, PATHINFO_EXTENSION));
    
        $yeni_isim = uniqid() . '.' . $uzanti;

        // Hedef klasör
        $hedef_yol = '../profile-images/' . $yeni_isim;

        // Dosyayı geçici klasörden uploads'a taşı
        if (move_uploaded_file($gecici_yol, $hedef_yol)) {
            // Veritabanına dosya adını kaydet
            $sorgu = "update kullanicilar set profilFoto = '$yeni_isim' where kullaniciID = $userID";
            mysqli_query($conn,$sorgu);

        } else {
            echo "<script>alert('Profil fotoğrafı güncellenemedi.')</script>";
            mysqli_close($conn);
        }
    }

echo "<script>alert('Değişiklikler kaydedildi!'); location.href = 'set-profile.php'</script>";
mysqli_close($conn);
}

exit;
?>