<?php
include '../genel-php/db-connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = intval($_POST['userId']);
    
    $sql = "DELETE FROM cevaplar WHERE kullaniciID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    
    $sql = "DELETE FROM sorular WHERE kullaniciID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    
    $sql = "DELETE FROM kullanicilar WHERE kullaniciID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Kullanıcı silinirken bir hata oluştu']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Geçersiz istek']);
}
?> 