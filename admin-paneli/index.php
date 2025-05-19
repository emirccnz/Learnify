<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <h1>Learnify Admin Panel</h1>
        
        <section class="admin-section">
            <h2><i class="fas fa-users"></i> Kullanıcı Yönetimi</h2>
            <div class="search-box">
                <input type="text" id="userSearch" placeholder="Kullanıcı ara...">
                <button onclick="searchUsers()">Ara</button>
            </div>
            <div class="table-container">
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kullanıcı Adı</th>
                            <th>Email</th>
                            <th>Kayıt Tarihi</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../genel-php/db-connection.php';
                        
                        $sql = "SELECT * FROM kullanicilar ORDER BY kullaniciID DESC";
                        $result = mysqli_query($conn, $sql);
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['kullaniciID'] . "</td>";
                            echo "<td>" . $row['kullaniciAdi'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['kayitTarihi'] . "</td>";
                            echo "<td><button onclick='deleteUser(" . $row['kullaniciID'] . ")' class='delete-btn'><i class='fas fa-trash'></i></button></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin-section">
            <h2><i class="fas fa-question-circle"></i> Soru Yönetimi</h2>
            <div class="search-box">
                <input type="text" id="questionSearch" placeholder="Soru ara...">
                <button onclick="searchQuestions()">Ara</button>
            </div>
            <div class="table-container">
                <table id="questionsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kullanıcı</th>
                            <th>Soru</th>
                            <th>Ders</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT s.*, k.kullaniciTakmaAdi,d.dersAdi FROM sorular s 
                                JOIN kullanicilar k ON s.kullaniciID = k.kullaniciID 
                                JOIN dersler d ON d.dersID = s.DersID
                                ORDER BY s.soruID DESC";
                        $result = mysqli_query($conn, $sql);
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['soruID'] . "</td>";
                            echo "<td>" . $row['kullaniciTakmaAdi'] . "</td>";
                            echo "<td>" . substr($row['soruAciklamasi'], 0, 200) . "...</td>";
                            echo "<td>" . $row['dersAdi'] . "</td>";
                            echo "<td><button onclick='deleteQuestion(" . $row['soruID'] . ")' class='delete-btn'><i class='fas fa-trash'></i></button></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin-section">
            <h2><i class="fas fa-comments"></i> Cevap Yönetimi</h2>
            <div class="search-box">
                <input type="text" id="answerSearch" placeholder="Cevap ara...">
                <button onclick="searchAnswers()">Ara</button>
            </div>
            <div class="table-container">
                <table id="answersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kullanıcı</th>
                            <th>Cevap</th>
                            <th>Tarih</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT c.*, k.kullaniciAdi FROM cevaplar c 
                                JOIN kullanicilar k ON c.kullaniciID = k.kullaniciID 
                                ORDER BY c.cevapID DESC";
                        $result = mysqli_query($conn, $sql);
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['cevapID'] . "</td>";
                            echo "<td>" . $row['kullaniciAdi'] . "</td>";
                            echo "<td>" . substr($row['cevapMetni'], 0, 100) . "...</td>";
                            echo "<td>" . $row['cevapTarihi'] . "</td>";
                            echo "<td><button onclick='deleteAnswer(" . $row['cevapID'] . ")' class='delete-btn'><i class='fas fa-trash'></i></button></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <script>
        function deleteUser(userId) {
            if(confirm('Bu kullanıcıyı silmek istediğinizden emin misiniz?')) {
                fetch('delete_user.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'userId=' + userId
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('Kullanıcı başarıyla silindi');
                        location.reload();
                    } else {
                        alert('Hata: ' + data.message);
                    }
                });
            }
        }

        function deleteQuestion(questionId) {
            if(confirm('Bu soruyu silmek istediğinizden emin misiniz?')) {
                fetch('delete_question.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'questionId=' + questionId
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('Soru başarıyla silindi');
                        location.reload();
                    } else {
                        alert('Hata: ' + data.message);
                    }
                });
            }
        }

        function deleteAnswer(answerId) {
            if(confirm('Bu cevabı silmek istediğinizden emin misiniz?')) {
                fetch('delete_answer.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'answerId=' + answerId
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert('Cevap başarıyla silindi');
                        location.reload();
                    } else {
                        alert('Hata: ' + data.message);
                    }
                });
            }
        }

        function searchUsers() {
            const searchText = document.getElementById('userSearch').value.toLowerCase();
            const table = document.getElementById('usersTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell.textContent.toLowerCase().indexOf(searchText) > -1) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
            }
        }

        function searchQuestions() {
            const searchText = document.getElementById('questionSearch').value.toLowerCase();
            const table = document.getElementById('questionsTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell.textContent.toLowerCase().indexOf(searchText) > -1) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
            }
        }

        function searchAnswers() {
            const searchText = document.getElementById('answerSearch').value.toLowerCase();
            const table = document.getElementById('answersTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell.textContent.toLowerCase().indexOf(searchText) > -1) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
            }
        }
    </script>
</body>
</html> 