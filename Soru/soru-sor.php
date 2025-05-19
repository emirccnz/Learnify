<?php
    include("../genel-php/db-connection.php");
    include("../genel-php/profil-bilgileri.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $soruText = isset($_POST['soruText']) ? $_POST['soruText'] : null;
        $dersSelect = isset($_POST['dersSelect']) ? $_POST['dersSelect'] : null;
        $puanSelect = isset($_POST['puanSelect']) ? $_POST['puanSelect'] : null;

        $userID = 1;

        $sql = "INSERT INTO sorular (kullaniciID, soruAciklamasi, fotograf, soruPuani, dersID) VALUES (?, ?, ?, ?, ?)";

        if($kullaniciPuani<$puanSelect){
            echo "<script>alert('Puanınız bu soruyu göndermeye yetmiyor!'); location.href= 'soru.php'</script>";
            exit;
        }
        if(!$soruText){
            echo "<script>alert('Soru açıklaması boş kalamaz.'); location.href= 'soru.php'</script>";
            exit;
        }
        if ($stmt = mysqli_prepare($conn, $sql)) {
            $fotograf_placeholder = null;

            $param_types = 'sisii';
            $param_types = 'issii';

            mysqli_stmt_bind_param($stmt, $param_types, $userID, $soruText, $fotograf_placeholder, $puanSelect, $dersSelect);

            if (mysqli_stmt_execute($stmt)) {
                $sonID = mysqli_insert_id($conn);
                if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK){
                    $gecici_yol = $_FILES['foto']['tmp_name'];
                    $orijinal_isim = $_FILES['foto']['name'];
                    $uzanti = strtolower(pathinfo($orijinal_isim, PATHINFO_EXTENSION));
                    $yeni_isim = uniqid() . '.' . $uzanti;
                    $hedef_yol = 'soru-fotolari/' . $yeni_isim;

                    if (move_uploaded_file($gecici_yol, $hedef_yol)) {
                        $update_sql = "UPDATE sorular SET fotograf = ? WHERE soruID = ?";
                        if ($update_stmt = mysqli_prepare($conn, $update_sql)) {
                            mysqli_stmt_bind_param($update_stmt, 'si', $yeni_isim, $sonID);
                            if (!mysqli_stmt_execute($update_stmt)) {
                                error_log("Error updating photograph field: " . mysqli_stmt_error($update_stmt));
                            }
                            mysqli_stmt_close($update_stmt);
                        } else {
                            error_log("Error preparing update statement: " . mysqli_error($conn));
                        }
                    } else {
                        echo "<script>alert('Soru fotoğrafı yüklenemedi.')</script>";
                         error_log("Error uploading file: " . $_FILES['foto']['error']);
                    }
                }
                $puanSql = "update kullanicilar set kullaniciPuani = kullaniciPuani - $puanSelect where kullaniciID = $userID";
                mysqli_query($conn,$puanSql);
                $sorularSql = "update kullanicilar set soruSayisi = soruSayisi+1 where kullaniciID = $userID";
                mysqli_query($conn,$sorularSql);
                echo "<script>alert('Soru başarıyla kaydedildi.'); window.location.href = '../MainPage/indeks.html'</script>";

            } else {
                error_log("Error executing insert statement: " . mysqli_stmt_error($stmt));
                 echo "<script>alert('Soru kaydedilirken bir hata oluştu.')</script>"; 
            }

            mysqli_stmt_close($stmt);

        } else {
            error_log("Error preparing insert statement: " . mysqli_error($conn));
             echo "<script>alert('Veritabanı hatası oluştu.')</script>"; 
        }

    } 

    mysqli_close($conn);
?>