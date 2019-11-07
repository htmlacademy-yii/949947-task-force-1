CREATE DATABASE taskforce;

USE taskforce;
-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `name` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `message` text NOT NULL,
  `senderId` int(11) NOT NULL,
  `recipientId` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `text` text NOT NULL,
  `userId` int(11) NOT NULL,
  `taskId` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `userId` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `messagerName` int(11) NOT NULL,
  `messageContacts` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications_users`
--

CREATE TABLE `notifications_users` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `userId` int(11) NOT NULL,
  `messages` text NOT NULL,
  `taskActionId` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `photoworks`
--

CREATE TABLE `photo_works` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `urlPhoto` varchar(255) NOT NULL,
  `usersId` int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `name` varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `categoryId` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `budget` int(11) NOT NULL,
  `dateFinish` date NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `shortDescription` varchar(255) NOT NULL
);


--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `biography` text NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  `location` varchar(255) NOT NULL
);


--
-- Индексы таблицы `users`
--

ALTER TABLE `users` ADD UNIQUE KEY `email_index` (`email`);


