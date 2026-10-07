<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin.php?token=...');
    exit;
}
require_once '../config.php';

$feedbacks = $conn->query("SELECT * FROM feedback ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Заявки</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php include "header.php"; ?>
    <main>
        <h1>Обращения и заявки</h1>
        <div class="container">
            <?php while ($row = $feedbacks->fetch_assoc()): ?>
                    <?php 
                         $fullMessage = $row['message'];
                         $shortMessage = mb_substr($fullMessage, 0, 600); 
                    ?>  
                    <div class="fb-card">
                            <h2><?= nl2br(htmlspecialchars($row['title'])) ?></h2>
                            <div class="fb-card-info">
                                <div class="left">
                                    <h3><span>Имя: </span> <?= htmlspecialchars($row['name']) ?></h3>
                                    <h3><span>Телефон: </span><a href="tel:+<?= htmlspecialchars($row['phone']) ?>"><?= htmlspecialchars($row['phone']) ?></a></h3>
                                    <h3><span>Почта: </span><a href="mailto:<?= htmlspecialchars($row['email']) ?>"></a><?= htmlspecialchars($row['email']) ?></h3>
                                    <time datetime="<?= $row['created_at'] ?>"><?= $row['created_at'] ?></time>
                                </div>
                                <div class="right">
                                    <p>
                                        <?= nl2br(htmlspecialchars($shortMessage)) ?>
                                    </p>
                                    <a href="feedback_detail.php?id=<?= $row['id'] ?>" class="look-btn">Посмотреть обращение</a>
                                </div>
                            </div>
                    </div>
                    <?php endwhile;?>
                <?php if ($feedbacks->num_rows <= 0): ?>
                    <p>Нет заявок</p>
                <?php endif; ?>
        </div>
    </main>
    <footer>
        2026 ООО "УЗГТ"
    </footer>
</body>
</html>