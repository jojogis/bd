-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 20 2020 г., 19:23
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

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `acts_of_completion_id` int(10) UNSIGNED NOT NULL,
  `scan` varchar(45) DEFAULT NULL,
  `customers_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `parts_of_tasks`
--

CREATE TABLE `parts_of_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `tasks_id` int(10) UNSIGNED NOT NULL,
  `programmers_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_by_order` tinyint(4) NOT NULL,
  `name` varchar(45) NOT NULL,
  `planned_release_date` date NOT NULL,
  `real_release_date` date DEFAULT NULL,
  `version` varchar(20) NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `orders_id` int(10) UNSIGNED NOT NULL,
  `categories_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `real_date_of_complete` date DEFAULT NULL,
  `plan_date_of_complete` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_finish_date` date NOT NULL,
  `real_finish_date` date DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD KEY `fk_project_task1_idx` (`task_id`),
  ADD KEY `fk_projects_orders1_idx` (`orders_id`),
  ADD KEY `fk_projects_categories1_idx` (`categories_id`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `acts_of_completion`
--
ALTER TABLE `acts_of_completion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `external_financing`
--
ALTER TABLE `external_financing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `investors`
--
ALTER TABLE `investors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `parts_of_tasks`
--
ALTER TABLE `parts_of_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `programmers`
--
ALTER TABLE `programmers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `fk_project_task1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_projects_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_projects_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
