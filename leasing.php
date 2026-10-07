<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/main.css">
    <title>Лизинг спецтехники — УЗГТ</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="leasing-hero">
            <div class="leasing-hero-content">
                <h1>Лизинг спецтехники УЗГТ</h1>
                <p>Приобретайте снегоболотоходы и запчасти в лизинг на выгодных условиях</p>
            </div>
        </section>

        <div class="leasing-container">
            <div class="leasing-grid">
                <div class="leasing-card">
                    <h3>Аванс от 0%</h3>
                    <p>Возможность без первоначального взноса для юридических лиц</p>
                </div>
                <div class="leasing-card">
                    <h3>Срок до 60 месяцев</h3>
                    <p>Гибкий график платежей, подбор индивидуального срока</p>
                </div>
                <div class="leasing-card">
                    <h3>Упрощённый пакет документов</h3>
                    <p>Решение за 1–3 рабочих дня</p>
                </div>
                <div class="leasing-card">
                    <h3>Доставка в любом регионе РФ</h3>
                    <p>Техника поставляется напрямую с завода</p>
                </div>
            </div>

            <div class="conditions-list">
                <h3>Условия лизинга</h3>
                <ul>
                    <li>Сумма лизинга — от 500 000 ₽</li>
                    <li>Аванс — от 0% до 49% (зависит от финансового состояния клиента)</li>
                    <li>Срок — от 12 до 60 месяцев</li>
                    <li>Валюта договора — российский рубль</li>
                    <li>Возможно досрочное погашение без штрафов</li>
                    <li>Предмет лизинга остаётся на балансе лизингодателя до полной выплаты</li>
                    <li>Страхование КАСКО – на выбор клиента</li>
                </ul>
            </div>

             <div class="contacts-form">
                <h3>Напишите нам</h3>
                <form action="send_feedback.php" method="POST">
                <input type="text" name="name" placeholder="Ваше имя" required>
                <input type="tel" name="phone" placeholder="Телефон" required>
                <input type="email" name="email" placeholder="Email">
                <textarea name="message" rows="5" placeholder="Сообщение" required>Запрос на лизинг</textarea>
                <button type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>