CREATE DATABASE task_force;

USE task_force;
-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name`  varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `message` text NOT NULL,
  `sender_id` INT NOT NULL,
  `recipient_id` INT NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `text` text NOT NULL,
  `user_id` INT NOT NULL,
  `task_id` INT NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `messager_name` varchar(255) NOT NULL,
  `message_contacts` varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications_users`
--

CREATE TABLE `notifications_users` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `messages` text NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `photoworks`
--

CREATE TABLE `photo_works` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `task_id` INT NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `category_id` INT NOT NULL,
  `latitude` varchar(255),
  `longitude` varchar(255),
  `budget` INT,
  `date_finish` date,
  `short_description` varchar(255) NOT NULL,
  `executor_id` INT,
  `customer_id` INT NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `remarks`
--
CREATE TABLE `remarks` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `task_id` INT NOT NULL,
  `remarks` varchar(255) NOT NULL
);


--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` INT,
  `biography` text,
  `avatar` varchar(255) ,
  `latitude` varchar(255),
  `longitude` varchar(255)
);

--
-- Структура таблицы `last_action_time`
--

CREATE TABLE `last_action_time` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `task_id` INT NOT NULL,
  `last_action_time` DATETIME NOT NULL

);

-- --------------------------------------------------------


--
-- Индексы таблицы `users`
--

ALTER TABLE `users` ADD UNIQUE KEY `email_index` (`email`);

--
-- Индексы таблицы `contacts`
--

ALTER TABLE `contacts` ADD UNIQUE KEY `user_id` (`user_id`);


