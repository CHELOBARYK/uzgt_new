<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/main.css">
    <title>Каталог - УЗГТ</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="container">
            <a href="models.php">
                <div class="catalogue-card">
                    <div class="catalogue-img">
                        <img src="imgs/801.png" alt="фото Снегоболотоходы">
                    </div>
                    <h2 class="catalogue_section">Снегоболотоходы</h2>
                </div>
            </a>
            <a href="catalogue_parts.php">
                <div class="catalogue-card">
                    <div class="catalogue-img">
                        <img src="imgs/default.png" alt="фото Снегоболотоходы">
                    </div>
                    <h2 class="catalogue_section">Запчасти</h2>
                </div>
            </a>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>