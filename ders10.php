<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ders 10</title>

    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="ortala">
        <h1>1 - 100 arası tek sayılar</h1>
    </div>
    
    <div class="bosluk2"></div>

    <?php
        for ($i = 1; $i <= 100; $i++) {
            if ($i % 2 != 0) {
                echo $i . " ";
            }
        }
    ?>

    <div class="bosluk2"></div>


    <div class="ortala">
        <h1>Dinamik tablo</h1>
    </div>
    
    <form action="" method="post" style="text-align: center;">
        <label for="rows">Satır Sayısı:</label>
        <input type="number" name="rows" id="rows" min="1" required>
        <label for="columns">Sütun Sayısı:</label>
        <input type="number" name="columns" id="columns" min="1" required>
        <button type="submit">Tablo Oluştur</button>
    </form>


    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $rows = $_POST["rows"];
            $columns = $_POST["columns"];
    
            echo "<table>";
            for ($i = 0; $i < $rows; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $columns; $j++) {
                    $randomNumber = rand(1, 100);
                    echo "<td>$randomNumber</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>


    <div class="footer">
        <a href="index.html" target="">Ana sayfaya Dön</a>
    </div>
</body>
</html>