<?php
require_once 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id == 0) { echo 'Неверный ID'; exit; }

$result = $conn->query("SELECT * FROM catalog WHERE id = $id");
if ($result->num_rows == 0) { echo 'Модель не найдена'; exit; }

$model = $result->fetch_assoc();

// Запрашиваем характеристики для этой модели
$specs_result = $conn->query("SELECT * FROM specifications WHERE model_id = $id ORDER BY sort_order, id");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($model['name']) ?> — УЗГТ</title>
    <link rel="stylesheet" href="/main.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="product-page">
            <div class="product-container">
                <h3><?= htmlspecialchars($model['name']) ?></h3>
                <div class="product-img">
                    <img src="<?= htmlspecialchars($model['image']) ?>" alt="<?= htmlspecialchars($model['name']) ?>">
                </div>
            </div>

            <div class="product-info">
                <a href="models.php" class="back-btn">← Назад к каталогу</a>
                <h2 class="price"><?= htmlspecialchars($model['price']) ?></h2>
                <p class="warning">После оставления заявки менеджер позвонит вам для уточнения цены</p>
                <button class="card-btn" data-id="<?= $model['id'] ?>" data-name="<?= $model['name'] ?>">Запросить цену</button>
                <p><?= nl2br(htmlspecialchars($model['description'])) ?></p>
            </div>
        </div>
         <div class="product-page">
             <?php if ($specs_result && $specs_result->num_rows > 0): ?>
                <h4 class="specs-title">Технические характеристики</h4>
                <table class="specs-table">
                    <?php while ($spec = $specs_result->fetch_assoc()): ?>
                    <tr>
                        <th><?= htmlspecialchars($spec['spec_name']) ?></th>
                        <td><?= nl2br(htmlspecialchars($spec['spec_value'])) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p style="color: #888; margin-top: 20px;">Технические характеристики отсутствуют.</p>
            <?php endif; ?>
         </div>
        
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>