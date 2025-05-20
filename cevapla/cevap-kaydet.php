<?php
if($_SERVER["REQUEST_METHOD"] = "POST"){
    include("../genel-php/db-connection.php");
    include("../genel-php/session-query.php");
    $cevapMetni = isset($_POST['cevapMetni']) ? htmlspecialchars($_POST['cevapMetni']) : null;
    $soruID = isset($_GET['soruID']) ? htmlspecialchars($_GET['soruID']) : null;
    $sql = "insert into cevaplar(soruID,kullaniciID,cevapMetni) values ($soruID,$userID,'$cevapMetni')";
    if(mysqli_query($conn,$sql)){
        mysqli_close($conn);
        echo "<script>alert('Yanıtınız kaydedildi!'); location.href = '../sorusayfasi.php?soruID=$soruID'</script>";
    }
    else{
        echo "<script>alert('Yanıt kaydedilirken bir hata oluştu!'); location.href = '../sorusayfasi.php?soruID=$soruID'</script>";
    }
    
}
?>