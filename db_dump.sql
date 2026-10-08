-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 08 2026 г., 06:31
-- Версия сервера: 8.0.30
-- Версия PHP: 8.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `uzgt_news`
--
CREATE DATABASE IF NOT EXISTS `uzgt_news` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `uzgt_news`;

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT '/imgs/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `price`, `description`, `image`) VALUES
(1, 'УЗГТ-801', 'от 4 200 000 ₽', 'Отличная проходимость, гусеницы выдерживают -50°C', '/imgs/801.png'),
(2, 'ТГМ-2 МТЛБу с КМУ', 'от 5 800 000 ₽', 'Высокая маневренность, алюминиевый корпус', '/imgs/tgm-2.png'),
(3, 'УЗГТ-602', 'от 3 900 000 ₽', 'Низкая стоимость запчастей, лебёдка в базе', '/imgs/602.png');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Не предоставлен',
  `message` text NOT NULL,
  `product_id` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL DEFAULT 'Запрос на звонок или письмо'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `phone`, `email`, `message`, `product_id`, `created_at`, `title`) VALUES
(15, 'test 2', '+79991234567', 'asdasdddd@asdasd', 'А ещё стремящиеся вытеснить традиционное производство, нанотехнологии своевременно верифицированы. Принимая во внимание показатели успешности, сложившаяся структура организации требует анализа поставленных обществом задач. Разнообразный и богатый опыт говорит нам, что начало повседневной работы по формированию позиции создаёт предпосылки для благоприятных перспектив. Идейные соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности, а также свежий взгляд на привычные вещи — безусловно открывает новые горизонты для распределения внутренних резервов и ресурсов.', 1, '2026-04-20 12:03:45', 'Запрос цены на: УЗГТ-801'),
(16, 'test 3', '+79991234567', 'Не предоставлен', 'А ещё стремящиеся вытеснить традиционное производство, нанотехнологии своевременно верифицированы. Принимая во внимание показатели успешности, сложившаяся структура организации требует анализа поставленных обществом задач. Разнообразный и богатый опыт говорит нам, что начало повседневной работы по формированию позиции создаёт предпосылки для благоприятных перспектив. Идейные соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности, а также свежий взгляд на привычные вещи — безусловно открывает новые горизонты для распределения внутренних резервов и ресурсов.', 1, '2026-04-20 12:04:06', 'Запрос цены на: УЗГТ-801'),
(18, 'ASDASD', '+79962306534', 'ponandralena@gmail.com', 'Список заказанных запчастей:\r\n\r\nТопливный фильтр — 1200 ₽ × 1 = 1200 ₽\r\nТермостат — 1200 ₽ × 1 = 1200 ₽\r\n\r\nИтого: 2400 ₽\r\n\r\nПожалуйста, свяжитесь со мной для уточнения деталей.', 0, '2026-06-07 10:08:16', 'Заказ запчастей');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT '/imgs/news-default.jpg',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `created_at`) VALUES
(1, 'Новая модель УЗГТ-802', 'Мы рады представить обновлённую модель снегоболотохода УЗГТ-802 с усиленной подвеской и экономичным двигателем. Подробности уточняйте у менеджеров.', '/imgs/news1.jpg', '2026-04-17 07:00:29'),
(2, 'Расширение сервисного центра', 'Теперь обслуживание техники доступно в Тюмени и Сургуте. Запись по телефону +7 (343) 269-04-39.', '/imgs/news2.jpg', '2026-04-17 07:00:29'),
(3, 'Участие в выставке \"Иннопром-2026\"', 'Приглашаем посетить наш стенд 15–18 июля. Будем показывать новые модели и отвечать на вопросы.', '/imgs/news3.jpg', '2026-04-17 07:00:29');

-- --------------------------------------------------------

--
-- Структура таблицы `parts`
--

CREATE TABLE `parts` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT '/imgs/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `parts`
--

INSERT INTO `parts` (`id`, `name`, `price`, `description`, `image`) VALUES
(23, 'Гусеничная лента (звено)', '8500', 'Резино-армированная, выдерживает -50°C до +40°C', '/imgs/parts/1.jpg'),
(24, 'Опорный каток', '12500', 'Усиленный, с подшипниками закрытого типа', '/imgs/parts/2.jpg'),
(25, 'Ведущее колесо', '18900', 'Литое, повышенной износостойкости', '/imgs/parts/3.jpg'),
(26, 'Топливный фильтр', '1200', 'Тонкой очистки, оригинал', '/imgs/parts/4.jpg'),
(27, 'Тормозная колодка', '3400', 'Комплект на одно колесо', '/imgs/parts/5.jpg'),
(28, 'Фара LED', '5600', 'Светодиодная, влагозащищённая', '/imgs/parts/6.jpg'),
(29, 'Ремень генератора', '2100', 'Оригинальный, резиновый', '/imgs/parts/7.jpg'),
(30, 'Подшипник ступицы', '3200', 'Закрытого типа, смазанный', '/imgs/parts/8.jpg'),
(31, 'Трос ручника', '1800', 'Стальной, в оплётке', '/imgs/parts/9.jpg'),
(32, 'Аккумулятор 6СТ-190', '15400', 'Тяговый, для дизельных двигателей', '/imgs/parts/10.jpg'),
(33, 'Стартер', '8900', '12V, 4 кВт, редукторный', '/imgs/parts/11.jpg'),
(34, 'Генератор', '12500', '14V, 120A, с регулятором напряжения', '/imgs/parts/12.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `specifications`
--

CREATE TABLE `specifications` (
  `id` int NOT NULL,
  `model_id` int NOT NULL COMMENT 'ID модели из таблицы catalog',
  `spec_name` varchar(255) NOT NULL COMMENT 'Название характеристики (например, "Двигатель")',
  `spec_value` text NOT NULL COMMENT 'Значение характеристики',
  `sort_order` int DEFAULT '0' COMMENT 'Порядок сортировки'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `specifications`
--

INSERT INTO `specifications` (`id`, `model_id`, `spec_name`, `spec_value`, `sort_order`) VALUES
(1, 1, 'Двигатель', 'Дизельный, 80 л.с.', 1),
(2, 1, 'Грузоподъёмность', '1500 кг', 2),
(3, 1, 'Максимальная скорость', '45 км/ч', 3),
(4, 1, 'Расход топлива', '12 л/100 км', 4),
(5, 1, 'Ёмкость топливного бака', '120 л', 5),
(6, 2, 'Двигатель', 'Дизельный, 120 л.с.', 1),
(7, 2, 'Грузоподъёмность', '2000 кг', 2),
(8, 2, 'Максимальная скорость', '60 км/ч', 3),
(9, 2, 'Расход топлива', '18 л/100 км', 4),
(10, 2, 'Ёмкость топливного бака', '200 л', 5),
(11, 2, 'Тип подвески', 'Торсионная', 6),
(12, 2, 'КМУ (грузоподъёмность крана)', '1000 кг', 7),
(13, 3, 'Двигатель', 'Дизельный, 95 л.с.', 1),
(14, 3, 'Грузоподъёмность', '1200 кг', 2),
(15, 3, 'Вместимость кабины', '4 человека', 3),
(16, 3, 'Максимальная скорость', '50 км/ч', 4),
(17, 3, 'Расход топлива', '14 л/100 км', 5),
(18, 3, 'Ёмкость топливного бака', '150 л', 6),
(19, 3, 'Лебедка', 'Электрическая, 2500 кг', 7),
(20, 3, 'Обогрев кабины', 'Автономный отопитель', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `created_at`) VALUES
(4, 'admin', '$2y$10$AzCFiRz.w7tPIQ8UoYUoKeW3o.qYSwpKumEZaA6fiKvPYOzPa87AK', '2026-04-19 12:20:46');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model_id` (`model_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `specifications`
--
ALTER TABLE `specifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `specifications`
--
ALTER TABLE `specifications`
  ADD CONSTRAINT `specifications_ibfk_1` FOREIGN KEY (`model_id`) REFERENCES `catalog` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
