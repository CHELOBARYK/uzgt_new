<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/main.css">
        <title>Главная - УЗГТ</title>
    </head>
    <body>
        <header>
                <div class="main">
                    <a href="index.php">
                        <img src="/imgs/logo.png" alt="logo">
                    </a>
                    <div class="socials">
                        <a href="tel:+79122960268">+79122960268</a>
                        <a href="mailto:uzgt-ural@yandex.ru">uzgt-ural@yandex.ru</a>
                        <a href="https://vk.com/uzgtural"><img src="imgs/vk-icon.png" alt="vk" class="icon"></a>
                        <a href="#contacts"><button>Рассчитать</button></a>
                    </div>
                </div>
                <nav class="navbar">
                    <ul class="nav-menu">
                    <li><a href="index.php">Главная</a></li>
                    <li class="dropdown-btn">
                        <a href="catalogue.php">Каталог</a>
                        <ul class=dropdown-menu>
                            <li><a href="catalogue_parts.php">Запчасти</a></li>
                            <li><a href="models.php">Снегоболотоходы</a></li>
                        </ul>
                    </li>
                    <li><a href="news.php">Новости</a></li>
                    <li><a href="leasing.php">Лизинг</a></li>
                    </ul>
                </nav>
                <nav class="navbar-landing">
                    <ul class="landing-menu">
                    <li><a href="#carousel">Главная</a></li>
                    <li><a href="#about">Почему мы?</a></li>
                    <li><a href="#models">Снегоболотоходы</a></li>
                    <li><a href="#contacts">Контакты</a></li>
                    </ul>
                </nav>
        </header>
        <main>
        <section class="carousel-carousel">
        <div class="carousel-slides">
            <div class="carousel-slide active">
                <div class="carousel-bg" style="background-image: url('/imgs/carousel1.jpg');"></div>
                <div class="carousel-content">
                    <h1>ООО «УЗГТ»</h1>
                    <p>Техника для суровых условий</p>
                    <a href="catalogue.php" class="carousel-btn">Перейти в каталог</a>
                </div>
            </div>
            <div class="carousel-slide">
                <div class="carousel-bg" style="background-image: url('/imgs/carousel2.jpg');"></div>
                <div class="carousel-content">
                    <h1>Надёжность в любых условиях</h1>
                    <p>Техника для бездорожья</p>
                    <a href="catalogue.php" class="carousel-btn">Смотреть модели</a>
                </div>
                </div>
            <div class="carousel-slide">
                <div class="carousel-bg" style="background-image: url('/imgs/carousel3.jpg');"></div>
                <div class="carousel-content">
                    <h1>Собственное производство</h1>
                    <p>От чертежа до готового изделия</p>
                    <a href="catalogue.php" class="carousel-btn">Открыть каталог</a>
                </div>
            </div>
        </div>
        <button class="carousel-prev">❮</button>
        <button class="carousel-next">❯</button>
        <div class="carousel-dots"></div>
        </section>
        <section class="about"  id="about">
            <div class="about-container">
                <div class="about-left">
                <h2>Почему выбирают нас</h2>
                <ul class="about-list">
                    <li>Опыт работы более 15 лет</li>
                    <li>Сертифицированная продукция</li>
                    <li>Индивидуальный подход к каждому клиенту</li>
                    <li>Полный цикл: от чертежа до готового изделия</li>
                    <li>Собственное производство на Урале</li>
                    <li>Доставка во все регионы России</li>
                </ul>
                </div>
                <div class="about-right">
                <img src="/imgs/about.png" alt="О компании">
                <div class="about-text">
                    <h3>ООО «УРАЛЬСКИЙ ЗАВОД ГУСЕНИЧНЫХ ТЯГАЧЕЙ»</h3>
                    <p>
                        Это современное, инновационное предприятие, лидер в Уральском регионе, основной сферой деятельности которого является разработка и производство гусеничных снегоболотоходов УЗГТ и их модификаций.
                    </p>
                    <p>
                         Эти надежные и неприхотливые машины, полюбившиеся как военным, так и гражданским специалистам работающим в геологоразведке, сейсморазведке, нефтегазовой отрасли, золотодобывающих, лесоперерабатывающих компаниях, стали прообразом новых, современных и комфортабельных машин. 
                    </p>
                    <p>
                        Инженеры компании усовершенствовали существующие модели и создали по-настоящему комфортный для эксплуатации транспорт, который можно использовать даже в самом суровом климате.
                    </p>
                </div>
                </div>
            </div>
        </section>
        <section class="models" id="models">
        <div class="models-container">
            <h2 class="models-title">Наши снегоболотоходы</h2>
            <p class="models-subtitle">Техника, созданная для суровых условий Урала и Сибири</p>
            <a href="model_profile.php?id=1">
                <div class="model-row">
                    <div class="model-image">
                        <img src="/imgs/801.png" alt="Модель 1">
                    </div>
                    <div class="model-info">
                        <h3>УЗГТ-801</h3>
                        <p class="model-advantage">Отличная проходимость</p>
                        <p class="model-desc">Специальная резина-армированная гусеница выдерживает перепады температур от -50°C до +40°C. Идеален для нефтяников и геологов.</p>
                    </div>
                </div>
            </a>
            <a href="model_profile.php?id=2">
                <div class="model-row reverse">
                    <div class="model-info">
                        <h3>ТГМ-2 МТЛБу с КМУ</h3>
                        <p class="model-advantage">Высокая маневренность</p>
                        <p class="model-desc">Лёгкий корпус из алюминиевых сплавов. Преодолевает болота и глубокие колеи. Легко модернизируется под любые задачи.</p>
                    </div>
                    <div class="model-image">
                        <img src="/imgs/tgm-2.png" alt="Модель 2">
                    </div>
                </div>
            </a>
            <a href="model_profile.php?id=3">
                <div class="model-row">
                    <div class="model-image">
                        <img src="/imgs/602.png" alt="Модель 3">
                    </div>
                    <div class="model-info">
                        <h3>УЗГТ-602</h3>
                        <p class="model-advantage">Низкая стоимость запчастей</p>
                        <p class="model-desc">Теплоизолированная кабина для экипажа из 4 человек. Встроенная лебёдка и дополнительный бак для топлива.</p>
                    </div>
                </div>
            </a>
        </div>
        </section>
        <section class="contacts-full" id="contacts">
        <div class="contacts-map">
           <iframe id="map_98964783" frameborder="0" width="100%" height="600px" src="https://makemap.2gis.ru/widget?data=eJw1j8FqhDAQht9lepUlupqosCdhF5ce9NTSsgdrhjYQHYlZ6FZ8946xzSn8_8yXLwuQ0-hQX5AG9M7gDOX7Av4xIZRwxs7fHUIEk6MJnQ8918bbrRdX1Y6-wrp6bqmoXsW1acnUJ17QOPfOTN7QyIMc9GTJ8fWp--gznXPyU48av6GMxf9ZI_jcRR7hmd2iITP6QGBZM3Y-SEpxUCpJiyLK5EHFqpDpjfeN3oBKrbcIhm5qaDa7wwK281D-DYskSYo0z_JjBHarAy6NkzSXQsljJtmPaGBYzlT-C1n78oVo30Lq3R3XX9atYW4" sandbox="allow-modals allow-forms allow-scripts allow-same-origin allow-popups allow-top-navigation-by-user-activation"></iframe>
        </div>
        <div class="contacts-bottom">
            <div class="contacts-container">
            <div class="contacts-form">
                <h3>Напишите нам</h3>
                <form action="send_feedback.php" method="POST">
                <input type="text" name="name" placeholder="Ваше имя" required>
                <input type="tel" name="phone" placeholder="Телефон" required>
                <input type="email" name="email" placeholder="Email">
                <textarea name="message" rows="5" placeholder="Сообщение" required></textarea>
                <button type="submit">Отправить</button>
                </form>
            </div>
            <div class="contacts-info">
                <h3>Контакты</h3>
                <div class="contact-item">
                    <h5>Телефон</h5>
                    <a href="tel:+73432690439">+7 343 269-04-39</a>
                    <a href="tel:+73432690439">+7 343 269-04-39</a>
                </div>
                <div class="contact-item">
                    <h5>E-mail</h5>
                    <a href="mailto:uzgt-ural@yandex.ru">uzgt-ural@yandex.ru</a>
                </div>
                <div class="contact-item">
                    <h5>Адрес</h5>
                    <p>г. Екатеринбург, ул. Заводская, д. 15</p>
                </div>
                <div class="contact-item">
                    <a href="https://vk.com/uzgtural"><img src="imgs/vk-icon.png" alt="vk" class="icon"></a>
                    <p>Мы вконтакте</p>
                </div>
            </div>
            </div>
        </div>
        </section>
           </main>
        <?php include 'footer.php'; ?>
    </body>
</html>