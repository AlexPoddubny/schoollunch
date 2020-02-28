-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 27 2020 г., 00:14
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `schoollunch`
--

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`) VALUES
(1, 'Child_Select', 'Обрати дитину'),
(2, 'View_Menu', 'Перегляд меню'),
(3, 'Evaluate_Menu', 'Оцінити меню'),
(4, 'Comment_Menu', 'Коментувати меню'),
(5, 'Fill_Class', 'Заповнити клас'),
(6, 'Parent_Confirm', 'Підтвердити батьків'),
(7, 'Publish_Photo', 'Опублікувати світлину обіду'),
(8, 'Course_Create', 'Створити страву'),
(9, 'Menu_Create', 'Створити меню'),
(10, 'Classes_List_Create', 'Створити перелік класів'),
(11, 'Class_Teacher_Assign', 'Призначити класного керівника'),
(12, 'User_Register', 'Зареєструвати користувача'),
(13, 'User_Edit', 'Редагувати користувача'),
(14, 'School_Register', 'Зареєструвати школу'),
(15, 'School_Admin_Assign', 'Призначити адміністратора школи'),
(16, 'Cook_Assign', 'Призначити технолога шкільного комбінату харчування'),
(17, 'View_Admin', 'Доступ до адміністрування системи'),
(18, 'View_School_Admin', 'Доступ до адміністрування школи'),
(19, 'View_Class', 'Доступ до адміністрування класу'),
(20, 'View_Cook', 'Доступ до адміністрування шкільного комбінату харчування');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
