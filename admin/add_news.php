<?php
    
    session_start();
    if (!isset($_SESSION['admin'])){
        header('Location: admin.php?token=...');
        exit;
    }
    require_once '../config.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $image = trim($_POST['image'] ?? '');

    if (!empty($title) && !empty($content)) {
        $conn->query("INSERT INTO news (title, content, image) 
                      VALUES ('$title', '$content', '$image')");
        header('Location: add_news.php');
        exit;
    } else {
        $error = "!! Заполните название и содержание !!";
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_delete'])) {
        $delete_id = (int)$_POST['news_id'];
        if ($delete_id > 0 && isset($_POST['agree_delete'])) {
            $conn->query("DELETE FROM news WHERE id = $delete_id");
            header('Location: add_news.php');
            exit;
        } else {
            $delete_error = "Подтвердите удаление";
        }
    }
    }
    $news_for_select = $conn->query("SELECT id, title FROM news ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости</title>
</head>
<body>
    <?php include "header.php" ?>
    <main>
    <h2>Добавить новости на сайт</h2>
        <div class="form-container">
            <form method="POST">
                <input type="text" name="title" id="title" placeholder="Название">
                <input type="text" name="image" id="image" placeholder="Изображение - путь к файлу">
                <input type="text" name="content" id="content" placeholder="Соджержание">
                <button type="submit">Отправить</button>
            </form>
        </div>
        <?php if (isset($error)): ?>
    <    <p><?= $error ?></p>
        <?php endif; ?>
        <h2>Удалить новость</h2>
        <?php if (isset($delete_error)): ?>
                <div class="error-message"><p><?= $delete_error ?></p></div>
        <?php endif; ?>
        <div class="form-container">
            <form method="POST">
                    <label for="news_id">Выберите новость для удаления:</label>
                    <select name="news_id" id="news_id" required>
                        <option value="">-- Выберите новость --</option>
                        <?php while ($item = $news_for_select->fetch_assoc()): ?>
                            <option value="<?= $item['id'] ?>"><?= htmlspecialchars($item['title']) ?></option>
                        <?php endwhile; ?>
                    </select>

                    <input type="checkbox" name="agree_delete" value="1" id="delete-checkbox">
                    <label for="agree_delete">Я хочу удалить выбранную новость</label>
                    <button type="submit" name="confirm_delete" class="delete-btn">Удалить новость</button>
            </form>
        </div>
    </main>
    <footer>
        2026 ООО "УЗГТ"
    </footer>
</body>
</html>