<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/main.css">
    <title>Каталог запчастей - УЗГТ</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="catalog-page">
            <div class="catalog-container">
                <h1 class="catalog-title">Каталог запчастей</h1>
                <p class="catalog-subtitle">Детали для вездеходной техники</p>

                <!--БЛОК КОРЗИНЫ-->
                <div class="cart-container" id="cart-container">
                    <h3 class="cart-title">Корзина</h3>
                    <div id="cart-items-list" class="cart-items"></div>
                    <div id="cart-total" class="cart-total"></div>
                    <div class="cart-buttons">
                        <button class="clear-cart" onclick="clearCart()">Очистить корзину</button>
                        <button class="checkout-btn" onclick="checkout()">Оформить заказ</button>
                    </div>
                </div>

                <!-- ФОРМА ПОИСКА-->
                <div class="search-form" style="margin-bottom: 20px; text-align: center;">
                    <form method="GET" action="">
                        <input type="text" name="search" placeholder="Поиск по названию..." 
                               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                               style="padding: 10px; width: 300px; border-radius: 8px; border: 1px solid #ddd;">
                        <input type="hidden" name="sort" value="<?= htmlspecialchars($_GET['sort'] ?? 'default') ?>">
                        <button type="submit" style="padding: 10px 20px; background: #1a2c3e; color: white; border: none; border-radius: 8px; cursor: pointer;">Найти</button>
                        <?php if (!empty($_GET['search'])): ?>
                            <a href="catalogue_parts.php<?= !empty($_GET['sort']) ? '?sort=' . urlencode($_GET['sort']) : '' ?>" style="margin-left: 10px; color: #1a2c3e;">Сбросить</a>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- ФОРМА СОРТИРОВКИ -->
                <div class="sort-form">
                    <form method="GET" action="">
                        <input type="hidden" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                        <label for="sort">Сортировать по:</label>
                        <select name="sort" id="sort" onchange="this.form.submit()">
                            <option value="default" <?= ($_GET['sort'] ?? 'default') == 'default' ? 'selected' : '' ?>>По умолчанию</option>
                            <option value="name_asc" <?= ($_GET['sort'] ?? '') == 'name_asc' ? 'selected' : '' ?>>Название (А-Я)</option>
                            <option value="name_desc" <?= ($_GET['sort'] ?? '') == 'name_desc' ? 'selected' : '' ?>>Название (Я-А)</option>
                            <option value="price_asc" <?= ($_GET['sort'] ?? '') == 'price_asc' ? 'selected' : '' ?>>Цена (сначала дешёвые)</option>
                            <option value="price_desc" <?= ($_GET['sort'] ?? '') == 'price_desc' ? 'selected' : '' ?>>Цена (сначала дорогие)</option>
                        </select>
                        <noscript><button type="submit">Применить</button></noscript>
                    </form>
                </div>

                <!-- СЕТКА ТОВАРОВ -->
                <div class="catalog-grid">
                    <?php
                    $sort = $_GET['sort'] ?? 'default';
                    $order_by = 'id ASC';
                    switch ($sort) {
                        case 'name_asc': $order_by = 'name ASC'; break;
                        case 'name_desc': $order_by = 'name DESC'; break;
                        case 'price_asc': $order_by = 'CAST(price AS UNSIGNED) ASC'; break;
                        case 'price_desc': $order_by = 'CAST(price AS UNSIGNED) DESC'; break;
                        default: $order_by = 'id ASC';
                    }

                    $search = trim($_GET['search'] ?? '');
                    $where = '';
                    if ($search !== '') {
                        $escaped_search = $conn->real_escape_string($search);
                        $where = "WHERE name LIKE '%$escaped_search%'";
                    }

                    $result = $conn->query("SELECT * FROM parts $where ORDER BY $order_by");
                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                    ?>
                        <div class="card" data-id="<?= $row['id'] ?>" data-name="<?= htmlspecialchars($row['name']) ?>" data-price="<?= $row['price'] ?>">
                            <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                            <h3><?= htmlspecialchars($row['name']) ?></h3>
                            <p class="price"><?= htmlspecialchars($row['price']) ?> ₽</p>
                            <p><?= htmlspecialchars($row['description']) ?></p>
                            <button class="parts-btn add-to-cart">В корзину</button>
                        </div>
                    <?php 
                        endwhile;
                    else:
                    ?>
                        <p class="empty-message">Запчасти не найдены. Попробуйте другой запрос.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        let cart = [];

        function loadCart() {
            const saved = localStorage.getItem('parts_cart');
            if (saved) {
                cart = JSON.parse(saved);
            } else {
                cart = [];
            }
            renderCart();
        }

        function saveCart() {
            localStorage.setItem('parts_cart', JSON.stringify(cart));
            renderCart();
        }

        function addToCart(id, name, price) {
            const existing = cart.find(item => item.id == id);
            if (existing) {
                existing.quantity++;
            } else {
                cart.push({ id, name, price: parseInt(price), quantity: 1 });
            }
            saveCart();
        }

        function updateQuantity(id, delta) {
            const index = cart.findIndex(item => item.id == id);
            if (index !== -1) {
                const newQuantity = cart[index].quantity + delta;
                if (newQuantity <= 0) {
                    cart.splice(index, 1);
                } else {
                    cart[index].quantity = newQuantity;
                }
                saveCart();
            }
        }

        function removeItem(id) {
            cart = cart.filter(item => item.id != id);
            saveCart();
        }

        function clearCart() {
            cart = [];
            saveCart();
        }

        function renderCart() {
            const container = document.getElementById('cart-items-list');
            const totalContainer = document.getElementById('cart-total');
            if (!container) return;

            if (cart.length === 0) {
                container.innerHTML = '<div class="empty-cart">Корзина пуста</div>';
                totalContainer.innerHTML = '';
                return;
            }

            let total = 0;
            let html = '<ul class="cart-items">';
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                html += `
                    <li class="cart-item">
                        <div class="cart-item-info">
                            <div class="cart-item-name">${escapeHtml(item.name)}</div>
                            <div class="cart-item-price">${item.price} ₽ × ${item.quantity} = ${itemTotal} ₽</div>
                        </div>
                        <div class="cart-item-actions">
                            <button onclick="updateQuantity(${item.id}, -1)">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="updateQuantity(${item.id}, 1)">+</button>
                            <button class="remove-btn" onclick="removeItem(${item.id})">🗑</button>
                        </div>
                    </li>
                `;
            });
            html += '</ul>';
            container.innerHTML = html;
            totalContainer.innerHTML = `<strong>Итого: ${total} ₽</strong>`;
        }

        function escapeHtml(str) {
            return str.replace(/[&<>]/g, function(m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            });
        }

        function checkout() {
            if (cart.length === 0) {
                alert('Корзина пуста. Добавьте товары.');
                return;
            }

            let messageText = 'Список заказанных запчастей:\n\n';
            let total = 0;
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                messageText += `${item.name} — ${item.price} ₽ × ${item.quantity} = ${itemTotal} ₽\n`;
            });
            messageText += `\nИтого: ${total} ₽\n\nПожалуйста, свяжитесь со мной для уточнения деталей.`;

            if (typeof openCartFeedbackModal === 'function') {
                openCartFeedbackModal(messageText, 'Заказ запчастей');
            } else {
                alert('Ошибка: форма обратной связи не загружена');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadCart();

            const addButtons = document.querySelectorAll('.add-to-cart');
            addButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const card = this.closest('.card');
                    const id = card.getAttribute('data-id');
                    const name = card.getAttribute('data-name');
                    const price = card.getAttribute('data-price');
                    addToCart(id, name, price);
                });
            });
        });
    </script>
</body>
</html>