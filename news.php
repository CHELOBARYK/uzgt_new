<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/main.css">
    <title>Новости - УЗГТ</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="news-page">
        <div class="news-container">
            <h1 class="news-page-title">Новости предприятия</h1>
            <div class="news-list">
                <?php
                $result = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
                while ($row = $result->fetch_assoc()):
                ?>
                    <div class="news-list-item">
                        <img src="<?= $row['image'] ?>" alt="<?= $row['title'] ?>">
                        <div class="news-list-content">
                            <h2><?= $row['title'] ?></h2>
                            <p class="news-date"><?= date('d.m.Y', strtotime($row['created_at'])) ?></p>
                            <p><?= mb_substr($row['content'], 0, 150) ?>...</p>
                            <a href="news_detail.php?id=<?= $row['id'] ?>" class="news-btn">Читать далее</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>