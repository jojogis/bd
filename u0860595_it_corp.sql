-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 08 2020 г., 22:08
-- Версия сервера: 5.7.27-30
-- Версия PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u0860595_it_corp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `acts_of_completion`
--

CREATE TABLE `acts_of_completion` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `scan` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `acts_of_completion`
--

INSERT INTO `acts_of_completion` (`id`, `date`, `scan`) VALUES
(1, '2016-12-15', 'complete1.png'),
(2, '0000-00-00', 'complete2.png'),
(3, '2016-01-20', 'complete3.png'),
(4, '2020-08-11', 'complete4.png');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(1, 'Web-сайт', NULL),
(2, 'Интернет-магазин', 1),
(3, 'Лэндинг', 1),
(4, 'Блог', 1),
(5, 'Android приложение', NULL),
(6, 'IOS приложение', NULL),
(7, 'Приложения для ПК', NULL),
(8, 'CRM', 7),
(9, 'Текстовый редактор', 7),
(10, 'Соц. сеть', 2),
(11, 'Доска объявлений', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `phone`) VALUES
(1, 'Google', 'США: Маунтин-Вью, Калифорния', '8 888 888 88 88'),
(2, 'Microsoft', 'Редмонд, Вашингтон, США', '7 777 777 77 77'),
(3, 'Яндекс', 'Москва', '8 (800) 250-96-'),
(4, 'Иванов Иван Иванович', 'г. Омск, ул. Пушкина', '89620527000'),
(5, ' Иванов Иван Эдуардович', 'Рязанская область, р-н Московский, Рязань, Московский район, район Приокский, Октябрьская улица, 12', '89521278478'),
(6, 'Юлина Екатерина Юрьевна', 'г. Волгоград, Советский р-н, ул. Неприезжайтесюдайная, д. 9', '922-218-36-50'),
(7, 'Бирюлина Ольга Владимировна', '12-й пр. Марьиной Рощи, 9, Москва, 127521', '89129165770'),
(8, 'Панкова Ирина Петровна', 'г. Новый Урегной, УЛ Геологоразведчиков, д. 2А, кв 112', '89220503989'),
(9, 'Батухтина Наталья Михайловна', 'г. Курган, ул. Савельева, д. 31, кв. 78', '89195858928'),
(10, 'Сипкин Вадим Владиславович', 'ул. Маршала Катукова, 20D, Москва, 123592', '89028200913');

-- --------------------------------------------------------

--
-- Структура таблицы `external_financing`
--

CREATE TABLE `external_financing` (
  `id` int(10) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `investor_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `external_financing`
--

INSERT INTO `external_financing` (`id`, `total`, `project_id`, `investor_id`) VALUES
(1, 1000, 1, 1),
(2, 0, 1, 3),
(3, 100000, 1, 6),
(4, 555, 1, 8),
(5, 987, 1, 5),
(6, 123455, 1, 4),
(7, 100000, 8, 7),
(8, 1000, 8, 1),
(9, 100000, 8, 2),
(10, 100009, 10, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `investors`
--

CREATE TABLE `investors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL DEFAULT 'Аноним',
  `address` varchar(100) DEFAULT NULL,
  `Телефон` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `investors`
--

INSERT INTO `investors` (`id`, `name`, `address`, `Телефон`) VALUES
(1, 'Facebook', 'Менло-Парк, Калифорния, США', '090-000-99-99'),
(2, 'Никонов Игорь  Александрович', 'Петровка ул., 23/10, Москва, 127051', '89090802969'),
(3, 'Аноним', '-', '88005553535'),
(4, 'Малиневская Надежда Викторовна', '2-я Хуторская ул., 9, Москва, 127287', '9178327820'),
(5, 'Касперский Евгений Валентинович', '-', '89536091192'),
(6, 'Борис Зимин', 'Москва', NULL),
(7, 'Роман Иванов', 'Доброслободская ул., 10 строение 1, Москва, 105066', '89517883449'),
(8, 'Таракин Роман Геннадьевич', 'ул. Труда, 5 а, Челябинск, Челябинская обл., 454091', '89507271417'),
(9, 'Баранников Константин Станиславович', 'ул. Мечникова, 11\r\nЧелябинск', '89090737198');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `sum` int(11) NOT NULL DEFAULT '0',
  `deadline` date DEFAULT NULL,
  `date` date NOT NULL,
  `description` longtext NOT NULL,
  `acts_of_completion_id` int(10) UNSIGNED DEFAULT NULL,
  `scan` varchar(45) DEFAULT NULL,
  `customers_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `sum`, `deadline`, `date`, `description`, `acts_of_completion_id`, `scan`, `customers_id`) VALUES
(5, 100000, '2016-12-15', '2016-01-15', 'Заказ на создание Skype.', NULL, 'order1.png', 2),
(6, 10, '2020-05-12', '2022-06-13', 'Заказ на создание Office Word 367', NULL, 'order2.png', 2),
(7, 2000000, '2015-02-02', '2014-12-13', 'Заказ на создание браузера.', 2, 'order22.png', 1),
(8, 232324, '2016-01-20', '2015-10-20', 'Заказ на создание площадки объявлений.', 3, 'order3.png', 3),
(9, 250000, '2020-08-11', '2020-01-01', 'Заказ на создание онлайн хранилища.', 4, 'order444.png', 3),
(10, 245545, '2016-02-03', '2015-02-03', 'Заказ на создание графического редактора.', NULL, 'order6.png', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `parts_of_tasks`
--

CREATE TABLE `parts_of_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `tasks_id` int(10) UNSIGNED NOT NULL,
  `programmers_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parts_of_tasks`
--

INSERT INTO `parts_of_tasks` (`id`, `name`, `description`, `tasks_id`, `programmers_id`) VALUES
(1, 'Страница корзины', NULL, 1, 1),
(2, 'header', NULL, 1, 1),
(3, 'футер', NULL, 1, 1),
(4, 'хедер, футер', NULL, 2, 1),
(5, 'Главная страница ', NULL, 1, 1),
(6, 'Главная страница ', NULL, 2, 7),
(7, 'Страница поиска', NULL, 1, 7),
(8, 'Главная страница ', NULL, 3, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `programmers`
--

CREATE TABLE `programmers` (
  `id` int(10) UNSIGNED NOT NULL,
  `birthdate` date NOT NULL,
  `name` varchar(70) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `specialization` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `programmers`
--

INSERT INTO `programmers` (`id`, `birthdate`, `name`, `phone`, `specialization`) VALUES
(1, '1990-02-15', 'Никонов Игорь  Александрович', '89090802969', 'Frontend'),
(2, '1980-01-01', 'Роман Зимин', '89889702213', 'Дизайнер'),
(3, '1997-10-22', 'Баранников Роман Геннадьевич', '89220323989', 'Тестировщик'),
(4, '1997-01-01', 'Малиневская Екатерина Витальевна', '89621127011', 'Backend (php,python,java,c#)'),
(5, '2001-08-21', 'Юлина Екатерина Александровна', '8 888 888 88 88', 'Уборщица'),
(6, '2000-11-17', 'Корченкина Ангелина Алексеевна', '89220513989', 'seo специалист'),
(7, '1990-02-03', 'Леонов Николай Петрович', '89620527222', 'Frontend');

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_by_order` tinyint(1) NOT NULL,
  `name` varchar(45) NOT NULL,
  `planned_release_date` date NOT NULL,
  `real_release_date` date DEFAULT NULL,
  `version` varchar(20) NOT NULL,
  `orders_id` int(10) UNSIGNED DEFAULT NULL,
  `categories_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `is_by_order`, `name`, `planned_release_date`, `real_release_date`, `version`, `orders_id`, `categories_id`) VALUES
(1, 0, 'Озон', '2020-10-23', NULL, '1.0', NULL, 2),
(2, 0, 'autodoc', '2018-07-11', '2019-02-14', '2.0', NULL, 2),
(3, 1, 'Skype', '2016-12-15', '2016-01-15', '2.2', 5, 7),
(4, 1, 'Office Word 367', '2022-12-17', NULL, '367.1', 6, 9),
(5, 1, 'Chrome', '2015-02-02', '2016-01-01', '3.5.12', 7, 7),
(6, 1, 'auto.ru', '2016-01-20', '2016-01-20', '1.0', 8, 11),
(7, 1, 'YandexDisc', '2020-08-11', '2020-09-11', '1.0', 9, 1),
(8, 0, 'GIMP', '2020-01-01', '2020-01-01', '2.10.14', NULL, 7),
(9, 1, 'Paint 3D', '2016-02-03', NULL, '1.5', 10, 7),
(10, 0, 'uTorrent Web', '2018-03-05', '2019-04-10', '1.0', NULL, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_finish_date` date NOT NULL,
  `real_finish_date` date DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `project_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `plan_finish_date`, `real_finish_date`, `name`, `description`, `project_id`) VALUES
(1, '2021-01-15', NULL, 'Верстка', NULL, 1),
(2, '2018-10-19', '2019-01-24', 'Верстка', NULL, 2),
(3, '2016-01-01', '2016-01-01', 'Верстка', NULL, 6),
(4, '2016-01-30', '2016-01-29', 'Интерфейс', NULL, 3),
(5, '2020-05-20', '2020-05-19', 'Верстка', NULL, 7),
(6, '2020-01-01', '2020-01-01', 'Интерфейс', NULL, 8),
(7, '2018-01-01', '2018-01-03', 'Интерфейс', NULL, 10);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `acts_of_completion`
--
ALTER TABLE `acts_of_completion`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_category1_idx` (`parent_id`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `external_financing`
--
ALTER TABLE `external_financing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_external_financing_project_idx` (`project_id`),
  ADD KEY `fk_external_financing_investor1_idx` (`investor_id`);

--
-- Индексы таблицы `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_acts_of_completion1_idx` (`acts_of_completion_id`),
  ADD KEY `fk_orders_customers1_idx` (`customers_id`);

--
-- Индексы таблицы `parts_of_tasks`
--
ALTER TABLE `parts_of_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parts_of_tasks_tasks1_idx` (`tasks_id`),
  ADD KEY `fk_parts_of_tasks_programmers1_idx` (`programmers_id`);

--
-- Индексы таблицы `programmers`
--
ALTER TABLE `programmers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_projects_orders1_idx` (`orders_id`),
  ADD KEY `fk_projects_categories1_idx` (`categories_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_projects_id` (`project_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `acts_of_completion`
--
ALTER TABLE `acts_of_completion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `external_financing`
--
ALTER TABLE `external_financing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `investors`
--
ALTER TABLE `investors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `parts_of_tasks`
--
ALTER TABLE `parts_of_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `programmers`
--
ALTER TABLE `programmers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_category_category1_idx` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `external_financing`
--
ALTER TABLE `external_financing`
  ADD CONSTRAINT `fk_external_financing_investor` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_external_financing_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_acts_of_completion1` FOREIGN KEY (`acts_of_completion_id`) REFERENCES `acts_of_completion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_customers1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `parts_of_tasks`
--
ALTER TABLE `parts_of_tasks`
  ADD CONSTRAINT `fk_parts_of_tasks_programmers1` FOREIGN KEY (`programmers_id`) REFERENCES `programmers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parts_of_tasks_tasks1` FOREIGN KEY (`tasks_id`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_projects_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_projects_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_id_projects_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
