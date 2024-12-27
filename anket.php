<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anket</title>

    <link rel="stylesheet" href="css/main.css">
</head>
</head>
<body>
    <div class="ortala"><h1>Anket</h1></div>
    <div class="bosluk2" style="text-align: center;">
        <h3>c++ dünyanın en iyi dili olabilir mi?</h3>
    </div>
    <form class="center" method="POST" action="">
        <label>
            <input type="radio" name="secim" value="Evet" required> Evet
        </label><br>
        <label>
            <input type="radio" name="secim" value="Hayır" required> Hayır
        </label><br>
        <label>
            <input type="radio" name="secim" value="Belki" required> Belki
        </label><br>
        <button type="submit" name="submit">Gönder</button>
    </form>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "anket_db";

    // Veritabanı bağlantısını oluştur
    $conn = new mysqli($servername, $username, $password);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Bağlantı başarısız: " . $conn->connect_error);
    }

    // Veritabanını oluştur ve seç
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) !== TRUE) {
        die("Veritabanı oluşturulamadı: " . $conn->error);
    }
    $conn->select_db($dbname);

    // Tabloyu oluştur
    $sql = "CREATE TABLE IF NOT EXISTS anket_sonuc (
        id INT AUTO_INCREMENT PRIMARY KEY,
        secim VARCHAR(20) NOT NULL
    )";
    if ($conn->query($sql) !== TRUE) {
        die("Tablo oluşturulamadı: " . $conn->error);
    }

    // Form verisini kaydet ve yönlendir
    if (isset($_POST['submit'])) {
        $secim = $_POST['secim'];
        $stmt = $conn->prepare("INSERT INTO anket_sonuc (secim) VALUES (?)");
        $stmt->bind_param("s", $secim);

        if ($stmt->execute()) {
            echo "<p>Teşekkürler! Oy kullanıldı.</p>";
        } else {
            echo "<p>Hata: " . $stmt->error . "</p>";
        }
        $stmt->close();

        // Sayfayı yeniden yüklerken formun tekrar gönderilmesini engelle
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Verileri indirme butonu
    if (isset($_POST['download'])) {
        $filename = "anket_sonuclari.csv";
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");

        $output = fopen("php://output", "w");
        fputcsv($output, ["ID", "Seçim"]);

        $result = $conn->query("SELECT * FROM anket_sonuc");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                fputcsv($output, $row);
            }
        }
        fclose($output);
        exit;
    }

    // Bağlantıyı kapat
    $conn->close();
    ?>

    <div class="bosluk"></div>

    <!-- İndir Butonu -->
    <form method="POST" action="" class="center">
        <button type="submit" name="download">Sonuçları İndir</button>
    </form>

    <div class="footer">
        <a href="index.html">Ana Sayfaya Dön</a>
    </div>
</body>
</html>
