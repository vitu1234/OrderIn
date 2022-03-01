-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 13, 2020 at 08:26 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orderin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL COMMENT 'to be used for admins city identification',
  `access_level` int(11) NOT NULL COMMENT 'level of the admin, 1 = just admin, 2 =super admin',
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_status` int(11) NOT NULL COMMENT '0 = inactive, 1 = active',
  `img_url` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `city_id`, `access_level`, `fname`, `lname`, `email`, `phone`, `password`, `account_status`, `img_url`, `date_created`) VALUES
(1, 2, 2, 'Vitumvhfgcydhc', 'Mafeni', 'mafeniblessed@gmail.com', 882992942, '$2y$10$y3aHYPbtxkFVt4LPLXDlCeX5bjdF6QDCoeOgoDjKeJw9ynYx8dtf2', 1, '814399.jpg', '2020-08-26 12:58:27'),
(6, 2, 1, 'vitu mafeni', 'Mafeni', 'dicksonmwase@gmail.com', 882992922, '$2y$10$0zYTyCZCIh1ik16WF1.9yOg9G4AWzFAE2YE5HlAMBdODCULjtaPWO', 1, '', '2020-08-27 23:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `date_created`) VALUES
(1, 'Zomba', '2020-09-04 10:43:37'),
(2, 'Blantyre', '2020-09-04 10:43:37'),
(3, 'Lilongwe', '2020-09-04 10:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `customer_location`
--

DROP TABLE IF EXISTS `customer_location`;
CREATE TABLE IF NOT EXISTS `customer_location` (
  `customer_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `placeID` text NOT NULL,
  `exact_location` text NOT NULL,
  `longtude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_order_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_location`
--

INSERT INTO `customer_location` (`customer_order_id`, `order_id`, `placeID`, `exact_location`, `longtude`, `latitude`, `date_created`) VALUES
(1, 1, 'ChIJaac-Lr_QIRkR0AIVBYg6qLE', 'Unnamed Road, Chitedze, Malawi', '33.6382598', '-13.980328700000001', '2020-09-08 17:59:44'),
(2, 2, 'ChIJS_hqac6XHxkRZHSa1Q2sMRE', 'Dowa, Malawi', '34', '-13.5', '2020-09-08 18:05:19'),
(3, 3, 'ChIJ7ZxslWrTIRkRXPBE_9kPp_o', 'Kalumbu Road, Lilongwe, Malawi', '33.7741195', '-13.9626121', '2020-09-08 18:05:19'),
(4, 4, 'ChIJRcQFJBPTIRkRTTuRyeCAVmM', 'Maula, Lilongwe, Malawi', '33.7567186', '-13.973782', '2020-09-08 18:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `email`, `token`, `date_created`) VALUES
(9, 'gracemafeni@yahoo.com', 'd85PWeW5RIa6pPaQGGRI8n:APA91bGQJZdXuVxefhuZHOYkuZIgOt4vDPL4HoT956lDGdGE_4ol2THy4eS0qOFv4M2vx5nzD2bd0vi7CgkQQB84qdtCPtVZYNWAkTOk7zlak-NpxT_TrhvIt3SDPQUfr5APlDvnLIrZ', '2020-09-13 20:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `driver_availability`
--

DROP TABLE IF EXISTS `driver_availability`;
CREATE TABLE IF NOT EXISTS `driver_availability` (
  `availability_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'id for the driver',
  `availability_status` int(11) NOT NULL COMMENT '0  = offline, 1 = online',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`availability_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `driver_availability`
--

INSERT INTO `driver_availability` (`availability_id`, `user_id`, `availability_status`, `date_created`) VALUES
(1, 11, 1, '2020-09-08 22:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `driver_location`
--

DROP TABLE IF EXISTS `driver_location`;
CREATE TABLE IF NOT EXISTS `driver_location` (
  `driver_current_location_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `placeID` text NOT NULL,
  `exact_location` text NOT NULL,
  `longtude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`driver_current_location_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'customer who ordered',
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL COMMENT '0 = not paid, 1 = paid',
  `order_delivery_status` int(11) NOT NULL COMMENT '0 = incomplete, 1 = complete',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `quantity`, `payment_status`, `order_delivery_status`, `date_created`) VALUES
(1, 12, 1, 1, 1, 0, '2020-09-05 23:00:46'),
(2, 13, 2, 1, 1, 0, '2020-09-05 23:00:46'),
(3, 14, 3, 2, 1, 0, '2020-09-05 23:00:46'),
(4, 12, 3, 2, 1, 0, '2020-09-05 23:00:46'),
(5, 14, 1, 1, 1, 0, '2020-09-13 20:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_assign`
--

DROP TABLE IF EXISTS `order_assign`;
CREATE TABLE IF NOT EXISTS `order_assign` (
  `assign_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT 'the order',
  `user_id` int(11) NOT NULL COMMENT 'driver assigned',
  `assigner` int(11) NOT NULL COMMENT 'person assigning the order to driver',
  `email_status` int(11) NOT NULL COMMENT '0=not notified, 1 = notified',
  `sms_status` int(11) NOT NULL COMMENT '0=not notified, 1 = notified',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`assign_id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `assigner` (`assigner`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_assign`
--

INSERT INTO `order_assign` (`assign_id`, `order_id`, `user_id`, `assigner`, `email_status`, `sms_status`, `date_created`) VALUES
(4, 3, 11, 10, 1, 1, '2020-09-13 20:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` double NOT NULL,
  `availability` int(11) NOT NULL COMMENT '1 = available, 2 = not available',
  `delivery_fee` double NOT NULL,
  `prep_mins` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `restaurant_id`, `product_name`, `product_price`, `availability`, `delivery_fee`, `prep_mins`, `img_url`, `date_created`) VALUES
(1, 5, 'Beef Burger ', 5000, 1, 1000, '10', '135395.jpg', '2020-09-05 23:00:22'),
(2, 4, 'Pizza x Salad', 8000, 1, 1000, '10', '135395.jpg', '2020-09-05 23:00:22'),
(3, 5, 'Mashroom Burger', 13000, 1, 1000, '10', '135395.jpg', '2020-09-05 23:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_info`
--

DROP TABLE IF EXISTS `restaurant_info`;
CREATE TABLE IF NOT EXISTS `restaurant_info` (
  `restaurant_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `restaurant_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `restaurant_phone` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `restaurant_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `placeID` text NOT NULL,
  `exact_location` text NOT NULL,
  `longtude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`restaurant_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restaurant_info`
--

INSERT INTO `restaurant_info` (`restaurant_id`, `city_id`, `restaurant_name`, `restaurant_phone`, `restaurant_address`, `placeID`, `exact_location`, `longtude`, `latitude`, `img_url`, `date_created`) VALUES
(4, 3, 'KFC Lilongwe', '996670686', 'LIlongwe City Mall', 'ChIJRfVSTtjSIRkRtCHGtoy8pRI', 'Unnamed Road, Lilongwe, Malawi', '33.7832', '-13.9833', '793839.jpg', '2020-09-04 12:32:36'),
(5, 3, 'KIPS Lilongwe', '882612076', 'Area 3 Kips, Box 2020', 'ChIJRfVSTtjSIRkRtCHGtoy8pRI', 'Unnamed Road, Lilongwe, Malawi', '33.7832', '-13.9866009', '228521.jpg', '2020-09-04 12:35:01'),
(6, 1, 'Amazing Bakes', '882612076', 'Zomba, box 23432', 'ChIJRfVSTtjSIRkRtCHGtoy8pRI', 'Unnamed Road, Lilongwe, Malawi', '35.3192296', '-15.3880008', '228521.jpg', '2020-09-04 12:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_managers`
--

DROP TABLE IF EXISTS `restaurant_managers`;
CREATE TABLE IF NOT EXISTS `restaurant_managers` (
  `manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`manager_id`),
  KEY `user_id` (`user_id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restaurant_managers`
--

INSERT INTO `restaurant_managers` (`manager_id`, `user_id`, `restaurant_id`, `date_created`) VALUES
(2, 10, 5, '2020-09-04 12:41:07'),
(3, 16, 6, '2020-09-13 22:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_status` int(11) NOT NULL COMMENT '0 = inactive, 1 = active',
  `user_role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'customer, manager, driver',
  `img_url` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `users_ibfk_1` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `city_id`, `fname`, `lname`, `email`, `phone`, `password`, `account_status`, `user_role`, `img_url`, `date_created`) VALUES
(6, 2, 'Vitu', 'Kacheche', 'soko@gmail.com', 996670666, '$2y$10$y3aHYPbtxkFVt4LPLXDlCeX5bjdF6QDCoeOgoDjKeJw9ynYx8dtf2', 1, 'driver', '', '2020-08-27 23:51:59'),
(10, 3, 'Vt', 'Mafeni', 'vitumafeni@yahoo.com', 882992942, '$2y$10$y3aHYPbtxkFVt4LPLXDlCeX5bjdF6QDCoeOgoDjKeJw9ynYx8dtf2', 1, 'manager', '706900.jpg', '2020-09-04 12:41:05'),
(11, 3, 'Grace', 'Mafeni', 'gracemafeni@yahoo.com', 882992942, '$2y$10$jdyTDccqVhZzs1IGnBIFbekTaPI52HRljgRu09tQ4thYEuIkRkjRy', 1, 'driver', '706900.jpg', '2020-09-04 12:41:05'),
(12, 3, 'Ntahan', 'mnthali', 'nathan@yahoo.com', 882992942, '$2y$10$y3aHYPbtxkFVt4LPLXDlCeX5bjdF6QDCoeOgoDjKeJw9ynYx8dtf2', 1, 'customer', '706900.jpg', '2020-09-04 12:41:05'),
(13, 3, 'Bridget', 'Uledi', 'bridget@yahoo.com', 888242625, '$2y$10$y3aHYPbtxkFVt4LPLXDlCeX5bjdF6QDCoeOgoDjKeJw9ynYx8dtf2', 1, 'customer', '706900.jpg', '2020-09-04 12:41:05'),
(14, 3, 'Frank', 'Matemba', 'frank@gmail.com', 888242556, '$2y$10$y3aHYPbtxkFVt4LPLXDlCeX5bjdF6QDCoeOgoDjKeJw9ynYx8dtf2', 1, 'customer', '706900.jpg', '2020-09-04 12:41:05'),
(15, 3, 'Gift', 'Banda', 'gift@gmail.com', 886670484, '$2y$10$jdyTDccqVhZzs1IGnBIFbekTaPI52HRljgRu09tQ4thYEuIkRkjRy', 1, 'driver', '706900.jpg', '2020-09-04 12:41:05'),
(16, 1, 'Atusaye', 'Mafeni', 'atusaye@gmail.com', 2147483647, '$2y$10$XzEQ7Db8/jP3OP/JJLcrFujjOCHWu21RK15BXH4HaXgqJfOi5Mq3m', 1, 'manager', '', '2020-09-13 22:16:24');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_location`
--
ALTER TABLE `customer_location`
  ADD CONSTRAINT `customer_location_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver_availability`
--
ALTER TABLE `driver_availability`
  ADD CONSTRAINT `driver_availability_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver_location`
--
ALTER TABLE `driver_location`
  ADD CONSTRAINT `driver_location_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_assign`
--
ALTER TABLE `order_assign`
  ADD CONSTRAINT `order_assign_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_assign_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_assign_ibfk_3` FOREIGN KEY (`assigner`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant_info` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurant_info`
--
ALTER TABLE `restaurant_info`
  ADD CONSTRAINT `restaurant_info_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restaurant_managers`
--
ALTER TABLE `restaurant_managers`
  ADD CONSTRAINT `restaurant_managers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restaurant_managers_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant_info` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
