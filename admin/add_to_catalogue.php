<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin.php?token=...');
    exit;
}
require_once '../config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $category = $_POST['category'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = (int)trim($_POST['price'] ?? '0');
    $image = trim($_POST['image'] ?? '');
    $verified = isset($_POST['verify']);

    if (empty($image)) {
        $image = "/imgs/default.jpg";
    }

    if ($verified && !empty($name) && $price > 0 && !empty($category)) {
        $conn->query("INSERT INTO $category (name, price, description, image) 
                      VALUES ('$name', '$price', '$description', '$image')");
        $error = "Товар успешно добавлен!";
    } else {
        $error = "Заполните название, цену, выберите категорию и подтвердите информацию";
    }
}

// ========== УДАЛЕНИЕ ТОВАРА ==========
$delete_error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_delete'])) {
    $delete_id = (int)($_POST['product_id'] ?? 0);
    $delete_category = $_POST['product_category'] ?? '';
    $agree = isset($_POST['agree_delete']);

    if ($delete_id > 0 && $agree && !empty($delete_category)) {
        $table = ($delete_category == 'parts') ? 'parts' : 'catalog';
        $conn->query("DELETE FROM $table WHERE id = $delete_id");
        header('Location: add_to_catalogue.php');
        exit;
    } else {
        $delete_error = "Подтвердите удаление, выбрав товар и поставив галочку";
    }
}

// ========== ПОЛУЧАЕМ СПИСОК ТОВАРОВ ДЛЯ ВЫПАДАЮЩЕГО СПИСКА ==========
$selected_category = $_GET['cat'] ?? 'catalog';
$table_for_select = ($selected_category == 'catalog') ? 'catalog' : 'parts';
$products_for_select = $conn->query("SELECT id, name FROM $table_for_select ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление товарами</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php include "header.php"; ?>
    <main>
        <h2>Добавить товар</h2>
        <div class="form-container">
            <?php if ($error !== ''): ?>
                <div class="<?= strpos($error, '✅') !== false ? 'success-message' : 'error-message' ?>">
                    <p><?= $error ?></p>
                </div>
            <?php endif; ?>
            <form method="POST">
                <select name="category" required>
                    <option value="">-- Выберите категорию --</option>
                    <option value="parts">Запчасти</option>
                    <option value="catalog">Снегоболотоходы</option>
                </select>
                <input type="text" name="name" placeholder="Название" required>
                <input type="text" name="image" placeholder="Изображение - путь к файлу">
                <input type="text" name="description" placeholder="Описание" required>
                <input type="number" name="price" placeholder="Цена" required>
                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" name="verify" value="1" required>
                        Указана верная информация
                    </label>
                </div>
                <button type="submit" name="add_product">Добавить товар</button>
            </form>
        </div>

        <h2>Удалить товар</h2>
        <?php if ($delete_error !== ''): ?>
            <div class="error-message"><p><?= $delete_error ?></p></div>
        <?php endif; ?>
        <div class="form-container">
            <form method="POST" id="delete-product-form">
                <div class="form-group">
                    <label>Категория товара:</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="product_category" value="catalog" 
                                   <?= $selected_category == 'catalog' ? 'checked' : '' ?>
                                   onchange="location.href='?cat=catalog'"> Снегоболотоходы
                        </label>
                        <label>
                            <input type="radio" name="product_category" value="parts" 
                                   <?= $selected_category == 'parts' ? 'checked' : '' ?>
                                   onchange="location.href='?cat=parts'"> Запчасти
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="product_id">Выберите товар для удаления:</label>
                    <select name="product_id" id="product_id" required>
                        <option value="">-- Выберите товар --</option>
                        <?php while ($item = $products_for_select->fetch_assoc()): ?>
                            <option value="<?= $item['id'] ?>"><?= htmlspecialchars($item['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" name="agree_delete" value="1">
                        Я хочу удалить выбранный товар
                    </label>
                </div>

                <button type="submit" name="confirm_delete" class="delete-btn">Удалить товар</button>
            </form>
        </div>
    </main>
    <footer>
        2026 ООО "УЗГТ"
    </footer>
</body>
</html>