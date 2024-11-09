-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for rapsol
CREATE DATABASE IF NOT EXISTS `rapsol` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `rapsol`;

-- Dumping structure for table rapsol.bill
CREATE TABLE IF NOT EXISTS `bill` (
  `Bill_No` int DEFAULT NULL,
  `Customer_id` int DEFAULT NULL,
  `Bill_Amount` decimal(10,2) DEFAULT NULL,
  `Customer_Paid` decimal(10,2) DEFAULT NULL,
  `Bill_Balance` decimal(10,2) DEFAULT NULL,
  `Date and time` datetime DEFAULT NULL,
  `Lorry_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.bill: ~117 rows (approximately)
INSERT INTO `bill` (`Bill_No`, `Customer_id`, `Bill_Amount`, `Customer_Paid`, `Bill_Balance`, `Date and time`, `Lorry_id`) VALUES
	(NULL, NULL, 1900.00, 2000.00, -100.00, NULL, NULL),
	(1, 1, 0.00, 1100.00, -1100.00, NULL, NULL),
	(2, 1, 0.00, 4000.00, -4000.00, NULL, NULL),
	(3, 1, 0.00, 1200.00, -1200.00, '2024-09-02 21:36:28', NULL),
	(4, 1, 0.00, 1000.00, -1000.00, '2024-09-02 16:27:36', NULL),
	(5, 1, 0.00, 2600.00, -2600.00, '2024-09-02 16:37:34', NULL),
	(6, 1, 0.00, 2500.00, -2500.00, '2024-09-02 16:52:16', NULL),
	(7, 1, 0.00, 3000.00, -3000.00, '2024-09-02 16:54:05', NULL),
	(8, 1, 0.00, 2500.00, -2500.00, '2024-09-02 17:00:32', NULL),
	(9, 1, 0.00, 2500.00, -2500.00, '2024-09-02 17:09:10', NULL),
	(10, 1, 0.00, 7500.00, -7500.00, '2024-09-02 17:13:51', NULL),
	(11, 1, 0.00, 3500.00, -3500.00, '2024-09-02 17:18:46', NULL),
	(12, 2, 0.00, 10000.00, -10000.00, '2024-09-02 17:21:00', NULL),
	(13, 2, 9950.00, 10000.00, -50.00, '2024-09-02 17:28:46', NULL),
	(14, 2, 4250.00, 4000.00, 250.00, '2024-09-02 17:34:45', NULL),
	(15, 2, 5000.00, 4500.00, 500.00, '2024-09-02 17:35:50', NULL),
	(16, 2, 9500.00, 9000.00, 500.00, '2024-09-02 17:50:38', NULL),
	(17, 1, 7250.00, 7000.00, 250.00, '2024-09-02 18:05:01', NULL),
	(18, 1, 10000.00, 9000.00, 1000.00, '2024-09-02 18:11:31', NULL),
	(19, 1, 27500.00, 30000.00, -2500.00, '2024-09-02 18:15:00', NULL),
	(20, 2, 10000.00, 10000.00, 0.00, '2024-09-02 18:17:25', NULL),
	(21, 2, 5000.00, 5000.00, 0.00, '2024-09-02 18:24:55', NULL),
	(22, 1, 5000.00, 6000.00, -1000.00, '2024-09-02 18:34:33', NULL),
	(23, 1, 7250.00, 7500.00, -250.00, '2024-09-03 16:36:51', NULL),
	(24, 2, 15000.00, 15000.00, 0.00, '2024-09-03 16:42:46', NULL),
	(25, 2, 5000.00, 6000.00, -1000.00, '2024-09-03 16:44:30', NULL),
	(26, 1, 2750.00, 3000.00, -250.00, '2024-09-03 17:12:10', NULL),
	(27, 1, 2750.00, 3000.00, -250.00, '2024-09-03 17:14:10', NULL),
	(28, 1, 7250.00, 7500.00, -250.00, '2024-09-03 17:47:11', NULL),
	(29, 1, 500000.00, 6000000.00, -5500000.00, '2024-09-03 18:12:13', NULL),
	(30, 1, 6500.00, 6500.00, 0.00, '2024-09-04 06:17:53', NULL),
	(31, 2, 15750.00, 10000.00, 5750.00, '2024-09-04 06:19:37', NULL),
	(32, 2, 5500.00, 6000.00, -500.00, '2024-09-04 06:26:51', NULL),
	(33, 1, 2750.00, 3000.00, -250.00, '2024-09-04 06:35:19', NULL),
	(34, 2, 6500.00, 7000.00, -500.00, '2024-09-04 06:36:41', NULL),
	(35, 2, 9500.00, 9500.00, 0.00, '2024-09-04 08:10:26', NULL),
	(36, 3, 5000.00, 5000.00, 0.00, '2024-09-04 10:26:11', NULL),
	(37, 3, 5000.00, 5500.00, -500.00, '2024-09-04 10:30:10', NULL),
	(38, 3, 2500.00, 2500.00, 0.00, '2024-09-04 10:33:37', NULL),
	(39, 3, 5000.00, 5000.00, 0.00, '2024-09-04 10:49:19', NULL),
	(40, 1, 6500.00, 6500.00, 0.00, '2024-09-04 10:53:49', NULL),
	(41, 1, 2750.00, 3000.00, -250.00, '2024-09-04 10:57:36', NULL),
	(42, 2, 6500.00, 7000.00, -500.00, '2024-09-04 10:58:40', NULL),
	(43, 3, 6500.00, 6000.00, 500.00, '2024-09-04 11:03:24', NULL),
	(44, 4, 6500.00, 6000.00, 500.00, '2024-09-04 11:10:06', NULL),
	(45, 4, 5000.00, 5000.00, 0.00, '2024-09-04 11:13:52', NULL),
	(46, 4, 2750.00, 3000.00, -250.00, '2024-09-04 11:16:03', NULL),
	(47, 4, 4500.00, 5000.00, -500.00, '2024-09-04 11:20:12', NULL),
	(48, 4, 500.00, 500.00, 0.00, '2024-09-04 11:22:13', NULL),
	(49, 4, 5000.00, 5000.00, 0.00, '2024-09-04 11:29:22', NULL),
	(50, 4, 5500.00, 5500.00, 0.00, '2024-09-04 11:30:37', NULL),
	(51, 3, 6500.00, 6500.00, 0.00, '2024-09-04 11:32:50', NULL),
	(52, 3, 9000.00, 10000.00, -1000.00, '2024-09-04 11:35:52', NULL),
	(53, 3, 27500.00, 30000.00, -2500.00, '2024-09-04 12:01:07', NULL),
	(54, 4, 4500.00, 4500.00, 0.00, '2024-09-04 12:41:50', NULL),
	(55, 4, 5000.00, 5000.00, 0.00, '2024-09-04 12:53:32', NULL),
	(56, 3, 6500.00, 6500.00, 0.00, '2024-09-04 13:37:55', NULL),
	(57, 4, 4500.00, 4500.00, 0.00, '2024-09-04 13:55:01', NULL),
	(58, 4, 5000.00, 5000.00, 0.00, '2024-09-04 13:59:14', NULL),
	(59, 5, 1500.00, 1500.00, 0.00, '2024-09-04 14:09:55', NULL),
	(60, 4, 6500.00, 6500.00, 0.00, '2024-09-04 14:11:29', NULL),
	(61, 5, 1500.00, 1500.00, 0.00, '2024-09-04 14:17:01', NULL),
	(62, 4, 14500.00, 14000.00, 500.00, '2024-09-04 14:18:35', NULL),
	(63, 5, 14500.00, 15000.00, -500.00, '2024-09-04 14:25:00', NULL),
	(64, 4, 9500.00, 10000.00, -500.00, '2024-09-04 14:26:47', NULL),
	(65, 5, 25000.00, 25000.00, 0.00, '2024-09-04 14:27:50', NULL),
	(66, 5, 9500.00, 10000.00, -500.00, '2024-09-04 14:30:35', NULL),
	(67, 5, 5000.00, 4000.00, 1000.00, '2024-09-04 15:12:16', NULL),
	(68, 5, 5000.00, 5000.00, 0.00, '2024-09-04 15:24:44', NULL),
	(69, 1, 4500.00, 4000.00, 500.00, '2024-09-04 15:25:22', NULL),
	(70, 6, 850.00, 1000.00, -150.00, '2024-09-04 17:35:48', NULL),
	(71, 6, 500.00, 500.00, 0.00, '2024-09-04 18:00:03', NULL),
	(72, 6, 1000.00, 1500.00, -500.00, '2024-09-04 18:08:35', NULL),
	(73, 5, 1000.00, 1000.00, 0.00, '2024-09-04 18:17:29', NULL),
	(74, 5, 450.00, 500.00, -50.00, '2024-09-04 18:23:04', NULL),
	(75, 3, 500.00, 1000.00, -500.00, '2024-09-04 18:28:52', NULL),
	(76, 3, 1000.00, 1000.00, 0.00, '2024-09-04 18:30:54', NULL),
	(77, 3, 1000.00, 1000.00, 0.00, '2024-09-04 18:35:06', NULL),
	(78, 5, 450.00, 500.00, -50.00, '2024-09-04 18:38:34', NULL),
	(79, 4, 5000.00, 5000.00, 0.00, '2024-09-04 19:05:25', NULL),
	(80, 6, 2250.00, 2500.00, -250.00, '2024-09-05 09:58:37', NULL),
	(81, 2, 12250.00, 15000.00, -2750.00, '2024-09-05 10:49:13', NULL),
	(82, 6, 1500.00, 1500.00, 0.00, '2024-09-05 10:58:32', NULL),
	(83, 6, 4500.00, 4000.00, 500.00, '2024-09-05 11:37:42', NULL),
	(84, 2, 1800.00, 2000.00, -200.00, '2024-09-05 12:14:32', NULL),
	(85, 3, 5000.00, 5000.00, 0.00, '2024-09-05 12:24:50', NULL),
	(86, 2, 450.00, 500.00, -50.00, '2024-09-06 17:37:09', NULL),
	(87, 4, 500.00, 5000.00, -4500.00, '2024-09-06 17:42:07', NULL),
	(88, 1, 500.00, 500.00, 0.00, '2024-09-06 18:05:21', NULL),
	(89, 2, 500.00, 5000.00, -4500.00, '2024-09-06 18:07:07', NULL),
	(90, 4, 450.00, 500.00, -50.00, '2024-09-09 09:03:15', NULL),
	(91, 5, 5000.00, 6000.00, -1000.00, '2024-09-09 13:55:40', NULL),
	(92, 1, 2500.00, 3000.00, -500.00, '2024-09-09 16:30:54', NULL),
	(93, 1, 950.00, 1000.00, -50.00, '2024-09-10 21:24:21', NULL),
	(94, 1, 500.00, 1000.00, -500.00, '2024-09-10 22:27:45', NULL),
	(95, NULL, 1400.00, 1500.00, -100.00, '2024-09-13 08:47:18', NULL),
	(96, 1, 500.00, 600.00, -100.00, '2024-09-13 08:48:08', NULL),
	(97, 3, 450.00, 500.00, -50.00, '2024-09-13 08:23:18', NULL),
	(98, 2, 500.00, 1000.00, -500.00, '2024-09-13 08:32:01', NULL),
	(99, 2, 4500.00, 0.00, 4500.00, '2024-11-06 07:20:41', NULL),
	(100, 2, 1000.00, 0.00, 1000.00, '2024-11-06 07:53:53', NULL),
	(101, 4, 1150.00, 0.00, 1150.00, '2024-11-06 08:15:51', NULL),
	(102, 1, 500.00, 0.00, 500.00, '2024-11-07 10:57:05', NULL),
	(103, 6, 0.00, 0.00, 0.00, '2024-11-07 11:40:18', NULL),
	(104, 1, 4500.00, 5000.00, -500.00, '2024-11-07 11:50:08', NULL),
	(105, 1, 500.00, 1000.00, -500.00, '2024-11-07 11:56:27', NULL),
	(106, 4, 0.00, 500.00, -500.00, '2024-11-08 00:03:59', NULL),
	(107, 7, 500.00, 500.00, 0.00, '2024-11-08 00:14:16', NULL),
	(108, 4, 500.00, 500.00, 0.00, '2024-11-08 00:21:09', 1),
	(109, 4, 500.00, 500.00, 0.00, '2024-11-08 00:22:09', 1),
	(110, 8, 20000.00, 20000.00, 0.00, '2024-11-08 00:37:41', 3),
	(111, 8, 10000.00, 10000.00, 0.00, '2024-11-08 00:41:32', 3),
	(112, 8, 10000.00, 100000.00, -90000.00, '2024-11-08 00:44:23', 3),
	(113, 5, 20000.00, 2500000.00, -2480000.00, '2024-11-08 00:50:02', NULL),
	(114, 1, 2500.00, 10000.00, -7500.00, '2024-11-08 02:04:01', NULL),
	(115, 7, 850.00, 1000.00, -150.00, '2024-11-08 09:19:03', NULL),
	(116, 5, 650.00, 1000.00, -350.00, '2024-11-08 09:23:13', NULL);

-- Dumping structure for table rapsol.bill_details
CREATE TABLE IF NOT EXISTS `bill_details` (
  `Bill_No` int DEFAULT NULL,
  `Product_name` varchar(50) DEFAULT NULL,
  `Product_price` decimal(10,2) DEFAULT NULL,
  `Quantity` int DEFAULT NULL,
  `Total_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.bill_details: ~154 rows (approximately)
INSERT INTO `bill_details` (`Bill_No`, `Product_name`, `Product_price`, `Quantity`, `Total_amount`) VALUES
	(1, 'Dish wash 4l', 450.00, 2, 900.00),
	(1, 'Hand wash 4l', 500.00, 2, 1000.00),
	(1, 'Hand wash 4l', 500.00, 1, 500.00),
	(6, 'Dish wash 4l', 450.00, 5, 2250.00),
	(7, 'Hand wash 4l', 500.00, 3, 1500.00),
	(7, 'Dish wash 4l', 450.00, 2, 900.00),
	(7, 'Car wash 4l', 500.00, 1, 500.00),
	(9, 'Hand wash 4l', 500.00, 3, 1500.00),
	(9, 'Dish wash 4l', 450.00, 2, 900.00),
	(10, 'Hand wash 4l', 500.00, 10, 5000.00),
	(10, 'Dish wash 4l', 450.00, 5, 2250.00),
	(11, 'Hand wash 4l,Dish wash 4l,', 500.00, 1, 500.00),
	(12, 'Hand wash 4l', 500.00, 10, 5000.00),
	(12, 'Dish wash 4l', 450.00, 10, 4500.00),
	(13, 'Hand wash 4l', 500.00, 10, 5000.00),
	(13, 'Dish wash 4l', 450.00, 11, 4950.00),
	(14, 'Car wash 4l', 500.00, 4, 2000.00),
	(14, 'Dish wash 4l', 450.00, 5, 2250.00),
	(15, 'Hand wash 4l', 500.00, 10, 5000.00),
	(16, 'Hand wash 4l - Rs 500.00', 500.00, 10, 5000.00),
	(16, 'Dish wash 4l - Rs 450.00', 450.00, 10, 4500.00),
	(17, 'Hand wash 4l', 500.00, 10, 5000.00),
	(17, 'Dish wash 4l', 450.00, 5, 2250.00),
	(18, 'Toilet Bowl Cleaner 4l', 550.00, 10, 5500.00),
	(18, 'Dish wash 4l', 450.00, 10, 4500.00),
	(19, 'Toilet Bowl Cleaner 4l', 550.00, 50, 27500.00),
	(20, 'Car wash 4l', 500.00, 10, 5000.00),
	(20, 'Hand wash 4l', 500.00, 10, 5000.00),
	(21, 'Hand wash 4l', 500.00, 10, 5000.00),
	(22, 'Car wash 4l', 500.00, 10, 5000.00),
	(23, 'Hand wash 4l', 500.00, 10, 5000.00),
	(23, 'Dish wash 4l', 450.00, 5, 2250.00),
	(24, 'Car wash 4l', 500.00, 10, 5000.00),
	(24, 'Toilet Bowl Cleaner 4l', 550.00, 10, 5500.00),
	(24, 'Dish wash 4l', 450.00, 10, 4500.00),
	(25, 'Hand wash 4l', 500.00, 10, 5000.00),
	(26, 'Hand wash 4l - Rs 500.00', 500.00, 5, 2500.00),
	(26, 'Toilet Bowl Cleaner 4l - Rs 550.00', 550.00, 5, 2750.00),
	(27, 'Toilet Bowl Cleaner 4l', 550.00, 5, 2750.00),
	(28, 'Hand wash 4l', 500.00, 10, 5000.00),
	(28, 'Dish wash 4l', 450.00, 5, 2250.00),
	(29, 'Hand wash 4l', 500.00, 1000, 500000.00),
	(30, 'Air Freshner', 650.00, 10, 6500.00),
	(31, 'Glass Clerner', 550.00, 10, 5500.00),
	(31, 'Air Freshner', 650.00, 5, 3250.00),
	(31, 'Car wash 4l', 500.00, 5, 2500.00),
	(31, 'Dish wash 4l', 450.00, 10, 4500.00),
	(32, 'Toilet Bowl Cleaner 4l', 550.00, 10, 5500.00),
	(33, 'Glass Clerner - Rs 550.00', 550.00, 5, 2750.00),
	(34, 'Air Freshner - Rs 650.00', 650.00, 10, 6500.00),
	(35, 'Hand wash 4l - Rs 500.00', 500.00, 10, 5000.00),
	(35, 'Dish wash 4l - Rs 450.00', 450.00, 10, 4500.00),
	(36, 'Hand wash 4l', 500.00, 10, 5000.00),
	(37, 'Hand wash 4l', 500.00, 10, 5000.00),
	(38, 'Hand wash 4l', 500.00, 5, 2500.00),
	(39, 'Hand wash 4l', 500.00, 10, 5000.00),
	(40, 'Air Freshner', 650.00, 10, 6500.00),
	(41, 'Toilet Bowl Cleaner 4l', 550.00, 5, 2750.00),
	(42, 'Air Freshner', 650.00, 10, 6500.00),
	(43, 'Air Freshner', 650.00, 10, 6500.00),
	(44, 'Air Freshner', 650.00, 10, 6500.00),
	(45, 'Hand wash 4l', 500.00, 10, 5000.00),
	(46, 'Glass Clerner', 550.00, 5, 2750.00),
	(47, 'Dish wash 4l', 450.00, 10, 4500.00),
	(48, 'Hand wash 4l', 500.00, 1, 500.00),
	(49, 'Hand wash 4l', 500.00, 10, 5000.00),
	(50, 'Toilet Bowl Cleaner 4l', 550.00, 10, 5500.00),
	(51, 'Air Freshner', 650.00, 10, 6500.00),
	(52, 'Dish wash 4l', 450.00, 20, 9000.00),
	(53, 'Hand wash 4l', 500.00, 55, 27500.00),
	(54, 'Dish wash 4l', 450.00, 10, 4500.00),
	(55, 'Hand wash 4l', 500.00, 10, 5000.00),
	(56, 'Air Freshner', 650.00, 10, 6500.00),
	(57, 'Dish wash 4l', 450.00, 10, 4500.00),
	(58, 'Car wash 4l', 500.00, 10, 5000.00),
	(59, 'Hand Saniziter 50ml', 150.00, 10, 1500.00),
	(60, 'Hand wash 4l', 500.00, 10, 5000.00),
	(60, 'Hand Saniziter 50ml', 150.00, 10, 1500.00),
	(61, 'Hand Saniziter 50ml - Rs 150.00', 150.00, 10, 1500.00),
	(62, 'Hand wash 4l - Rs 500.00', 500.00, 10, 5000.00),
	(62, 'Dish wash 4l - Rs 450.00', 450.00, 10, 4500.00),
	(62, 'Car wash 4l - Rs 500.00', 500.00, 10, 5000.00),
	(63, 'Dish wash 4l', 450.00, 10, 4500.00),
	(63, 'Car wash 4l', 500.00, 20, 10000.00),
	(64, 'Dish wash 4l', 450.00, 10, 4500.00),
	(64, 'Car wash 4l', 500.00, 10, 5000.00),
	(65, 'Hand wash 4l', 500.00, 2, 1000.00),
	(65, 'Dish wash 4l', 450.00, 20, 9000.00),
	(65, 'Hand Saniziter 50ml', 150.00, 100, 15000.00),
	(66, 'Dish wash 4l', 450.00, 10, 4500.00),
	(66, 'Car wash 4l', 500.00, 10, 5000.00),
	(67, 'Car wash 4l - Rs 500.00', 500.00, 10, 5000.00),
	(68, 'Hand wash 4l', 500.00, 10, 5000.00),
	(69, 'Dish wash 4l', 450.00, 10, 4500.00),
	(70, 'Hand Saniziter 4l - Rs 850.00', 850.00, 1, 850.00),
	(71, 'Hand wash 4l', 500.00, 1, 500.00),
	(72, 'Hand wash 4l', 500.00, 2, 1000.00),
	(73, 'Hand wash 4l', 500.00, 2, 1000.00),
	(74, 'Dish wash 4l - Rs 450.00', 450.00, 1, 450.00),
	(75, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(76, 'Hand wash 4l - Rs 500.00', 500.00, 2, 1000.00),
	(77, 'Hand wash 4l', 500.00, 2, 1000.00),
	(78, 'Dish wash 4l - Rs 450.00', 450.00, 1, 450.00),
	(79, 'Hand wash 4l - Rs 500.00', 500.00, 10, 5000.00),
	(80, 'Dish wash 4l - Rs 450.00', 450.00, 5, 2250.00),
	(81, 'Hand wash 4l - Rs 500.00', 500.00, 10, 5000.00),
	(81, 'Dish wash 4l - Rs 450.00', 450.00, 10, 4500.00),
	(81, 'Toilet Bowl Cleaner 4l - Rs 550.00', 550.00, 5, 2750.00),
	(82, 'Car wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(82, 'Dish wash 4l - Rs 450.00', 450.00, 1, 450.00),
	(82, 'Glass Clerner - Rs 550.00', 550.00, 1, 550.00),
	(83, 'Dish wash 4l - Rs 450.00', 450.00, 10, 4500.00),
	(84, 'Hand wash 4l - Rs 500.00', 500.00, 10, 5000.00),
	(84, 'Dish wash 4l - Rs 450.00', 450.00, 4, 1800.00),
	(85, 'Hand wash 4l - Rs 500.00', 500.00, 10, 5000.00),
	(86, 'Dish wash 4l - Rs 450.00', 450.00, 1, 450.00),
	(87, 'Car wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(88, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(89, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(90, 'Dish wash 4l - Rs 450.00', 450.00, 1, 450.00),
	(91, 'Hand wash 4l - Rs 500.00', 500.00, 10, 5000.00),
	(92, 'Hand wash 4l - Rs 500.00', 500.00, 5, 2500.00),
	(93, '\r\n                                    Car wash 4l ', 500.00, 1, 500.00),
	(93, '\r\n                                    Dish wash 4l', 450.00, 1, 450.00),
	(93, '\r\n                                    Hand wash 4l', 500.00, 1, 500.00),
	(93, '\r\n                                    Dish wash 4l', 450.00, 1, 450.00),
	(94, '\r\n                            Hand wash 4l        ', 500.00, 1, 500.00),
	(95, '\r\n                                    Hand wash 4l', 500.00, 1, 500.00),
	(95, '\r\n                                    Dish wash 4l', 450.00, 1, 450.00),
	(95, '\r\n                                    Dish wash 4l', 450.00, 1, 450.00),
	(95, '\r\n                                    Hand wash 4l', 500.00, 1, 500.00),
	(96, '\r\n                                    Hand wash 4l', 500.00, 1, 500.00),
	(97, 'Dish wash 4l - Rs 450.00', 450.00, 1, 450.00),
	(98, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(99, 'Dish wash 4l - Rs 450.00', 450.00, 10, 4500.00),
	(100, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(100, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(101, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(101, 'Air Freshner - Rs 650.00', 650.00, 1, 650.00),
	(102, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(103, 'Car wash 4l - Rs 500.00', 500.00, 10, 5000.00),
	(104, 'Dish wash 4l - Rs 450.00', 450.00, 10, 4500.00),
	(105, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(106, 'Dish wash 4l - Rs 450.00', 450.00, 1, 450.00),
	(107, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(108, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(109, 'Hand wash 4l - Rs 500.00', 500.00, 1, 500.00),
	(110, 'car wash 5l - Rs 2000.00', 2000.00, 10, 20000.00),
	(111, 'car wash 5l - Rs 2000.00', 2000.00, 5, 10000.00),
	(112, 'car wash 5l - Rs 2000.00', 2000.00, 5, 10000.00),
	(113, 'car wash 5l - Rs 2000.00', 2000.00, 10, 20000.00),
	(114, 'car wash 10l - Rs 2500.00', 2500.00, 1, 2500.00),
	(115, 'Hand Saniziter 4l - Rs 850.00', 850.00, 1, 850.00),
	(116, 'Air Freshner - Rs 650.00', 650.00, 1, 650.00);

-- Dumping structure for table rapsol.cheque
CREATE TABLE IF NOT EXISTS `cheque` (
  `cheque_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cheque_number` varchar(255) NOT NULL,
  `cheque_amount` decimal(10,2) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cheque_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.cheque: ~0 rows (approximately)

-- Dumping structure for table rapsol.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `Customer_id` int NOT NULL AUTO_INCREMENT,
  `Customer_Name` varchar(50) DEFAULT NULL,
  `Shop_Name` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Phone_Number` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Customer_Outstanding` decimal(20,2) DEFAULT NULL,
  PRIMARY KEY (`Customer_id`),
  UNIQUE KEY `Shop_Name` (`Shop_Name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.customer: ~8 rows (approximately)
INSERT INTO `customer` (`Customer_id`, `Customer_Name`, `Shop_Name`, `Address`, `Phone_Number`, `Customer_Outstanding`) VALUES
	(1, 'Tharanga', 'Nandana Sale Center', 'Hanwella', '0776206648', 275.00),
	(2, 'Thisitha', 'thusith super', 'Awissawella', '0764462891', 6990.00),
	(3, 'Janaka', 'Nimanda Sale Center', 'Hanwella', '0771168423', 0.00),
	(4, 'sampath', 'Lahan Super Hanwella', 'Hanwella', '0771168428', 1650.00),
	(5, 'wasantha', 'nescafe hanwella', 'Hanwella', '0571168439', 1000.00),
	(6, 'Chuti', 'NR Curtain', 'Hanwella', '0171168439', 0.00),
	(7, 'Maduranga Somithilaka', 'Madu Com', '55/A Kahatapitiya, Hanwella', '0716065995', NULL),
	(8, 'Customer 1', 'shop 1', 'hanwella', '0771168439', NULL);

-- Dumping structure for table rapsol.customer_log
CREATE TABLE IF NOT EXISTS `customer_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `Customer_id` int NOT NULL,
  `Customer_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Shop_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Customer_outstanding` decimal(20,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.customer_log: ~2 rows (approximately)
INSERT INTO `customer_log` (`log_id`, `Customer_id`, `Customer_name`, `Shop_name`, `Customer_outstanding`, `created_at`) VALUES
	(1, 7, 'Maduranga Somithilaka', 'Madu Com', NULL, '2024-11-07 17:33:08'),
	(2, 8, 'Customer 1', 'shop 1', NULL, '2024-11-07 18:18:43');

-- Dumping structure for view rapsol.customer_outstanding_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `customer_outstanding_view` (
	`Customer_Name` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Shop_Name` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Customer_Outstanding` DECIMAL(20,2) NULL
) ENGINE=MyISAM;

-- Dumping structure for view rapsol.customer_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `customer_view` (
	`Customer_id` INT(10) NOT NULL,
	`Customer_Name` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Shop_Name` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Address` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci'
) ENGINE=MyISAM;

-- Dumping structure for function rapsol.get_sales_data
DELIMITER //
CREATE FUNCTION `get_sales_data`(start_date DATE, end_date DATE) RETURNS json
    DETERMINISTIC
BEGIN
    DECLARE result JSON;
    
    -- Fetch total sales and outstanding balance for the date range
    SELECT
        JSON_OBJECT(
            'total_sales', IFNULL(SUM(Bill_Amount), 0),
            'outstanding_balance', IFNULL(SUM(CASE WHEN Bill_Balance > 0 THEN Bill_Balance ELSE 0 END), 0),
            'cash_sales', IFNULL(SUM(Bill_Amount), 0) - IFNULL(SUM(CASE WHEN Bill_Balance > 0 THEN Bill_Balance ELSE 0 END), 0)
        ) INTO result
    FROM bill
    WHERE `Date and time` BETWEEN start_date AND end_date;
    
    RETURN result;
END//
DELIMITER ;

-- Dumping structure for table rapsol.grn
CREATE TABLE IF NOT EXISTS `grn` (
  `grn_id` int NOT NULL AUTO_INCREMENT,
  `grn_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lorry_id` int NOT NULL,
  PRIMARY KEY (`grn_id`) USING BTREE,
  KEY `lorry_id` (`lorry_id`),
  CONSTRAINT `grn_ibfk_1` FOREIGN KEY (`lorry_id`) REFERENCES `lorries` (`lorry_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.grn: ~16 rows (approximately)
INSERT INTO `grn` (`grn_id`, `grn_date`, `lorry_id`) VALUES
	(1, '2024-11-07 15:33:20', 1),
	(2, '2024-11-07 15:33:42', 1),
	(3, '2024-11-07 18:55:48', 2),
	(4, '2024-11-07 18:56:13', 3),
	(5, '2024-11-07 19:05:49', 3),
	(6, '2024-11-07 20:06:41', 1),
	(7, '2024-11-07 20:11:43', 2),
	(8, '2024-11-07 20:12:25', 1),
	(9, '2024-11-07 20:12:48', 1),
	(10, '2024-11-07 20:20:38', 1),
	(11, '2024-11-07 20:20:56', 1),
	(12, '2024-11-08 03:42:19', 3),
	(13, '2024-11-08 03:42:45', 1),
	(14, '2024-11-08 03:43:08', 1),
	(15, '2024-11-08 03:43:29', 1),
	(16, '2024-11-08 04:53:13', 1);

-- Dumping structure for table rapsol.grn_details
CREATE TABLE IF NOT EXISTS `grn_details` (
  `grn_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`grn_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `grn_details_ibfk_1` FOREIGN KEY (`grn_id`) REFERENCES `grn` (`grn_id`) ON DELETE CASCADE,
  CONSTRAINT `grn_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`Product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.grn_details: ~15 rows (approximately)
INSERT INTO `grn_details` (`grn_id`, `product_id`, `quantity`) VALUES
	(1, 1, 1),
	(1, 2, 1),
	(2, 1, 1),
	(3, 1, 1),
	(4, 1, 1),
	(5, 10, 10),
	(7, 4, 10),
	(9, 3, 1),
	(10, 1, 2),
	(11, 2, 10),
	(12, 10, 5),
	(13, 1, 2),
	(14, 1, 1),
	(15, 1, 1),
	(16, 5, 10);

-- Dumping structure for procedure rapsol.InsertCustomer
DELIMITER //
CREATE PROCEDURE `InsertCustomer`(
    IN p_customer_name VARCHAR(50),
    IN p_shop_name VARCHAR(50),
    IN p_address VARCHAR(50),
    IN p_phone_number TEXT,
    IN p_customer_outstanding DECIMAL(20,2) 
)
BEGIN
    -- Check if the customer already exists based on customer name, shop name, or phone number
    IF EXISTS (
        SELECT 1
        FROM customer
        WHERE Customer_Name = p_customer_name
        OR Shop_Name = p_shop_name
        OR Phone_Number = p_phone_number
    ) THEN
        -- Raise an error if a customer with the same name, shop name, or phone number already exists
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error: A customer with this name, shop name, or phone number already exists.';
    ELSE
        -- Insert new customer into the customer table
        INSERT INTO customer (Customer_Name, Shop_Name, Address, Phone_Number, Customer_Outstanding)
        VALUES (p_customer_name, p_shop_name, p_address, p_phone_number, p_customer_outstanding);
    END IF;
END//
DELIMITER ;

-- Dumping structure for procedure rapsol.InsertLorry
DELIMITER //
CREATE PROCEDURE `InsertLorry`(
    IN p_registration_number VARCHAR(50),
    IN p_make VARCHAR(100),
    IN p_model VARCHAR(100),
    IN p_load_capacity INT(10)
)
BEGIN
    -- Check if the registration number already exists in the lorries table
    IF EXISTS (
        SELECT 1 FROM lorries WHERE registration_number = p_registration_number
    ) THEN
        -- Raise an error if the registration number already exists
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error: A lorry with this registration number already exists.';
    ELSE
        -- Insert the new lorry into the table
        INSERT INTO lorries (registration_number, make, model, load_capacity)
        VALUES (p_registration_number, p_make, p_model, p_load_capacity);
    END IF;
END//
DELIMITER ;

-- Dumping structure for procedure rapsol.InsertProduct
DELIMITER //
CREATE PROCEDURE `InsertProduct`(
    IN p_product_name VARCHAR(255),
    IN p_product_code VARCHAR(255),
    IN p_product_price DECIMAL(10, 2)
)
BEGIN
    -- Check if a product with the same name or code already exists
    IF EXISTS (SELECT 1 FROM products WHERE Product_name = p_product_name OR Product_code = p_product_code) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error: A product with this name or code already exists.';
    ELSE
        -- Insert the new product into the database
        INSERT INTO products (Product_name, Product_code, Product_price)
        VALUES (p_product_name, p_product_code, p_product_price);
    END IF;
END//
DELIMITER ;

-- Dumping structure for procedure rapsol.insert_cheque
DELIMITER //
CREATE PROCEDURE `insert_cheque`(
    IN p_customer_id VARCHAR(255),
    IN p_cheque_number VARCHAR(255),
    IN p_cheque_amount DECIMAL(10,2),
    IN p_bank VARCHAR(255),
    IN p_branch VARCHAR(255),
    IN p_cheque_date DATE
)
BEGIN
    -- Insert the cheque data into the cheque table
    INSERT INTO `cheque` (
        `customer_id`,
        `cheque_number`,
        `cheque_amount`,
        `bank`,
        `branch`,
        `cheque_date`
    )
    VALUES (
        p_customer_id,
        p_cheque_number,
        p_cheque_amount,
        p_bank,
        p_branch,
        p_cheque_date
    );
END//
DELIMITER ;

-- Dumping structure for procedure rapsol.insert_user
DELIMITER //
CREATE PROCEDURE `insert_user`(
    IN p_username VARCHAR(50),
    IN p_password VARCHAR(255)
)
BEGIN
    DECLARE v_password_hash VARCHAR(255);

    -- Check if username already exists
    IF EXISTS (SELECT 1 FROM users WHERE username = p_username) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Username already taken';
    ELSE
        -- Hash the password
        SET v_password_hash = SHA2(p_password, 256); -- Use SHA-256 for simplicity. You can use other hashing methods like bcrypt if necessary.
        
        -- Insert the new user into the users table
        INSERT INTO users (username, password_hash) VALUES (p_username, v_password_hash);
    END IF;
END//
DELIMITER ;

-- Dumping structure for table rapsol.lorries
CREATE TABLE IF NOT EXISTS `lorries` (
  `lorry_id` int NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(50) NOT NULL,
  `make` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `load_capacity` int NOT NULL,
  PRIMARY KEY (`lorry_id`),
  UNIQUE KEY `registration_number` (`registration_number`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.lorries: ~3 rows (approximately)
INSERT INTO `lorries` (`lorry_id`, `registration_number`, `make`, `model`, `load_capacity`) VALUES
	(1, 'HH-8200', 'Toyota', 'toyoace', 1000),
	(2, 'HH-8201', 'Toyota', 'toyoace', 1000),
	(3, 'HH-8202', 'Toyota', 'toyoace', 1000);

-- Dumping structure for table rapsol.lorry_log
CREATE TABLE IF NOT EXISTS `lorry_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `lorry_id` int DEFAULT NULL,
  `registration_number` varchar(50) DEFAULT NULL,
  `make` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `load_capacity` int DEFAULT NULL,
  `action_type` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.lorry_log: ~1 rows (approximately)
INSERT INTO `lorry_log` (`log_id`, `lorry_id`, `registration_number`, `make`, `model`, `load_capacity`, `action_type`, `created_at`) VALUES
	(1, 3, 'HH-8202', 'Toyota', 'toyoace', 1000, 'INSERT', '2024-11-07 18:31:41');

-- Dumping structure for table rapsol.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `Order_id` int NOT NULL AUTO_INCREMENT,
  `Product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Product_price` decimal(10,2) NOT NULL,
  `Quantity` int NOT NULL,
  `Total_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Order_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.order_details: ~0 rows (approximately)

-- Dumping structure for table rapsol.products
CREATE TABLE IF NOT EXISTS `products` (
  `Product_id` int NOT NULL AUTO_INCREMENT,
  `Product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Product_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Product_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.products: ~10 rows (approximately)
INSERT INTO `products` (`Product_id`, `Product_name`, `Product_code`, `Product_price`) VALUES
	(1, 'Hand wash 4l', 'RAP14', 500.00),
	(2, 'Dish wash 4l', 'RAP12/2', 450.00),
	(3, 'Car wash 4l', 'RAP01/2', 500.00),
	(4, 'Toilet Bowl Cleaner 4l', 'RAP1', 550.00),
	(5, 'Glass Clerner', 'RAP17/2', 550.00),
	(6, 'Air Freshner', 'RAP15/2', 650.00),
	(7, 'Hand Saniziter 50ml', 'RAP05', 150.00),
	(8, 'Hand Saniziter 4l', 'RAP45', 850.00),
	(10, 'car wash 10l', 'car', 2500.00),
	(11, 'car wash 5l', 'car5', 2000.00);

-- Dumping structure for view rapsol.product_list
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `product_list` (
	`Product_id` INT(10) NOT NULL,
	`Product_name` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Product_code` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Product_price` DECIMAL(10,2) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for table rapsol.product_log
CREATE TABLE IF NOT EXISTS `product_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `Product_id` int NOT NULL,
  `Product_name` varchar(255) NOT NULL,
  `Product_code` varchar(255) NOT NULL,
  `Product_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.product_log: ~2 rows (approximately)
INSERT INTO `product_log` (`log_id`, `Product_id`, `Product_name`, `Product_code`, `Product_price`, `created_at`) VALUES
	(1, 10, 'car wash 10l', 'car', 2500.00, '2024-11-07 17:20:15'),
	(2, 11, 'car wash 5l', 'car5', 2000.00, '2024-11-07 18:14:19');

-- Dumping structure for table rapsol.rejected_cheque
CREATE TABLE IF NOT EXISTS `rejected_cheque` (
  `rejected_cheque_id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) DEFAULT NULL,
  `shop_id` int DEFAULT NULL,
  `cheque_amount` decimal(10,2) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `rejection_reason` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rejected_cheque_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.rejected_cheque: ~0 rows (approximately)

-- Dumping structure for table rapsol.settlement
CREATE TABLE IF NOT EXISTS `settlement` (
  `settlement_id` int NOT NULL AUTO_INCREMENT,
  `Customer_id` int NOT NULL DEFAULT '0',
  `paid_amount` decimal(10,2) NOT NULL DEFAULT (0),
  `date & time` datetime NOT NULL DEFAULT (0),
  PRIMARY KEY (`settlement_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.settlement: ~32 rows (approximately)
INSERT INTO `settlement` (`settlement_id`, `Customer_id`, `paid_amount`, `date & time`) VALUES
	(1, 2, 1000.00, '2024-09-04 13:22:22'),
	(2, 2, 500.00, '2024-09-04 13:37:50'),
	(3, 2, 1000.00, '2024-09-04 13:41:14'),
	(4, 2, 500.00, '2024-09-04 13:44:52'),
	(5, 1, 250.00, '2024-09-04 13:47:10'),
	(6, 2, 500.00, '2024-09-04 13:49:54'),
	(7, 2, 500.00, '2024-09-04 13:53:01'),
	(8, 2, 500.00, '2024-09-04 13:53:45'),
	(9, 2, 400.00, '2024-09-04 13:54:15'),
	(10, 2, 100.00, '2024-09-04 13:54:51'),
	(11, 2, 100.00, '2024-09-04 13:56:10'),
	(12, 2, 100.00, '2024-09-04 14:01:14'),
	(13, 1, 50.00, '2024-09-04 14:01:39'),
	(14, 4, 500.00, '2024-09-04 16:55:53'),
	(15, 3, 500.00, '2024-09-04 16:58:10'),
	(16, 1, 1450.00, '2024-09-04 20:56:18'),
	(17, 2, 100.00, '2024-09-04 20:59:37'),
	(18, 2, 100.00, '2024-09-04 23:04:37'),
	(19, 6, 500.00, '2024-09-05 17:08:00'),
	(20, 1, 10.00, '2024-11-07 16:28:03'),
	(21, 1, 10.00, '2024-11-07 16:46:49'),
	(22, 1, 10.00, '2024-11-07 16:47:45'),
	(23, 1, 10.00, '2024-11-07 16:49:41'),
	(24, 1, 60.00, '2024-11-08 02:27:49'),
	(25, 1, 10.00, '2024-11-08 02:29:52'),
	(26, 1, 50.00, '2024-11-08 02:38:07'),
	(27, 1, 40.00, '2024-11-08 02:38:43'),
	(28, 2, 100.00, '2024-11-08 02:40:59'),
	(29, 1, 10.00, '2024-11-08 02:45:17'),
	(30, 1, 10.00, '2024-11-08 02:47:36'),
	(31, 1, 5.00, '2024-11-08 02:53:41'),
	(32, 2, 10.00, '2024-11-08 03:06:53');

-- Dumping structure for table rapsol.stock
CREATE TABLE IF NOT EXISTS `stock` (
  `product_id` int NOT NULL,
  `lorry_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `stock_ibfk_2` (`lorry_id`),
  CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`Product_id`) ON DELETE CASCADE,
  CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`lorry_id`) REFERENCES `lorries` (`lorry_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.stock: ~6 rows (approximately)
INSERT INTO `stock` (`product_id`, `lorry_id`, `quantity`) VALUES
	(1, 1, 3),
	(2, 1, 10),
	(3, 1, 1),
	(4, 2, 10),
	(5, 1, 10),
	(10, 3, 10);

-- Dumping structure for table rapsol.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplierId` int NOT NULL AUTO_INCREMENT,
  `supplierName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contactNumber` int NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Unknown',
  PRIMARY KEY (`supplierId`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.suppliers: ~0 rows (approximately)

-- Dumping structure for table rapsol.transfer
CREATE TABLE IF NOT EXISTS `transfer` (
  `transfer_id` int NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transfer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.transfer: ~3 rows (approximately)
INSERT INTO `transfer` (`transfer_id`, `created_at`) VALUES
	(1, '2024-08-29 15:14:59'),
	(2, '2024-08-29 16:09:09'),
	(3, '2024-08-30 05:01:31');

-- Dumping structure for table rapsol.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table rapsol.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password_hash`) VALUES
	(1, 'admin', '$2y$10$0jCHuywZ3OAx2g3JfCeAkOcdmEANHFE0yVPeTpYvCxbt1bryvqxGm'),
	(2, 'kavishka', '$2y$10$6oqZaW6pHFzYVcrcatuhROwhuBhUjBzOeLCUjM5Va4RQmI9eyA2sm'),
	(3, 'Gayan', '$2y$10$6oqZaW6pHFzYVcrcatuhROwhuBhUjBzOeLCUjM5Va4RQmI9eyA2sm'),
	(4, 'sanduni', '$2y$10$6oqZaW6pHFzYVcrcatuhROwhuBhUjBzOeLCUjM5Va4RQmI9eyA2sm'),
	(5, 'gayantha', '$2y$10$6oqZaW6pHFzYVcrcatuhROwhuBhUjBzOeLCUjM5Va4RQmI9eyA2sm');

-- Dumping structure for view rapsol.view_cheque
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_cheque` (
	`cheque_id` INT(10) NOT NULL,
	`customer_id` VARCHAR(255) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`cheque_number` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`cheque_amount` DECIMAL(10,2) NULL,
	`bank` VARCHAR(255) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`branch` VARCHAR(255) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`cheque_date` DATE NULL,
	`Customer_Name` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Shop_Name` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci'
) ENGINE=MyISAM;

-- Dumping structure for view rapsol.view_rejected_cheque
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_rejected_cheque` (
	`rejected_cheque_id` INT(10) NOT NULL,
	`customer_name` VARCHAR(255) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`shop_id` INT(10) NULL,
	`cheque_amount` DECIMAL(10,2) NULL,
	`bank` VARCHAR(255) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`branch` VARCHAR(255) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`cheque_date` DATE NULL,
	`rejection_reason` TEXT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`created_at` TIMESTAMP NULL,
	`shop_name` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci'
) ENGINE=MyISAM;

-- Dumping structure for view rapsol.view_stock
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_stock` (
	`product_id` INT(10) NOT NULL,
	`Product_name` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`lorry_id` INT(10) NOT NULL,
	`registration_number` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`quantity` INT(10) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view rapsol.v_lorries
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_lorries` (
	`lorry_id` INT(10) NOT NULL,
	`registration_number` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`make` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`model` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`load_capacity` INT(10) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for trigger rapsol.after_customer_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `after_customer_insert` AFTER INSERT ON `customer` FOR EACH ROW BEGIN
    INSERT INTO customer_log (Customer_id, Customer_name, Shop_name, Customer_outstanding, created_at)
    VALUES (NEW.Customer_id, NEW.Customer_Name, NEW.Shop_Name, NEW.Customer_Outstanding, NOW());
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger rapsol.after_lorry_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `after_lorry_insert` AFTER INSERT ON `lorries` FOR EACH ROW BEGIN
    INSERT INTO lorry_log (lorry_id, registration_number, make, model, load_capacity, action_type)
    VALUES (NEW.lorry_id, NEW.registration_number, NEW.make, NEW.model, NEW.load_capacity, 'INSERT');
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger rapsol.after_product_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `after_product_insert` AFTER INSERT ON `products` FOR EACH ROW BEGIN
    -- Insert a log entry for the newly added product
    INSERT INTO `product_log` (`Product_id`, `Product_name`, `Product_code`, `Product_price`)
    VALUES (NEW.Product_id, NEW.Product_name, NEW.Product_code, NEW.Product_price);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `customer_outstanding_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `customer_outstanding_view` AS select `customer`.`Customer_Name` AS `Customer_Name`,`customer`.`Shop_Name` AS `Shop_Name`,`customer`.`Customer_Outstanding` AS `Customer_Outstanding` from `customer`;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `customer_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `customer_view` AS select `customer`.`Customer_id` AS `Customer_id`,`customer`.`Customer_Name` AS `Customer_Name`,`customer`.`Shop_Name` AS `Shop_Name`,`customer`.`Address` AS `Address` from `customer`;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `product_list`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `product_list` AS select `products`.`Product_id` AS `Product_id`,`products`.`Product_name` AS `Product_name`,`products`.`Product_code` AS `Product_code`,`products`.`Product_price` AS `Product_price` from `products`;

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_cheque`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_cheque` AS select `c`.`cheque_id` AS `cheque_id`,`c`.`customer_id` AS `customer_id`,`c`.`cheque_number` AS `cheque_number`,`c`.`cheque_amount` AS `cheque_amount`,`c`.`bank` AS `bank`,`c`.`branch` AS `branch`,`c`.`cheque_date` AS `cheque_date`,`cu`.`Customer_Name` AS `Customer_Name`,`cu`.`Shop_Name` AS `Shop_Name` from (`cheque` `c` join `customer` `cu` on((`c`.`customer_id` = `cu`.`Customer_id`)));

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_rejected_cheque`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_rejected_cheque` AS select `r`.`rejected_cheque_id` AS `rejected_cheque_id`,`r`.`customer_name` AS `customer_name`,`r`.`shop_id` AS `shop_id`,`r`.`cheque_amount` AS `cheque_amount`,`r`.`bank` AS `bank`,`r`.`branch` AS `branch`,`r`.`cheque_date` AS `cheque_date`,`r`.`rejection_reason` AS `rejection_reason`,`r`.`created_at` AS `created_at`,`c`.`Shop_Name` AS `shop_name` from (`rejected_cheque` `r` join `customer` `c` on((`r`.`shop_id` = `c`.`Customer_id`)));

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_stock`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_stock` AS select `s`.`product_id` AS `product_id`,`p`.`Product_name` AS `Product_name`,`s`.`lorry_id` AS `lorry_id`,`l`.`registration_number` AS `registration_number`,`s`.`quantity` AS `quantity` from ((`stock` `s` join `products` `p` on((`s`.`product_id` = `p`.`Product_id`))) join `lorries` `l` on((`s`.`lorry_id` = `l`.`lorry_id`)));

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_lorries`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_lorries` AS select `lorries`.`lorry_id` AS `lorry_id`,`lorries`.`registration_number` AS `registration_number`,`lorries`.`make` AS `make`,`lorries`.`model` AS `model`,`lorries`.`load_capacity` AS `load_capacity` from `lorries`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
