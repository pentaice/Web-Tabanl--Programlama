<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ders 11 2</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="ortala">
        <h1>SQL</h1>
    </div>
    <div class="bosluk2"></div>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bote24";

    // Veritabanı bağlantısı oluştur
    $conn = new mysqli($servername, $username, $password);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }

    // Veritabanı oluştur
    $sql_create_db = "CREATE DATABASE IF NOT EXISTS bote24";
    if ($conn->query($sql_create_db) !== TRUE) {
        echo "Veritabanı oluşturulamadı: " . $conn->error;
    }

    // Veritabanını seç
    $conn->select_db($dbname);

    // Tablo oluştur
    $sql_create_table = "CREATE TABLE IF NOT EXISTS kisi (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ad VARCHAR(50) NOT NULL,
        soyad VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL
    )";
    if ($conn->query($sql_create_table) !== TRUE) {
        echo "Tablo oluşturulamadı: " . $conn->error;
    }

    // Form 1: Veri ekleme işlemi
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_person'])) {
        $ad = $_POST['ad'];
        $soyad = $_POST['soyad'];
        $email = $_POST['email'];

        $sql_insert = "INSERT INTO kisi (ad, soyad, email) VALUES ('$ad', '$soyad', '$email')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "<p>Veri başarıyla eklendi.</p>";
        } else {
            echo "<p>Hata: " . $conn->error . "</p>";
        }
    }

    // Form 2: Veri sorgulama işlemi
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['find_person'])) {
        $ad = $_POST['search_ad'];

        $sql_search = "SELECT soyad, email FROM kisi WHERE ad = '$ad'";
        $result = $conn->query($sql_search);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>Soyad: " . $row['soyad'] . " - Email: " . $row['email'] . "</p>";
            }
        } else {
            echo "<p>Kayıt bulunamadı.</p>";
        }
    }

    // Bağlantıyı kapat
    $conn->close();
    ?>

    <!-- Form 1: Veri ekleme -->
    <form method="POST" action="" class="center">
        <h2>Yeni Kişi Ekle</h2>
        <label for="ad">Ad:</label>
        <input type="text" id="ad" name="ad" required><br>
        <label for="soyad">Soyad:</label>
        <input type="text" id="soyad" name="soyad" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <button type="submit" name="add_person">Ekle</button>
    </form>

    <!-- Form 2: Veri sorgulama -->
    <form method="POST" action="" class="center">
        <h2>Kişi Ara</h2>
        <label for="search_ad">Ad:</label>
        <input type="text" id="search_ad" name="search_ad" required><br>
        <button type="submit" name="find_person">Bul</button>
    </form>

    <div class="bosluk2"></div>
    <div class="footer">
        <a href="index.html" target="">Ana sayfaya Dön</a>
    </div>
</body>
</html>
