-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 19, 2024 at 07:41 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anime`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `adminname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `adminname`, `password`, `created_at`) VALUES
(1, 'hanzla123@gmail.com', 'Hanz_FA', 'hanzla123@gmail.com', '2024-06-17 11:34:47'),
(2, 'hanzfa123@gmail.com', 'hanzfa123@gmail.com', 'hanzfa123@gmail.com', '2024-06-18 13:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` varchar(100) NOT NULL,
  `show_id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

DROP TABLE IF EXISTS `episodes`;
CREATE TABLE IF NOT EXISTS `episodes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `video` varchar(100) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `show_id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`id`, `video`, `thumbnail`, `show_id`, `name`, `created_at`) VALUES
(7, '1.mp4', '1.jpg', 1, 'Anime Song', '2024-06-19 17:52:15'),
(8, 'MVC Crud.mp4', 'Blue Modern Team LinkedIn Post.jpg', 2, 'Wordpress', '2024-06-19 19:13:17'),
(9, 'video1427254765.mp4', 'White and Blue Geometric Graphic Design Agency Facebook Post.png', 1, 'Wordpress', '2024-06-19 19:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `followings`
--

DROP TABLE IF EXISTS `followings`;
CREATE TABLE IF NOT EXISTS `followings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `show_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `followings`
--

INSERT INTO `followings` (`id`, `show_id`, `user_id`, `created_at`) VALUES
(1, 2, 1, '2024-06-11 23:03:26'),
(2, 2, 1, '2024-06-12 09:35:45'),
(3, 1, 2, '2024-06-12 09:36:18'),
(4, 1, 2, '2024-06-12 09:36:24'),
(5, 1, 1, '2024-06-12 09:37:21'),
(6, 1, 1, '2024-06-12 09:37:48'),
(7, 1, 1, '2024-06-12 09:38:04'),
(8, 1, 2, '2024-06-12 09:38:14'),
(9, 1, 1, '2024-06-12 09:39:49'),
(10, 1, 2, '2024-06-12 22:20:56'),
(11, 1, 1, '2024-06-13 12:58:15'),
(12, 1, 1, '2024-06-13 13:14:19'),
(13, 1, 1, '2024-06-13 14:04:43'),
(14, 1, 8, '2024-06-16 12:12:59'),
(15, 2, 8, '2024-06-16 12:27:08'),
(16, 1, 8, '2024-06-19 18:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`, `created_at`) VALUES
(1, 'Action', '2024-06-02 17:23:55'),
(2, 'Adventure', '2024-06-02 17:23:55'),
(3, 'Magic', '2024-06-02 17:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

DROP TABLE IF EXISTS `shows`;
CREATE TABLE IF NOT EXISTS `shows` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `studios` varchar(100) NOT NULL,
  `date_aired` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `quality` varchar(100) NOT NULL,
  `number_available` int NOT NULL,
  `num_total` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`id`, `title`, `image`, `description`, `type`, `studios`, `date_aired`, `status`, `genre`, `duration`, `quality`, `number_available`, `num_total`, `created_at`) VALUES
(1, 'Fate Stay Night: Unlimited Blade', 'tv-1.jpg', 'Every human inhabiting the world of Alcia is branded by a “Count” or a number written on their body. For Hina’s mother, her total drops to 0 and she’s pulled into the Abyss, never to be seen again. But her mother’s last words send Hina on a quest to find a legendary hero from the Waste War - the fabled Ace!', 'TV Series', 'Lerche', 'Oct 02, 2019 to ?', 'Airing', 'Action', '24 min/ep', 'HD', 12, 99, '2024-05-28 22:36:34'),
(2, 'Gintama Movie 2: Kanketsu-hen - Yorozuya yo Eien', 'tv-2.jpg', 'Every human inhabiting the world of Alcia is branded by a “Count” or a number written on their body. For Hina’s mother, her total drops to 0 and she’s pulled into the Abyss, never to be seen again. But her mother’s last words send Hina on a quest to find a legendary hero from the Waste War - the fabled Ace!', 'TV Series', 'Lerche', 'Oct 02, 2019 to ?', 'Airing', 'Adventure', '28 min/ep', 'HD', 20, 101, '2024-05-28 22:36:34'),
(11, 'Tha sath mera ek safar waala', '1.png', 'Ipsum is a standard dummy text used in printing and web designIpsum is a standard dummy text used in printing and web design', 'Tv Series', 'Oct 02, 2019 to ?', 'Learn about its origin, ', 'nothing', 'Action', '20 mint', 'hd', 21, 17, '2024-06-19 19:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `created_at`) VALUES
(8, 'hanzla123@gmail.com', 'Hanz_FA', 'hanzla123@gmail.com', '2024-05-28 13:50:22'),
(9, 'hanzfa123@gmail.com', 'Hanz', 'hanzfa123@gmail.com', '2024-06-13 13:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

DROP TABLE IF EXISTS `views`;
CREATE TABLE IF NOT EXISTS `views` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `show_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `user_id`, `show_id`, `created_at`) VALUES
(7, 1, 2, '2024-06-13 13:55:55'),
(8, 1, 1, '2024-06-13 13:55:55'),
(9, 9, 1, '2024-06-13 14:02:54'),
(10, 8, 1, '2024-06-13 14:04:11'),
(11, 8, 2, '2024-06-13 14:04:28');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
