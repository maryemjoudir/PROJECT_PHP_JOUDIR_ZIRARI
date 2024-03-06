-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour php_project
CREATE DATABASE IF NOT EXISTS `php_project` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `php_project`;

-- Listage de la structure de table php_project. admins
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL DEFAULT '0',
  `admin_email` varchar(50) NOT NULL DEFAULT '0',
  `admin_password` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table php_project.admins : ~3 rows (environ)
INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
	(1, 'admin', 'admin@gmail.com', 'Md5(\'12341234\')'),
	(2, 'admin', 'admin@gmail.com', 'ed2b1f468c5f915f3f1cf75d7068baae'),
	(3, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- Listage de la structure de table php_project. orders
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int NOT NULL,
  `user_phone` int NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Listage des données de la table php_project.orders : ~10 rows (environ)
INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
	(1, 745.00, 'paid', 1, 645343445, 'tdfg', 'rsfwtdttd', '2023-01-23 17:23:00'),
	(2, 745.00, 'paid', 1, 645343445, 'tdfg', 'rsfwtdttd', '2023-01-23 17:23:32'),
	(3, 905.00, 'delivered', 1, 645343445, 'sdfgch', 'sdxfcgjvhkjl', '2023-01-23 17:56:35'),
	(4, 1060.00, 'paid', 1, 645343445, 'tdfg', 'sdxfcgjvhkjl', '2023-01-24 12:40:08'),
	(5, 155.00, 'not paid', 1, 645343445, 'tdfg', 'sdxfcgjvhkjl', '2023-01-24 15:24:32'),
	(7, 620.00, 'paid', 1, 645343445, 'ZQDEFSRTG', 'qsdsfg', '2023-01-24 17:44:08'),
	(8, 465.00, 'not paid', 1, 645343445, 'QSDFG', 'rsfwtdttd', '2023-01-25 07:29:26'),
	(9, 155.00, 'not paid', 1, 645343445, 'tdfg', 'rsfwtdttd', '2023-01-25 15:30:50'),
	(10, 310.00, 'paid', 1, 645343445, 'ZQDEFSRTG', 'hhhjjjlljhlhlhh', '2023-01-26 11:05:03'),
	(11, 310.00, 'paid', 3, 645343445, 'ZQDEFSRTG', '455567', '2023-01-26 11:17:19'),
	(12, 850.00, 'not paid', 3, 645343445, 'sdfgch', 'qsdfghj', '2023-01-26 11:30:13'),
	(13, 620.00, 'not paid', 3, 645343445, 'sdfgch', 'qsdsfg', '2023-01-26 11:43:59'),
	(14, 465.00, 'paid', 3, 645343445, 'tdfg', '455567', '2023-01-26 12:34:09'),
	(15, 155.00, 'not paid', 3, 645343445, 'sdfgch', 'qsdsfg', '2023-01-26 12:38:30'),
	(16, 310.00, 'not paid', 7, 645343445, 'ZQDEFSRTG', 'hhhjjjlljhlhlhh', '2023-01-26 18:54:09');

-- Listage de la structure de table php_project. order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `product_quantity` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Listage des données de la table php_project.order_items : ~13 rows (environ)
INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
	(1, 1, '3', 'Move Bag', 'featured3.jpg', 250.00, 3, 1, '2023-01-23 17:23:00'),
	(2, 2, '1', 'White Shoes', 'featured1.jpg', 155.00, 1, 1, '2023-01-23 17:23:32'),
	(3, 3, '3', 'Move Bag', 'featured3.jpg', 250.00, 3, 1, '2023-01-23 17:56:35'),
	(4, 4, '3', 'Move Bag', 'featured3.jpg', 250.00, 3, 1, '2023-01-24 12:40:08'),
	(5, 4, '1', 'White Shoes', 'featured1.jpg', 155.00, 1, 1, '2023-01-24 12:40:08'),
	(6, 4, '2', 'Blue Bag', 'featured2.jpg', 155.00, 1, 1, '2023-01-24 12:40:08'),
	(7, 5, '2', 'Blue Bag', 'featured2.jpg', 155.00, 1, 1, '2023-01-24 15:24:32'),
	(8, 6, '1', 'White Shoes', 'featured1.jpg', 155.00, 1, 1, '2023-01-24 17:07:51'),
	(9, 7, '1', 'White Shoes', 'featured1.jpg', 155.00, 4, 1, '2023-01-24 17:44:08'),
	(10, 8, '1', 'White Shoes', 'featured1.jpg', 155.00, 2, 1, '2023-01-25 07:29:26'),
	(11, 8, '2', 'Blue Bag', 'featured2.jpg', 155.00, 1, 1, '2023-01-25 07:29:26'),
	(12, 9, '1', 'White Shoes', 'featured1.jpg', 155.00, 1, 1, '2023-01-25 15:30:50'),
	(13, 10, '1', 'White Shoes', 'featured1.jpg', 155.00, 2, 1, '2023-01-26 11:05:03'),
	(14, 11, '1', 'White Shoes', 'featured1.jpg', 155.00, 2, 3, '2023-01-26 11:17:19'),
	(15, 12, '6', 'Red Dress', 'clothes2.jpg', 250.00, 1, 3, '2023-01-26 11:30:13'),
	(16, 12, '5', 'Red Coat', 'clothes1.jpg', 200.00, 3, 3, '2023-01-26 11:30:13'),
	(17, 13, '1', 'White Shoes', 'featured1.jpg', 155.00, 4, 3, '2023-01-26 11:43:59'),
	(18, 14, '1', 'White Shoes', 'featured1.jpg', 155.00, 3, 3, '2023-01-26 12:34:09'),
	(19, 15, '2', 'Blue Bag', 'featured2.jpg', 155.00, 1, 3, '2023-01-26 12:38:30'),
	(20, 16, '2', 'Blue Bag', 'featured2.jpg', 155.00, 2, 7, '2023-01-26 18:54:09');

-- Listage de la structure de table php_project. payments
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `transaction_id` varchar(250) NOT NULL,
  `payment_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table php_project.payments : ~3 rows (environ)
INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `transaction_id`, `payment_date`) VALUES
	(1, 1, 1, '5', NULL),
	(2, 4, 1, '0', NULL),
	(3, 2, 1, '1CG48625CV8692445', '2023-01-24 21:38:42'),
	(4, 10, 1, '3AK018208R620535C', '2023-01-26 11:05:33'),
	(5, 11, 3, '2EP10086R49548309', '2023-01-26 11:17:47'),
	(6, 14, 3, '25R27959EE113803W', '2023-01-26 12:34:27');

-- Listage de la structure de table php_project. products
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int NOT NULL,
  `product_color` varchar(100) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Listage des données de la table php_project.products : ~22 rows (environ)
INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
	(1, 'White Shoes', 'shoe', 'awesome white shoes', 'featured1.jpg', 'featured1.jpg', 'featured1.jpg', 'featured1.jpg', 155.00, 0, 'white'),
	(2, 'Blue Bag', 'bags', 'awesome Blue bag', 'featured2.jpg', 'featured2.jpg', 'featured2.jpg', 'featured2.jpg', 155.00, 0, 'Blue'),
	(3, 'Move Bag', 'bags', 'awesome move bag', 'featured3.jpg', 'featured3.jpg', 'featured3.jpg', 'featured3.jpg', 250.00, 0, 'Move'),
	(4, 'Pink Bag', 'bags', 'awesome pink bag', 'featured4.jpg', 'featured4.jpg', 'featured4.jpg', 'featured4.jpg', 149.00, 0, 'Pink'),
	(5, 'Red Coat', 'coats', 'awesome red coat\r\n', 'clothes1.jpg', 'clothes1.jpg', 'clothes1.jpg', 'clothes1.jpg', 200.00, 0, 'red'),
	(6, 'Red Dress', 'coats', 'awesome red dress', 'clothes2.jpg', 'clothes2.jpg', 'clothes2.jpg', 'clothes2.jpg', 250.00, 0, 'red'),
	(7, 'Green Coat', 'coats', 'awesome green coat', 'clothes3.jpg', 'clothes3.jpg', 'clothes3.jpg', 'clothes3.jpg', 255.00, 0, 'green'),
	(8, 'Gray Coat', 'coats', 'awesome gray coat', 'clothes4.jpg', 'clothes4.jpg', 'clothes4.jpg', 'clothes4.jpg', 230.00, 0, 'gray'),
	(9, 'Black Watch', 'watches', 'awesome black watch', 'watch1.jpg', 'watch1.jpg', 'watch1.jpg', 'watch1.jpg', 300.00, 0, 'black'),
	(10, 'Pink watch', 'watches', 'awesome Pink watch', 'watch2.jpg', 'watch2.jpg', 'watch2.jpg', 'watch2.jpg', 355.00, 0, 'pink'),
	(11, 'Black Watch', 'watches', 'awesome black watch', 'watch3.webp', 'watch3.webp', 'watch3.webp', 'watch3.webp', 350.00, 0, 'Black'),
	(12, 'Pink Watch', 'watches', 'awesome pink watch', 'watch4.jpg', 'watch4.jpg', 'watch4.jpg', 'watch4.jpg', 249.00, 0, 'Pink'),
	(13, 'White Shoes', 'shoes', 'awesome white shoes', 'shoes1.jpg', 'shoes1.jpg', 'shoes1.jpg', 'shoes1.jpg', 200.00, 0, 'white'),
	(14, 'Black Shoes', 'shoes', 'awesome black shoes', 'shoes2.jpg', 'shoes2.jpg', 'shoes2.jpg', 'shoes2.jpg', 250.00, 0, 'black'),
	(15, 'Gray Shoes', 'shoes', 'awesome gray shoes', 'shoes3.jpg', 'shoes3.jpg', 'shoes3.jpg', 'shoes3.jpg', 255.00, 0, 'gray'),
	(16, 'Black Shoes', 'shoes', 'awesome black shoes', 'shoes4.webp', 'shoes4.webp', 'shoes4.webp', 'shoes4.webp', 230.00, 0, 'black'),
	(17, 'White Shoes', 'shoes', 'awesome white shoes', 'shoes9.jpg', 'shoes9.jpg', 'shoes9.jpg', 'shoes9.jpg', 155.00, 0, 'white'),
	(18, 'Black Shoes', 'shoes', 'awesome black shoes', 'shoes6.jpg', 'shoes6.jpg', 'shoes6.jpg', 'shoes6.jpg', 155.00, 0, 'Black'),
	(19, 'Yellow Shoes ', 'shoes', 'awesome yellow shoes', 'shoes7.jpg', 'shoes7.jpg', 'shoes7.jpg', 'shoes7.jpg', 150.00, 0, 'yellow'),
	(20, 'White Shoes', 'shoes', 'awesome white shoes', 'shoes8.jpg', 'shoes8.jpg', 'shoes8.jpg', 'shoes8.jpg', 149.00, 0, 'white'),
	(21, 'White Shoes', 'shoes', 'awesome white shoes', 'shoes10.jpg', 'shoes10.jpg', 'shoes10.jpg', 'shoes10.jpg', 155.00, 0, 'white'),
	(22, 'Yellow Shoes', 'shoes', 'awesome yellow shoes', 'shoes11.jpg', 'shoes11.jpg', 'shoes11.jpg', 'shoes11.jpg', 155.00, 0, 'yellow');

-- Listage de la structure de table php_project. users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `verification_code` text,
  `email_verified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UX_Constraint` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table php_project.users : ~0 rows (environ)
INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `verification_code`, `email_verified_at`) VALUES
	(7, 'loubna', 'loubnazirari02@gmail.com', '11befe1b03f596c805ed03864def873d', '128204', '2023-01-26 18:53:21');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
