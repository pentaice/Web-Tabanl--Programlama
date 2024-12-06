<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ders 11</title>

    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="ortala">
        <h1>Dosya dizin yapma</h1>
    </div>
    <div class="bosluk2"></div>




    <form method="post" class="center">
        <button type="submit" name="create_file">Dosya Oluştur</button>
        <button type="submit" name="read_file">Dosyayı Oku</button>
        <button type="submit" name="delete_file">Dosyayı Sil</button>
        <button type="submit" name="clear_file">Dosyayı Temizle</button>
    </form>


    <form method="post" class="center">
        <textarea name="file_content" rows="4" cols="50" placeholder="Dosyaya yazmak istediğiniz metni buraya girin..."></textarea><br>
        <button type="submit" name="write_file">Dosyaya Yaz</button>
    </form>

    
    <?php
    $fileName = "merhaba_dunya.txt";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['create_file'])) {
            $content = "Merhaba Dünya";

            // Dosya oluştur ve içeriği yaz
            if (file_put_contents($fileName, $content)) {
                echo "<p>Dosya başarıyla oluşturuldu: <a href='$fileName' target='_blank'>$fileName</a></p>";
            } else {
                echo "<p>Dosya oluşturulurken bir hata oluştu.</p>";
            }
        }

        if (isset($_POST['read_file'])) {
            // Dosyayı oku ve içeriği göster
            if (file_exists($fileName)) {
                $fileContent = file_get_contents($fileName);
                echo "<p>Dosyanın içeriği:</p>";
                echo "<pre>$fileContent</pre>";
            } else {
                echo "<p>Okunacak bir dosya bulunamadı.</p>";
            }
        }

        if (isset($_POST['write_file']) && !empty($_POST['file_content'])) {
            $newContent = $_POST['file_content'];

            // Dosyaya yeni içeriği ekle
            if (file_put_contents($fileName, $newContent, FILE_APPEND)) {
                echo "<p>Dosyaya başarıyla yazıldı.</p>";
            } else {
                echo "<p>Dosyaya yazılırken bir hata oluştu.</p>";
            }
        }

        if (isset($_POST['delete_file'])) {
            // Dosyayı sil
            if (file_exists($fileName)) {
                if (unlink($fileName)) {
                    echo "<p>Dosya başarıyla silindi.</p>";
                } else {
                    echo "<p>Dosya silinirken bir hata oluştu.</p>";
                }
            } else {
                echo "<p>Silinecek bir dosya bulunamadı.</p>";
            }
        }

        if (isset($_POST['clear_file'])) {
            // Dosyanın içeriğini temizle
            if (file_exists($fileName)) {
                if (file_put_contents($fileName, "") !== false) {
                    echo "<p>Dosyanın içeriği başarıyla temizlendi.</p>";
                } else {
                    echo "<p>Dosyanın içeriği temizlenirken bir hata oluştu.</p>";
                }
            } else {
                echo "<p>Temizlenecek bir dosya bulunamadı.</p>";
            }
        }
    }
    ?>


    <div class="bosluk2"></div>
    <div class="bosluk2"></div>
    <div class="footer">
        <a href="index.html" target="">Ana sayfaya Dön</a>
    </div>
</body>
</html>