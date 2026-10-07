<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin.php?token=...');
    exit;
}
require_once '../config.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    die("Неверный ID заявки");
}


$result = $conn->query("SELECT * FROM feedback WHERE id = $id");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_btn'])) {
    $agree = isset($_POST['confirm_delete']);

    if ($agree) {
        $conn->query("DELETE FROM feedback WHERE id = $id");
        header('Location: feedback_page.php');
        exit;
    }
}


if ($result->num_rows == 0) {
    die("Заявка не найдена");
}
$row = $result->fetch_assoc();

function cleanPhoneNumber($phone) {
    return preg_replace('/[^0-9+]/', '', $phone);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявка #<?= $row['id'] ?> — УЗГТ</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php include "header.php"; ?>
    <main>
        <div class="feedback-detail">
            <h1>Заявка #<?= $row['id'] ?></h1>
            
            <div class="detail-card">
                <div class="detail-field">
                    <h4>Тема:</h4>
                    <p><?= htmlspecialchars($row['title']) ?></p>
                </div>
                <div class="detail-field">
                    <h4>Имя:</h4>
                    <p><?= htmlspecialchars($row['name']) ?></p>
                </div>                
                <div class="detail-field">
                    <h4>Телефон:</h4>
                    <p><a href="tel:<?= cleanPhoneNumber($row['phone']) ?>"><?= htmlspecialchars($row['phone']) ?></a></p>
                </div>
                
                <div class="detail-field">
                    <h4>Email:</h4>
                    <p><a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a></p>
                </div>
                
                <div class="detail-field" id='product-details'>
                    <h4>ID товара:</h4>
                    <p><?= $row['product_id'] ?: '—' ?></p>
                    <?php if ($row['product_id']):?>
                        <a href="/../model_profile.php?id=<?=htmlspecialchars($row['product_id'])?>" >Ссылка на товар</a>
                    <?php endif;?>
                </div>
                
                <div class="detail-field">
                    <h3>Полное сообщение:</h3>
                    <div class="full-message">
                        <?= nl2br(htmlspecialchars($row['message'])) ?>
                    </div>
                </div>
                
                <div class="detail-field">
                    <h4>Дата и время:</h4>
                    <p><?= $row['created_at'] ?></p>
                </div>
            </div>
            
            <div class="detail-actions">
                <a href="feedback_page.php" class="back-btn">Назад к списку</a>
                <a href="send_email.php?id=<?= $id?>" class="back-btn">Ответить</a>
                <form method="POST">
                    <button type="submit" class="delete-btn" name="delete_btn">Удалить заявку</button>
                    <input type="checkbox" name="confirm_delete" id="confirm_delete" value="1" required>
                    <label for="confirm_delete">Подтвердить удаление</label>
                </form>
            </div>
        </div>
    </main>
    <footer>
        2026 ООО "УЗГТ"
    </footer>
</body>
</html>