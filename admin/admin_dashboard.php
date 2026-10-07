<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin.php?token=x7K9mP2qR5tL8wE3zA1cV4bN6');
    exit;
}
?>


<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Админ панель - УЗГТ</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <header>
            <a href="../index.php"><img src="../imgs/logo1.png" alt="logo"></a>
            <a href="admin_logout.php" id="logout"><img src="../imgs/logout.png" alt="logout_icon"></a>
        </header>
        <main>
            <div class="card-container">
                <a href="add_to_catalogue.php">
                    <div class="card">
                        <h2>Добавить<br>Товары</h2>
                    </div>
                </a><a href="add_news.php">
                    <div class="card">
                        <h2>Добавить Новости</h2>
                    </div>
                </a><a href="feedback_page.php">
                    <div class="card">
                        <h2>Посмотреть обращения</h2>
                    </div>
                </a>
            </div>
        </main>
        <footer>2026 ООО "УЗГТ"</footer>
    </body>
</html>