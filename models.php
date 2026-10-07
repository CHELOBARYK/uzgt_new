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
        <section class="catalog-page">
            <div class="catalog-container">
                <h1 class="catalog-title">Каталог снегоболотоходов</h1>
                <p class="catalog-subtitle">Надёжная техника для любых условий</p>

                <div class="search-form" style="margin-bottom: 30px; text-align: center;">
                    <form method="GET" action="">
                        <input type="text" name="search" placeholder="Поиск по названию..." 
                               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                               style="padding: 10px; width: 300px; border-radius: 8px; border: 1px solid #ddd;">
                        <button type="submit" style="padding: 10px 20px; background: #1a2c3e; color: white; border: none; border-radius: 8px; cursor: pointer;">Найти</button>
                        <?php if (!empty($_GET['search'])): ?>
                            <a href="models.php" style="margin-left: 10px; color: #1a2c3e;">Сбросить</a>
                        <?php endif; ?>
                    </form>
                </div>

                <div class="catalog-grid">
                    <?php
                    $search = trim($_GET['search'] ?? '');
                    $where = '';
                    if ($search !== '') {
                        $escaped_search = $conn->real_escape_string($search);
                        $where = "WHERE name LIKE '%$escaped_search%'";
                    }

                    $result = $conn->query("SELECT * FROM catalog $where ORDER BY id");
                    
                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                    ?>
                    <a href="model_profile.php?id=<?= $row['id']?>">
                        <div class="card">
                            <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                            <h3><?= htmlspecialchars($row['name']) ?></h3>
                            <p class="price"><?= htmlspecialchars($row['price']) ?></p>
                            <p class="card-descr"><?= htmlspecialchars($row['description']) ?></p>
                            <button class="card-btn" data-id="<?= $row['id'] ?>" data-name="<?= $row['name'] ?>">Запросить цену</button>
                        </div>
                    </a>
                    <?php 
                        endwhile;
                    else:
                    ?>
                        <p class="empty-message">Товары не найдены. Попробуйте другой запрос.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>