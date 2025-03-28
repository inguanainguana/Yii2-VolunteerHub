-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 17 2025 г., 10:01
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `volunteerhub`
--

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE `event` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `start_date`, `end_date`, `location`, `image`, `user_id`) VALUES
(24, 'Чистый город: волонтёрская акция по уборке', 'Приглашаем всех неравнодушных жителей города присоединиться к нашей волонтёрской акции по уборке общественных мест. Вместе мы сделаем наш город чище и уютнее! В программе — уборка парка, высадка деревьев и кустарников, а также дружеское общение и обмен опытом. Все желающие могут принести с собой перчатки и удобную одежду. Мы предоставим необходимые инструменты и материалы.', '2025-04-15 16:00:00', '2025-04-15 20:00:00', 'Парк \"Солнечный\", вход с улицы Цветочной', 'uploads/субботник4(1).jpg', 5),
(26, 'Помощь в приюте для животных \"Верный друг\"', 'Волонтёры будут помогать в выгуле собак, уборке вольеров, кормлении животных, а также в небольших ремонтных работах на территории приюта (покраска, починка ограждений).', '2025-03-14 12:00:00', '2025-03-17 12:00:00', 'Приют для животных \"Верный друг\", ул. Солнечная, д. 12.', 'uploads/Dl3jl4WN-po.jpg', 5),
(27, 'Подготовка к благотворительной ярмарке \"Руками добра\"', 'Волонтёры будут изготавливать различные поделки (вязаные вещи, открытки, сувениры и т.д.) для продажи на ярмарке. Все собранные средства будут направлены на помощь нуждающимся детям.', '2025-03-14 15:00:00', '2025-03-14 21:00:00', 'Общественный центр \"Вместе\", ул. Центральная, д. 8.', 'uploads/1623057777_197913_26.jpg', 6),
(28, 'Помощь в организации спортивного праздника для детей с ограниченными возможностями здоровья', 'Волонтёры будут помогать детям с ОВЗ участвовать в спортивных мероприятиях, следить за их безопасностью, раздавать воду и призы, поддерживать участников.', '2025-03-21 13:00:00', '2025-03-21 17:40:00', 'Стадион \"Авангард\", ул. Спортивная, д. 1.', 'uploads/volunteer_1888823_960_720.png', 6),
(29, '\"День радости для бабушек и дедушек\"', 'Подарите частичку тепла и внимания пожилым людям, живущим в доме престарелых \"Забота\"! В этот день мы будем помогать им в бытовых вопросах, читать книги, играть в настольные игры, проводить время за беседами и просто дарить хорошее настроение. Ваше участие очень важно для тех, кто нуждается в общении и поддержке.', '2025-04-20 11:20:00', '2025-04-20 16:20:00', 'Дом престарелых \"Забота\", ул. Мира, д. 22', 'uploads/53dd0fe25ea7f544b888360f5a94d406.jpg', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` int NOT NULL,
  `event_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `event_registrations`
--

INSERT INTO `event_registrations` (`id`, `event_id`, `user_id`, `registration_date`, `status`) VALUES
(17, 26, 6, '2025-03-15 17:37:21', '2'),
(19, 29, 5, '2025-03-15 18:01:47', '1'),
(20, 28, 7, '2025-03-15 18:05:16', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `follows`
--

CREATE TABLE `follows` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `followed_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `follows`
--

INSERT INTO `follows` (`id`, `user_id`, `followed_id`) VALUES
(8, 6, 5),
(9, 7, 6),
(10, 7, 5),
(11, 5, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1741077003),
('m250303_083219_create_user_table', 1741077004),
('m250304_040414_create_event_table', 1741077004),
('m250304_041923_create_event_registrations_table', 1741077004),
('m250310_114623_create_follows_table', 1741608085),
('m250310_115001_create_reviews_table', 1741608085);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `event_id` int DEFAULT NULL,
  `description` text,
  `rating` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_active` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `event_id`, `description`, `rating`, `created_at`, `is_active`) VALUES
(16, 6, 26, 'Организаторы сделали все возможное, чтобы создать теплую и дружелюбную атмосферу. Мы не только помогали ухаживать за животными, но и общались с ними, что принесло массу положительных эмоций. Я был приятно удивлён, насколько много людей пришло поддержать эту важную инициативу. Мы все объединились ради одной цели – помочь бездомным животным найти заботливые руки. ', '5', '2025-03-15 17:38:59', 1),
(17, 7, 26, 'Неплохо.', '4', '2025-03-15 18:03:18', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_admin` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `patronymic`, `username`, `email`, `phone_number`, `password`, `is_admin`) VALUES
(1, 'Валерий', 'Никулин', 'Андреевич', 'valery_super\r\n', 'inna.komogorova.6_9@mail.ru', '+7 (885) 385-89-64', '$2y$13$Sds/wKR2UjIN3o733wGQI.OwX1tlfl3AVQt2yAVD2p36w92T3aIAa', 0),
(2, 'Викторианна', 'Эко', 'Мартиевна', 'victorianna_eco', 'victoria_eco@mail.ru', '+7 (933) 333-33-33', '$2y$13$44Laaf3M7ZJtPk/fBX.Kr.TTgSlpq3tx.Jn3yl21hciXic1A77uku', 1),
(5, 'Алиса', 'Жемчугова', 'Андреевна', 'alisss', 'alissa@mail.ru', '+7 (982) 434-73-47', '$2y$13$J7hxXc/wdk8ETqb3d6whXuqQDMeEfHS2wYxTasR4a4WMc/Cv7yPOW', 0),
(6, 'Артём', 'Чернышов', 'Кириллович', 'super_volunteer', 'inga.komogorova.6_9@mail.ru', '+7 (999) 999-99-99', '$2y$13$HS/h.X1c5kNh6Xog1LpSOuJBTHV7F.FSppodZwC2r1mpc.63X95VO', 0),
(7, 'Кирилл', 'Пугачёв', 'Кириллович', 'user1', 'user@mail.ru', '+7 (942) 942-54-35', '$2y$13$DdqPzkfWdK4LXh2fwTsqAubTcRBuZx49gdO/sKCJIJv/iK6QO4eJ6', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_event_fk` (`user_id`);

--
-- Индексы таблицы `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id_event_registrations_fk` (`event_id`),
  ADD KEY `user_id_event_registrations_fk` (`user_id`);

--
-- Индексы таблицы `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_follows_fk` (`user_id`),
  ADD KEY `followed_id_follows_fk` (`followed_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_reviews_fk` (`user_id`),
  ADD KEY `event_id_reviews_fk` (`event_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `user_id_event_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_id_event_registrations_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_event_registrations_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `followed_id_follows_fk` FOREIGN KEY (`followed_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_follows_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `event_id_reviews_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_reviews_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
