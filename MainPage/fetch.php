<?php
require 'db.php';
header('Content-Type:application/json');
$action=$_GET['action']??'';
if($action==='dersler'){
  $res=mysqli_query($conn,'SELECT dersID,dersAdi FROM dersler');
  echo json_encode(mysqli_fetch_all($res,MYSQLI_ASSOC)); exit;
}
if($action==='sorular'){
  $filter='';
  if(!empty($_GET['dersID'])) $filter="WHERE s.dersID=".intval($_GET['dersID']);
  if(!empty($_GET['search'])){
    $s=mysqli_real_escape_string($conn,$_GET['search']);
    $filter .= $filter?" AND":"WHERE";
    $filter .= " s.soruAciklamasi LIKE '%$s%'";
  }
  $sql="SELECT s.soruID,s.soruAciklamasi,s.soruPuani,d.dersAdi,k.kullaniciTakmaAdi, concat('../profile-images/',k.profilFoto) as profilFoto FROM sorular s JOIN dersler d ON s.dersID=d.dersID JOIN kullanicilar k ON s.kullaniciID=k.kullaniciID $filter ORDER BY s.soruID DESC";
  $res=mysqli_query($conn,$sql);
  echo json_encode(mysqli_fetch_all($res,MYSQLI_ASSOC)); exit;
}
echo json_encode([]);
?>
```


<?php
require 'db.php'; session_start(); header('Content-Type:application/json');
if($_SERVER['REQUEST_METHOD']!=='POST') exit;
if(!isset($_SESSION['kullaniciID'])){echo json_encode(['success'=>false]);exit;}
$metin=mysqli_real_escape_string($conn,trim($_POST['soruAciklamasi']));
$dersID=intval($_POST['dersID']); $puan=intval($_POST['soruPuani']); $kID=$_SESSION['kullaniciID'];
if(!$metin){echo json_encode(['success'=>false]);exit;}
mysqli_query($conn,"INSERT INTO sorular(kullaniciID,soruAciklamasi,soruPuani,dersID) VALUES($kID,'$metin',$puan,$dersID)");
$new=mysqli_insert_id($conn);
$sql="SELECT s.soruID,s.soruAciklamasi,s.soruPuani,d.dersAdi,k.kullaniciTakmaAdi,k.profilFoto FROM sorular s JOIN dersler d ON s.dersID=d.dersID JOIN kullanicilar k ON s.kullaniciID=k.kullaniciID WHERE s.soruID=$new";
$res=mysqli_query($conn,$sql);
echo json_encode(['success'=>true]+mysqli_fetch_assoc($res));
?>