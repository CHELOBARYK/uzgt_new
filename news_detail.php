<?php
require_once 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id == 0) {
    echo 'Неверный ID новости';
    exit;
}

$result = $conn->query("SELECT * FROM news WHERE id = $id");

if ($result->num_rows == 0) {
    echo 'Новость не найдена';
    exit;
}

$news = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($news['title']) ?> — Новости УЗГТ</title>
    <link rel="stylesheet" href="/main.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="news-detail">
            <div class="news-detail-container">
                <h1><?= htmlspecialchars($news['title']) ?></h1>
                <p class="news-date"><?= date('d.m.Y', strtotime($news['created_at'])) ?></p>
                <img src="<?= htmlspecialchars($news['image']) ?>" alt="<?= htmlspecialchars($news['title']) ?>" class="news-detail-img">
                <div class="news-detail-content">
                    <p><?= nl2br(htmlspecialchars($news['content'])) ?></p>
                </div>
                <a href="news.php" class="back-btn">← Назад к новостям</a>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>