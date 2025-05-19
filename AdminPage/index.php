<?php
include("../genel-php/db-connection.php");


$admnnickname = $_POST['admn-nickname'];
$password_input = $_POST['admn-password'];


$hashed_password = hash('sha512', $password_input);


$sql = "SELECT * FROM adminler WHERE adminAdi = ? AND adminSifresi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $admnnickname, $hashed_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
   
    header("Location: ../admin-paneli/index.php");
    exit();
} else {
    echo "
    <script>
        alert('❌ Böyle bir admin mevcut değil!');
        window.location.href = 'index.html'; // giriş sayfasının yolu
    </script>
    ";
}

$stmt->close();
$conn->close();
?>




