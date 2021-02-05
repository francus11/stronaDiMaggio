-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 24, 2020 at 08:35 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address` text COLLATE utf8_polish_ci NOT NULL,
  `zip_code` text COLLATE utf8_polish_ci NOT NULL,
  `city` text COLLATE utf8_polish_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `sum_price` decimal(11,2) NOT NULL,
  `items_price` decimal(11,2) NOT NULL,
  `promotion_price` decimal(11,2) NOT NULL,
  `status` text COLLATE utf8_polish_ci NOT NULL,
  `item_id_1` int(11) NOT NULL,
  `item_id_2` int(11) NOT NULL,
  `item_id_3` int(11) NOT NULL,
  `item_id_4` int(11) NOT NULL,
  `item_id_5` int(11) NOT NULL,
  `item_id_6` int(11) NOT NULL,
  `item_id_7` int(11) NOT NULL,
  `item_id_8` int(11) NOT NULL,
  `item_id_9` int(11) NOT NULL,
  `item_id_10` int(11) NOT NULL,
  `item_id_11` int(11) NOT NULL,
  `item_id_12` int(11) NOT NULL,
  `item_id_13` int(11) NOT NULL,
  `item_id_14` int(11) NOT NULL,
  `item_id_15` int(11) NOT NULL,
  `item_id_16` int(11) NOT NULL,
  `item_id_17` int(11) NOT NULL,
  `item_id_18` int(11) NOT NULL,
  `item_id_19` int(11) NOT NULL,
  `item_id_20` int(11) NOT NULL,
  `item_id_21` int(11) NOT NULL,
  `item_id_22` int(11) NOT NULL,
  `item_id_23` int(11) NOT NULL,
  `item_id_24` int(11) NOT NULL,
  `item_id_25` int(11) NOT NULL,
  `item_id_26` int(11) NOT NULL,
  `item_id_27` int(11) NOT NULL,
  `item_id_28` int(11) NOT NULL,
  `item_id_29` int(11) NOT NULL,
  `item_id_30` int(11) NOT NULL,
  `item_id_31` int(11) NOT NULL,
  `item_id_32` int(11) NOT NULL,
  `item_id_33` int(11) NOT NULL,
  `item_id_34` int(11) NOT NULL,
  `item_id_35` int(11) NOT NULL,
  `item_id_36` int(11) NOT NULL,
  `item_id_37` int(11) NOT NULL,
  `item_id_38` int(11) NOT NULL,
  `item_id_39` int(11) NOT NULL,
  `item_id_40` int(11) NOT NULL,
  `item_id_41` int(11) NOT NULL,
  `item_id_42` int(11) NOT NULL,
  `item_id_43` int(11) NOT NULL,
  `item_id_44` int(11) NOT NULL,
  `item_id_45` int(11) NOT NULL,
  `item_id_46` int(11) NOT NULL,
  `item_id_47` int(11) NOT NULL,
  `item_id_48` int(11) NOT NULL,
  `item_id_49` int(11) NOT NULL,
  `item_id_50` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `date`, `address`, `zip_code`, `city`, `phone`, `sum_price`, `items_price`, `promotion_price`, `status`, `item_id_1`, `item_id_2`, `item_id_3`, `item_id_4`, `item_id_5`, `item_id_6`, `item_id_7`, `item_id_8`, `item_id_9`, `item_id_10`, `item_id_11`, `item_id_12`, `item_id_13`, `item_id_14`, `item_id_15`, `item_id_16`, `item_id_17`, `item_id_18`, `item_id_19`, `item_id_20`, `item_id_21`, `item_id_22`, `item_id_23`, `item_id_24`, `item_id_25`, `item_id_26`, `item_id_27`, `item_id_28`, `item_id_29`, `item_id_30`, `item_id_31`, `item_id_32`, `item_id_33`, `item_id_34`, `item_id_35`, `item_id_36`, `item_id_37`, `item_id_38`, `item_id_39`, `item_id_40`, `item_id_41`, `item_id_42`, `item_id_43`, `item_id_44`, `item_id_45`, `item_id_46`, `item_id_47`, `item_id_48`, `item_id_49`, `item_id_50`) VALUES
(1, 1, 'Adrian Chołody', '2019-11-19 22:32:55', 'WolaWężykowa 39c', '98-160', 'Sędziejowice', 534153078, '30.00', '20.00', '20.00', 'Oczekujące', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 'Adrian Chołody', '2019-11-19 23:48:28', 'WolaWężykowa 39c', '98-160', 'Sędziejowice', 534153078, '50.00', '40.00', '40.00', 'Oczekujące', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 1, 'Adrian Chołody', '2020-01-23 19:23:09', 'WolaWężykowa 39c', '98-160', 'Sędziejowice', 534153078, '37.00', '27.00', '27.00', 'Oczekujące', 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 1, 'Adrian Chołody', '2020-01-23 19:23:14', 'WolaWężykowa 39c', '98-160', 'Sędziejowice', 534153078, '25.00', '15.00', '15.00', 'Oczekujące', 22, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 1, 'Adrian Chołody', '2020-01-23 19:36:54', 'WolaWężykowa 39c', '98-160', 'Sędziejowice', 534153078, '13.00', '3.00', '3.00', 'Oczekujące', 19, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 1, 'Adrian Chołody', '2020-01-23 20:45:10', 'WolaWężykowa 39c', '98-160', 'Sędziejowice', 534153078, '37.00', '27.00', '27.00', 'Oczekujące', 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 1, 'Adrian Chołody', '2020-01-23 20:45:15', 'WolaWężykowa 39c', '98-160', 'Sędziejowice', 534153078, '37.00', '27.00', '27.00', 'Oczekujące', 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 1, 'Adrian Chołody', '2020-01-24 16:34:29', 'WolaWężykowa 39c', '98-160', 'Sędziejowice', 534153078, '36.00', '26.00', '26.00', 'Oczekujące', 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` text COLLATE utf8_polish_ci NOT NULL,
  `title` text COLLATE utf8_polish_ci NOT NULL,
  `ingredients` text COLLATE utf8_polish_ci NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `photo`, `title`, `ingredients`, `price`) VALUES
(1, '01-1.png', 'Margherita', 'Ser, oregano', 20),
(2, '02-1.png', 'Capriciosa', 'Ser, szynka, pieczarki, oregano', 20),
(3, '03-1.png', 'Parma', 'ser mozzarella, szynka dojrzewająca, bazylia świeża, oregano', 20),
(4, '04-1.png', 'Cambione', 'ser, szynka, kabanosy, boczek wędzony, salami, oregano', 22),
(5, '05-1.png', 'Decoro', 'ser, szynka, pieczarki, papryka konserwowa, czosnek, oregano', 22),
(6, '06-1.png', 'Pepe Roso', 'ser, salami, papryka konserwowa, oregano', 22),
(7, '07-1.png', 'Napoletana', 'Ser, salami, oliwki zielone, papryczki jalapenos, oregano', 25),
(8, '08-1.png', 'Piacere', 'ser, sos pomidorowy, salami, boczek wędzony, cebula', 23),
(9, '09-1.png', 'Roma', 'ser, salami, kabanosy, papryka konserwowa, oregano', 24),
(10, '10-1.png', 'Polska', 'ser, szynka, kiełbasa, kabanosy, cebula, papryka', 24),
(11, 'sta-71.png', 'Lasagne Bolognese', 'Plastry makaronu lasagne z farszem wołowym i dodatkiem sosu pomidorowego', 27),
(13, 'sta-72.png', 'Lasagne Spinachi', 'Plastry makaronu lasagne z aromatycznym farszem serowo-szpinakowym', 26),
(14, 'zup-82.png', 'Krem pomidorowy', 'z parmezanem i pieczywem typu bastoncino', 17),
(15, 'zup-83.png', 'Zupa cebulowa', 'z serem i pieczywem typu bastoncino.', 18),
(16, 'cc.png', 'Coca-cola', '', 3),
(17, 'cc-zero.png', 'Coca-Cola Zero', '', 3),
(18, 'cc-zero-cherry.png', 'Coca-Cola Zero Cherry', '', 3),
(19, 'fanta.png', 'Fanta', '', 3),
(20, 'sprite.png', 'Sprite', '', 3),
(21, 'n-burn-250ml.png', 'Burn', '', 3),
(22, 'salata_z-burakiem.png', 'Sałatka z burakiem', 'Kebab drobiowy, ogórek, buraki marynowane, ser sałatkowy, orzechy włoskie', 15),
(23, '51_salata-grecka.png', 'Sałatka grecka', 'Pomidory koktajlowe, ogórek, ser sałatkowy, oliwki czarne, papryka, cebula', 14),
(24, '52_salata-z-kurczakiem.png', 'Sałatka z kurczakiem', 'Kebab drobiowy, pomidory koktajlowe, ogórek, kukurydza, cebula', 16),
(25, '54_salata-da-grasso.png', 'Sałatka DiMaggio', 'Pieczona pierś z kurczaka, pomidory, ogórek, parmezan, mieszanka ziaren', 16),
(26, '56_salata-z-tunczykiem.png', 'Sałatka z tuńczykiem', 'Tuńczyk, pomidory koktajlowe, ogórek, kukurydza, cebula czerwona', 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `address` text COLLATE utf8_polish_ci NOT NULL,
  `zip_code` text COLLATE utf8_polish_ci NOT NULL,
  `city` text CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `phone` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `name`, `address`, `zip_code`, `city`, `phone`) VALUES
(1, 'admin', 'francus62@gmail.com', '$2y$10$fYFiRt4Zxodwl23HVD25Fum6b8OIXAqI33urdPVMN6wHTbgqvkE1m', 'Adrian Chołody', 'WolaWężykowa 39c', '98-160', 'Sędziejowice', 534153078),
(2, 'admin1', 'francus63@gmail.com', '$2y$10$Ey2EHiRmCXMCj9iM1WzWiuWsmcfezN6pLfxTElgh0DRXczjLnxJZy', '', '', '', '', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
