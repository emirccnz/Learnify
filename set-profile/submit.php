<?php
// session_start();
// if (!isset($_SESSION["kullanici_id"])) {
//     header("Location: login.php");
//     exit();
// }
if($_SERVER["REQUEST_METHOD"]== "POST"){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "learnify";

    $conn = mysqli_connect($servername,$username,$password,$database);

    if(!$conn){
        die("Bağlantı Hatası: " . mysqli_connect_error());
    }

    $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : null;
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null;
    $surname = isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : null;
    $nickname = isset($_POST['userName']) ? htmlspecialchars($_POST['userName']) : null;
    $pswrd = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : null;
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;


    // $userID = $_SESSION["kullaniciID"]; 
    $userID = 1;
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

    if($email){
        $sql = "update kullanicilar set email = '{$email}' where  kullaniciID = {$userID}";
        mysqli_query($conn,$sql);
    }


    
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
        if (mysqli_query($conn, $sorgu)) {
            echo "Dosya başarıyla yüklendi ve kaydedildi.";
        } else {
            echo "Veritabanı hatası: " . mysqli_error($baglanti);
        }

    } else {
        echo "Dosya taşınamadı.";
    }

mysqli_close($conn);
}

exit;
?>