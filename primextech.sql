-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 13, 2025 at 02:13 PM
-- Server version: 9.2.0
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `primextech`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT '0',
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cuppon`
--

CREATE TABLE `cuppon` (
  `cuppon_id` int NOT NULL,
  `discount` int NOT NULL,
  `cuppon_code` varchar(55) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cuppon`
--

INSERT INTO `cuppon` (`cuppon_id`, `discount`, `cuppon_code`, `created_at`) VALUES
(1, 5, '', '2025-08-07 07:19:04'),
(2, 5, '', '2025-08-07 07:22:53'),
(3, 5, 'm7dnTKqtYgCM', '2025-08-07 07:25:24'),
(4, 5, 'IwOJrnylJC2K', '2025-08-07 07:25:26'),
(5, 10, '7qN2ECDQtVMs', '2025-08-07 08:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `client_id` int DEFAULT NULL,
  `total_amount` int DEFAULT NULL,
  `status` enum('pending','shipping','arrived') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `client_id`, `total_amount`, `status`, `created_at`) VALUES
(64, 27, 20, 'arrived', '2025-07-21 10:24:47'),
(65, 27, 20, 'arrived', '2025-07-21 10:25:16'),
(66, 27, 100, 'arrived', '2025-07-21 10:25:27'),
(67, 27, 20, 'arrived', '2025-07-21 10:30:42'),
(68, 27, 100, 'arrived', '2025-07-21 10:36:02'),
(69, 27, 20, 'arrived', '2025-07-21 10:38:15'),
(70, 27, 20, 'arrived', '2025-07-21 10:39:01'),
(71, 27, 100, 'arrived', '2025-07-21 10:44:03'),
(72, 27, 20, 'arrived', '2025-07-21 10:44:51'),
(73, 27, 20, 'arrived', '2025-07-21 10:46:19'),
(74, 27, 20, 'arrived', '2025-07-21 10:47:39'),
(75, 27, 20, 'arrived', '2025-07-21 10:48:53'),
(76, 27, 20, 'arrived', '2025-07-21 10:50:34'),
(77, 27, 500, 'arrived', '2025-07-21 10:51:53'),
(78, 27, 120, 'arrived', '2025-07-22 11:05:21'),
(79, 27, 20, 'arrived', '2025-07-22 11:06:15'),
(80, 27, 100, 'arrived', '2025-07-22 11:06:26'),
(81, 27, 20, 'arrived', '2025-07-23 10:23:34'),
(82, 27, 50, 'arrived', '2025-07-23 10:24:37'),
(83, 27, 10, 'arrived', '2025-07-23 10:25:15'),
(84, 27, 150, 'shipping', '2025-07-25 07:02:04'),
(85, 27, 880, 'arrived', '2025-07-25 07:38:32'),
(86, 27, 1000, 'pending', '2025-07-25 09:52:42'),
(87, 27, 1000, 'pending', '2025-07-25 09:56:34'),
(88, 27, 1000, 'arrived', '2025-07-30 10:53:46'),
(89, 27, 1000, 'shipping', '2025-07-30 11:51:21'),
(90, 27, 1500, 'arrived', '2025-07-31 08:36:36'),
(91, 27, 1000, 'pending', '2025-07-31 08:37:17'),
(92, 27, 1000, 'arrived', '2025-07-31 17:01:27'),
(93, 27, 1000, 'arrived', '2025-08-05 09:33:13'),
(94, 27, 500, 'pending', '2025-08-05 11:12:09'),
(95, 27, 2598, 'shipping', '2025-08-07 07:40:29'),
(96, 27, 1299, 'pending', '2025-08-07 07:44:06'),
(97, 27, 1100, 'pending', '2025-08-07 08:27:38'),
(98, 27, 6172, 'shipping', '2025-08-07 19:38:24'),
(99, 27, 2468, 'pending', '2025-08-07 19:39:06'),
(100, 27, 2468, 'pending', '2025-08-07 19:42:30'),
(101, 27, 3030, 'arrived', '2025-08-13 10:45:29'),
(102, 27, 2419, 'arrived', '2025-08-13 11:17:45'),
(103, 27, 2598, 'pending', '2025-08-13 13:33:44'),
(104, 27, 2998, 'arrived', '2025-08-13 13:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `destinacion` varchar(100) NOT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `destinacion`, `quantity`, `price`) VALUES
(96, 98, 137, 'Skenderaj', 2, '1499.00'),
(99, 101, 170, 'Dragash', 1, '229.99'),
(100, 101, 135, 'Dragash', 2, '1399.99'),
(101, 102, 141, 'Suhareke', 1, '69.99'),
(102, 102, 140, 'Suhareke', 1, '149.00'),
(105, 104, 137, 'Prishtine', 2, '1499.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `description` text,
  `image_path` varchar(255) NOT NULL,
  `qrCode` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `category`, `type`, `description`, `image_path`, `qrCode`, `price`, `stock`, `created_at`) VALUES
(135, ' HP Spectre x360 ', 'Computer', 'flashsales', ' The HP Spectre x360 is a premium 2-in-1 laptop with a touchscreen, convertible design, and Intel Evo certification. It features long battery life, vibrant display, and powerful specs, ideal for creatives, multitaskers, and users needing flexibility with style and performance. ', '../uploads/transparent-14T-EU000.png', '0366889439', '1399.99', 6, '2025-08-06 13:09:11'),
(137, ' Lenovo ThinkPad X1 Carbon ', 'Computer', 'flashsales', ' Lenovo’s ThinkPad X1 Carbon is a business-class laptop known for its durable carbon fiber chassis, excellent keyboard, and strong security features. It’s lightweight yet powerful, designed for professionals who demand reliability, performance, and portability in corporate and field environments. ', '../uploads/622467e4140019edcda30e48b82e49a6.png', '0404328723', '1499.00', 10, '2025-08-06 13:13:21'),
(138, ' Razer BlackWidow V3 ', 'Gaming', 'flashsales', ' The Logitech G502 HERO is a high-precision gaming mouse featuring a 16,000 DPI sensor, customizable weights, and RGB lighting. It offers exceptional responsiveness and comfort for gamers, making it one of the most popular wired gaming mice for competitive and casual play. ', '../uploads/g502-hero-gallery-2-nb.png', '2223302630', '59.99', 40, '2025-08-06 13:14:53'),
(139, ' Razer BlackWidow V3 ', 'Gaming', 'flashsales', ' Razer’s BlackWidow V3 mechanical keyboard includes tactile green switches, customizable macro keys, and Chroma RGB lighting. It is designed for fast, accurate gaming with a comfortable wrist rest, offering a premium typing and gaming experience for competitive players. ', '../uploads/3827-1-en-v2.png', '6357028057', '129.99', 30, '2025-08-06 13:15:33'),
(140, ' SteelSeries Arctis 7 ', 'Gaming', 'flashsales', ' The SteelSeries Arctis 7 wireless headset provides 24-hour battery life, comfortable ear cups, and DTS Headphone:X 2.0 surround sound for immersive gaming. It delivers clear voice communication and rich audio quality, making it a favorite among serious gamers. ', '../uploads/steelseries-arctis-7-gaming-headset-black_5.webp', '5934157068', '149.00', 25, '2025-08-06 13:16:40'),
(141, ' Xbox Wireless Controller ', 'Gaming', 'flashsales', ' The Xbox Wireless Controller is ergonomic and compatible with Xbox consoles and PCs. It features textured grips, responsive buttons, and Bluetooth connectivity for wireless gaming. Designed for comfort and precision, it is suitable for casual gamers and eSports enthusiasts alike. ', '../uploads/Xbox_Controller_RHS78_TransBG_RGB_2013.png', '9553002190', '69.99', 50, '2025-08-06 13:18:12'),
(142, ' Elgato Stream Deck ', 'Gaming', 'flashsales', ' The Xbox Wireless Controller is ergonomic and compatible with Xbox consoles and PCs. It features textured grips, responsive buttons, and Bluetooth connectivity for wireless gaming. Designed for comfort and precision, it is suitable for casual gamers and eSports enthusiasts alike. ', '../uploads/streamdeck_plus_v2.png', '7650903955', '69.99', 50, '2025-08-06 13:20:34'),
(143, ' Canon EOS R50 ', 'Camera', 'flashsales', ' The Canon EOS R50 is an entry-level mirrorless camera featuring a 24.2MP sensor, 4K video recording, and built-in WiFi. It’s ideal for beginner photographers and vloggers who want high image quality with easy-to-use controls and versatile shooting modes. ', '../uploads/side+R50+with+lens_resized.png', '8703955357', '799.00', 12, '2025-08-06 13:21:57'),
(144, ' Nikon D5600 ', 'Camera', 'flashsales', ' Nikon’s D5600 DSLR offers a 24.2MP sensor, 39-point autofocus system, and vari-angle touchscreen. It supports Full HD video and provides excellent image quality, making it a great choice for enthusiasts looking to step up their photography game. ', '../uploads/d5600-afp-18-55-vr-frt34l.png', '4377445266', '699.00', 9, '2025-08-06 13:23:06'),
(145, ' Sony Alpha a6400 ', 'Camera', 'flashsales', ' The Sony Alpha a6400 is a mirrorless camera with real-time eye autofocus, 4K video capabilities, and a 180-degree tilting screen for selfies and vlogging. It delivers fast performance and impressive image quality in a compact body. ', '../uploads/398294-mirrorless-cameras-sony-alpha-a6400-w-e-18-135mm-10006056.webp', '6654253522', '999.99', 7, '2025-08-06 13:24:22'),
(146, ' Fujifilm X-T30 II ', 'Camera', 'flashsales', ' Fujifilm’s X-T30 II is a stylish mirrorless camera offering film simulation modes, fast autofocus, and 4K video recording. It provides vibrant colors and excellent image quality, appealing to both amateurs and advanced photographers. ', '../uploads/405225-mirrorless-cameras-fujifilm-x-t30-ii-w-15-45mm-10041856.png', '8921808908', '899.00', 10, '2025-08-06 13:26:31'),
(147, ' Panasonic Lumix G7', 'Camera', 'flashsales', ' The Panasonic Lumix G7 is a 4K mirrorless camera with a flip-out screen, high-speed autofocus, and creative shooting modes. It’s well-suited for vloggers, beginners, and photography enthusiasts seeking versatile performance. ', '../uploads/384267-mirrorless-cameras-panasonic-lumix-dmc-g7k-w-14-42mm-f-3-5-5-6-ii-asph-mega-o-i-s-10000413.png', '4285555942', '599.00', 15, '2025-08-06 13:27:59'),
(148, ' Sony WH-1000XM5 ', 'HeadPhones', 'flashsales', ' Sony’s WH-1000XM5 headphones feature industry-leading noise cancellation, premium sound quality, and 30 hours of battery life. Comfortable and sleek, they are ideal for music lovers and frequent travelers looking for immersive audio experiences. ', '../uploads/WH1000XM5S.webp', '7881460156', '399.99', 20, '2025-08-06 13:29:04'),
(149, ' Apple AirPods Max ', 'HeadPhones', 'flashsales', ' Apple’s AirPods Max provide high-fidelity audio with dynamic drivers, active noise cancellation, and spatial audio support. The premium design combines comfort and style, suitable for users who want top-tier wireless headphones. ', '../uploads/hero__gnfk5g59t0qe_xlarge.png', '2525734628', '549.00', 8, '2025-08-06 13:30:29'),
(150, ' Bose QuietComfort 45 ', 'HeadPhones', 'flashsales', ' Bose’s QuietComfort 45 headphones offer excellent noise cancellation, balanced sound, and superior comfort. With long battery life and reliable Bluetooth connectivity, they are perfect for daily commuters and office use. ', '../uploads/cq5dam.web.1920.1920.png', '9365590530', '329.00', 15, '2025-08-06 13:31:28'),
(151, 'JBL Live 660NC', 'HeadPhones', 'flashsales', ' JBL Live 660NC wireless headphones include ambient aware and talk-thru modes, 40 hours battery life, and rich sound quality. They combine comfort with features designed for busy lifestyles and music enjoyment. ', '../uploads/JBL_LIVE_660NC_Product_Image_Hero_Black.webp', '2518371469', '199.99', 25, '2025-08-06 13:33:26'),
(152, 'JBL Live 660NC', 'HeadPhones', 'flashsales', ' JBL Live 660NC wireless headphones include ambient aware and talk-thru modes, 40 hours battery life, and rich sound quality. They combine comfort with features designed for busy lifestyles and music enjoyment. ', '../uploads/JBL_LIVE_660NC_Product_Image_Hero_Black.webp', '1789033089', '199.99', 25, '2025-08-06 13:34:20'),
(153, ' Beats Studio Pro ', 'HeadPhones', 'flashsales', ' Beats Studio Pro delivers powerful bass and crisp highs, with active noise cancellation and lossless USB-C audio. Their comfortable design and customizable fit make them excellent for workouts and daily listening. ', '../uploads/s-l1600-4-Photoroom.webp', '6153595593', '349.99', 18, '2025-08-06 13:35:15'),
(154, ' iPhone 14 Pro ', 'Phones', 'flashsales', ' Apple’s flagship iPhone 14 Pro features the Dynamic Island, ProMotion display, and A16 Bionic chip, delivering incredible speed and smoothness. Its advanced triple-camera system enables stunning photos and videos in all lighting conditions. ', '../uploads/1200px-IPhone_14_Pro_Max.webp', '6429005375', '999.00', 30, '2025-08-06 14:00:28'),
(155, ' Samsung Galaxy S23 ', 'Phones', 'flashsales', ' Samsung Galaxy S23 offers a Snapdragon 8 Gen 2 processor, 120Hz AMOLED display, and powerful camera system. It’s designed for smooth multitasking, gaming, and photography enthusiasts who want premium Android performance. ', '../uploads/samsung-galaxy-s23-ultra-transparent-image-free-png.webp', '3105284177', '899.99', 28, '2025-08-06 14:01:15'),
(156, ' Google Pixel 8 ', 'Phones', 'flashsales', ' Google Pixel 8 features clean Android experience with Google Tensor chip, excellent AI tools, and computational photography capabilities, making it perfect for users who want smart features and top-notch camera performance. ', '../uploads/unnamed.png', '1107487646', '799.00', 22, '2025-08-06 14:02:28'),
(157, ' OnePlus 11 ', 'Phones', 'flashsales', ' Google Pixel 8 features clean Android experience with Google Tensor chip, excellent AI tools, and computational photography capabilities, making it perfect for users who want smart features and top-notch camera performance. ', '../uploads/green-img.png', '1709229257', '749.00', 20, '2025-08-06 14:03:33'),
(158, ' Xiaomi 13 Pro ', 'Phones', 'flashsales', ' Xiaomi 13 Pro features Leica optics, Snapdragon 8 Gen 2, and fast charging. It offers premium build quality and high-end photography, appealing to users looking for a value-packed flagship device. ', '../uploads/7dbad2b88f5905685ef80ae2659491be.png', '0501752032', '899.00', 15, '2025-08-06 14:04:49'),
(159, ' Apple Watch Series 9 ', 'SmartWatch', 'flashsales', ' Apple Watch Series 9 offers advanced health tracking, double tap gesture control, and seamless Siri integration. It monitors workouts, heart rate, and sleep, making it a versatile companion for fitness and daily tasks. ', '../uploads/apple-watch-series-9.png', '9412306758', '429.00', 18, '2025-08-06 14:06:12'),
(160, ' Samsung Galaxy Watch 6 ', 'SmartWatch', 'flashsales', ' Samsung Galaxy Watch 6 runs Wear OS with body composition sensors, long battery life, and a stylish design. It tracks various fitness metrics and integrates well with Android smartphones. ', '../uploads/410335-smartwatches-samsung-galaxy-watch6-44mm-10035961.webp', '1078591332', '399.00', 12, '2025-08-06 14:06:57'),
(161, ' Garmin Forerunner 265 ', 'SmartWatch', 'flashsales', ' Garmin Forerunner 265 features an AMOLED display, GPS, and advanced training metrics. It’s perfect for runners and athletes needing detailed health data and customizable workouts. ', '../uploads/Forerunner265_HR_1002.57_2048x.webp', '4941604705', '499.00', 10, '2025-08-06 14:08:02'),
(162, ' Fitbit Versa 4 ', 'SmartWatch', 'flashsales', ' Fitbit Versa 4 provides sleep monitoring, daily readiness scores, and built-in GPS. Its lightweight design and long battery life make it ideal for everyday fitness tracking. ', '../uploads/410495-smartwatches-fitbit-versa-4-10036133.png', '5008961201', '229.00', 25, '2025-08-06 14:08:55'),
(163, ' Huawei Watch GT 4 ', 'SmartWatch', 'flashsales', ' Huawei Watch GT 4 offers a beautiful AMOLED screen, multiple workout modes, and impressive battery life, supporting health monitoring for an active lifestyle. ', '../uploads/100349539_100_01.webp', '3811486701', '279.99', 12, '2025-08-06 14:09:44'),
(164, ' Microsoft Surface Laptop 5 ', 'Computer', 'flashsales', ' Microsoft Surface Laptop 5 is a sleek Windows laptop with 12th Gen Intel processors, PixelSense touchscreen, and enhanced performance for professionals and students who value portability and style. ', '../uploads/409390-15-to-16-inch-laptops-microsoft-15-surface-laptop-5-core-i7-10035242.webp', '0392646591', '1299.00', 14, '2025-08-06 14:22:12'),
(165, ' Corsair K95 RGB Platinum ', 'Gaming', 'flashsales', ' Corsair K95 RGB Platinum mechanical keyboard features Cherry MX switches, 6 programmable macro keys, and dynamic RGB lighting for an immersive gaming experience. ', '../uploads/corsair-k95-rgb-platinum_ztxt.png', '1824997736', '199.99', 20, '2025-08-06 14:23:07'),
(166, ' Logitech G Pro X Wireless ', 'Gaming', 'flashsales', ' Logitech G Pro X Wireless is a lightweight headset with Blue VO!CE microphone technology and 20-hour battery life, designed for competitive gaming and clear communication. ', '../uploads/pro-wireless-headset-gallery-1.png', '8126989445', '149.99', 15, '2025-08-06 14:24:03'),
(167, ' Nikon Z6 II ', 'Camera', 'flashsales', ' Nikon Z6 II is a full-frame mirrorless camera with dual processors, 4K video recording, and improved autofocus, suitable for professional photographers and videographers. ', '../uploads/FrontLeft-1659-Z6II--IzgIDCo_.png', '8184678762', '1999.00', 5, '2025-08-06 14:24:44'),
(168, ' Canon EOS Rebel T8i ', 'Camera', 'flashsales', ' Canon EOS Rebel T8i is an entry-level DSLR with 24.1MP sensor, vari-angle touchscreen, and 4K video capabilities, perfect for new photographers stepping into DSLR photography. ', '../uploads/400904-slr-cameras-canon-eos-850d-rebel-t8i-w-18-55mm-10015062.webp', '0826596652', '799.99', 8, '2025-08-06 14:25:42'),
(169, ' Sennheiser Momentum 4 ', 'HeadPhones', 'flashsales', ' Sennheiser Momentum 4 offers premium wireless headphones with adaptive noise cancellation, crisp sound, and up to 17 hours battery life, ideal for audiophiles seeking style and performance. ', '../uploads/MOMENTUM_4_Wireless_Graphite_Isofront_300x300.avif', '2387268688', '349.95', 10, '2025-08-06 14:27:37'),
(170, ' Razer Huntsman V2 Analog ', 'Gaming', 'flashsales', ' Razer Huntsman V2 Analog is a mechanical keyboard with analog optical switches, customizable RGB lighting, and dedicated media controls, built for fast, precise gameplay. ', '../uploads/4023-1-EN-v1.png', '3495594563', '229.99', 12, '2025-08-06 14:29:28'),
(171, ' Sony Alpha a7 IV ', 'Camera', 'flashsales', ' Sony Alpha a7 IV is a full-frame mirrorless camera with a 33MP sensor, fast autofocus, and 4K60p video, perfect for professional photographers and videographers. ', '../uploads/Alpha7IV_SEL2870_top_19474f54-b7b0-41e1-864d-34cd2e617f05.webp', '4705472970', '2499.99', 7, '2025-08-06 14:30:45'),
(172, ' Beats Fit Pro ', 'HeadPhones', 'flashsales', ' Beats Fit Pro true wireless earbuds provide active noise cancellation, spatial audio, and a secure fit, designed for workouts and all-day comfort. ', '../uploads/fitpro-pdp-p04.png.large.2x.png', '3964375306', '199.95', 18, '2025-08-06 14:31:50'),
(173, ' Google Pixel Watch ', 'SmartWatch', 'flashsales', ' Google Pixel Watch integrates Fitbit health tracking, heart rate monitoring, and Google Assistant support in a sleek, stylish design with Wear OS. ', '../uploads/412140-smartwatches-google-pixel-watch-2-lte-10037036.png', '1763719087', '349.99', 20, '2025-08-06 14:32:33'),
(174, ' ASUS TUF Gaming F15 ', 'Computer', 'flashsales', ' ASUS TUF Gaming F15 is a durable gaming laptop with Intel Core i7 CPU, NVIDIA RTX 3060 graphics, and high refresh rate display, designed for serious gamers. ', '../uploads/dlcdnwebimgs.asus.png', '9716262696', '1099.99', 11, '2025-08-06 14:35:27'),
(175, ' HyperX Cloud II ', 'Gaming', 'flashsales', ' HyperX Cloud II gaming headset offers virtual 7.1 surround sound, noise cancellation, and comfortable memory foam ear pads for long gaming sessions. ', '../uploads/0a7f25c60587611f1ce037adebcbd883.png', '2436978070', '99.99', 30, '2025-08-06 14:36:14'),
(176, ' Panasonic Lumix S5 ', 'Camera', 'flashsales', ' Panasonic Lumix S5 is a compact full-frame mirrorless camera with 4K60p video, dual image stabilization, and versatile photography features, suitable for advanced users. ', '../uploads/ast-1824773.png.pub.png', '0786647757', '1699.00', 6, '2025-08-06 14:38:57'),
(177, ' JBL Quantum 800 ', 'Camera', 'flashsales', ' JBL Quantum 800 wireless gaming headset features active noise cancellation, RGB lighting, and 14-hour battery life for immersive gaming audio. ', '../uploads/JBL_Quantum 800_Product Image_ANGLE_White.png', '3845790311', '149.95', 20, '2025-08-06 14:39:33'),
(178, ' OnePlus Buds Pro 2 ', 'HeadPhones', 'flashsales', ' OnePlus Buds Pro 2 offers hybrid active noise cancellation, 10-bit audio, and up to 38 hours of battery life, combining sound quality and comfort. ', '../uploads/2754353a401feff84ee67636a13feefa.png', '2582375472', '149.99', 22, '2025-08-06 14:40:50'),
(179, ' Samsung Galaxy Buds 2 Pro ', 'HeadPhones', 'flashsales', ' Galaxy Buds 2 Pro deliver premium sound, active noise cancellation, and seamless integration with Samsung devices for a top wireless earbud experience. ', '../uploads/samsung-buds-2-pro.webp', '1533766209', '229.99', 18, '2025-08-06 14:41:41'),
(180, ' Fitbit Charge 5 ', 'SmartWatch', 'flashsales', ' Fitbit Charge 5 offers stress management, ECG monitoring, sleep tracking, and built-in GPS, designed for health-conscious users wanting advanced fitness data. ', '../uploads/101_hero_mgn-921aae7f025c05cd1d04bf6919f36223.png', '6385885755', '149.95', 24, '2025-08-06 14:42:22'),
(181, ' Acer Predator Helios 300 ', 'Computer', 'flashsales', ' Acer Predator Helios 300 is a powerful gaming laptop with Intel Core i7 processor, NVIDIA RTX 3060, and a 144Hz display, perfect for high-end gaming performance. ', '../uploads/Predator-Helios-300-PH315-53-Standard_01.png', '7755542636', '1199.99', 13, '2025-08-06 14:43:10'),
(182, ' Razer Basilisk V3 Pro ', 'Gaming', 'flashsales', ' Razer Basilisk V3 Pro is a wireless gaming mouse with customizable buttons, high-precision sensor, and Razer Chroma RGB lighting, engineered for pro gamers. ', '../uploads/6219-1-en-v1.png', '7841197702', '159.99', 20, '2025-08-06 14:43:48'),
(183, ' Nikon COOLPIX P1000 ', 'Camera', 'flashsales', ' Nikon COOLPIX P1000 offers a massive 125x optical zoom, 4K video, and advanced shooting modes, making it ideal for wildlife and long-distance photography enthusiasts. ', '../uploads/p1000-bk-front34r-lo-t.png', '7415818546', '999.95', 7, '2025-08-06 14:44:27'),
(184, 'pr', 'Computer', 'flashsales', 'pr', '../uploads/VENGEANCE_a7500_240mm_AIO_Cooler_RENDER_01.avif', '0622170730', '500.00', 50, '2025-08-13 11:01:31'),
(185, 'product', 'Computer', 'flashsales', 'product', '../uploads/VENGEANCE_a7500_240mm_AIO_Cooler_RENDER_01.avif', '0652106166', '500.00', 100, '2025-08-13 11:18:44'),
(186, 'product', 'Computer', 'flashsales', 'product', '../uploads/VENGEANCE_a7500_240mm_AIO_Cooler_RENDER_01.avif', '0356433446', '500.00', 60, '2025-08-13 13:34:37'),
(187, 'product', 'Computer', 'flashsales', 'product', '../uploads/VENGEANCE_a7500_240mm_AIO_Cooler_RENDER_01.avif', '5609890839', '500.00', 60, '2025-08-13 13:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `role`, `created_at`) VALUES
(26, 'depoist', 'depoist', 'depoist@gmail.com', '$2y$10$lF40k3yjsLvvhHr1OVAQH.JAUA/enhxpPE54GSJR7O2m8PCsbEnMq', 'depoist', '0000-00-00 00:00:00'),
(27, 'user', 'user', 'user@gmail.com', '$2y$10$72SxquIoU3BAEubCZUu3oOYBC5e1xReg.49OvVZVsVIwuMUvkKtke', 'user', '0000-00-00 00:00:00'),
(28, 'admin', 'admin', 'admin@gmail.com', '$2y$10$f6Yj9lhA5VpgtdhzClIdKeH/LAtDwTTtxVa44/kfX9j.fCbnUHkRm', 'admin', '0000-00-00 00:00:00'),
(29, 'Depoist2', 'Depoist', 'depoist2@gmail.com', '$2y$10$wUKP5fo2MWRvGPQEZasW.ef6M/.j.7HTf98TFvJDs/pA63JazN65e', 'depoist', '0000-00-00 00:00:00'),
(30, 'bl', ' bl', 'bledionmehmeti@gmail.com', '$2y$10$85hhrpJBzjmv0uVLldiR8.UqwT2f1n3xzpSsKRDx3xktk1UVpMWsy', 'depoist', '0000-00-00 00:00:00'),
(32, 'filanDepo', 'filanDepo', 'filanDepo@gmail.com', '$2y$10$x24Pl/0iaF4ruV.mBqlLl.bp33S6f7yMcil2j8Y8L4M.PUq2ncany', 'depoist', '0000-00-00 00:00:00'),
(34, 'depot', 'depot', 'depot@gmail.com', '$2y$10$NtEGLnnKJYkJz9BVKd6Pu.6gXrH7z7Cw7fOLPIOMQbVhtraKdrtLe', 'depoist', '0000-00-00 00:00:00'),
(35, '', '', '', '$2y$10$X8up2USc7uHcKRz0VMQdLOorjDkpVVa6l6hIaIcONlpxRbhZePwQi', 'depoist', '0000-00-00 00:00:00'),
(36, 'Bledion', 'Mehmeti', 'bledion@gmail.com', '$2y$10$0CA2mVaAK0MtTQKcx3VUr.na1GchlXfrbrW2e.x4SiLNo5glwaZCO', 'user', '0000-00-00 00:00:00'),
(37, 'User', 'User', 'usernew@gmail.com', '$2y$10$SlQeYLhOppfxmy4Vlul9ReGh2mn3W/AxmA2He5yPlY8XrWbLV8AqW', 'user', '2025-08-05 11:22:32'),
(40, 'depo2', 'depo2', 'depo2@gmail.com', '$2y$10$s6yG655OfJ03HUXvkT3tVezU72hZjm7nZ./KMcZyCA6ToGigmtqfW', 'depoist', '2025-08-13 13:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `created_at`) VALUES
(26, 27, 141, '2025-08-13 13:29:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `cuppon`
--
ALTER TABLE `cuppon`
  ADD PRIMARY KEY (`cuppon_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `qrCode` (`qrCode`),
  ADD UNIQUE KEY `qrCode_2` (`qrCode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_ibfk_1` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `cuppon`
--
ALTER TABLE `cuppon`
  MODIFY `cuppon_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
