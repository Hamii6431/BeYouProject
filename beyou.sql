-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Ápr 15. 14:41
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `beyou`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(20) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_first_name` varchar(255) NOT NULL,
  `admin_last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_username`, `admin_password`, `admin_email`, `admin_first_name`, `admin_last_name`) VALUES
(1, 'TestAdmin', '$2y$10$.TufdtV8WsPCLEbM9DqTR.lCmQWWrdSVV30GrilDhYCaoozIODOd6', 'testadmin@gmail.com', 'Test', 'Admin');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `final_orders`
--

CREATE TABLE `final_orders` (
  `final_order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Received','Processing','Shipped') DEFAULT NULL,
  `shipping_address_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `final_order_items`
--

CREATE TABLE `final_order_items` (
  `final_order_item_id` int(11) NOT NULL,
  `final_order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gemstones`
--

CREATE TABLE `gemstones` (
  `gemstone_id` int(11) NOT NULL,
  `gemstone_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `gemstones`
--

INSERT INTO `gemstones` (`gemstone_id`, `gemstone_name`) VALUES
(6, 'Opal'),
(7, 'Garnet'),
(10, 'Amethyst');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `materials`
--

CREATE TABLE `materials` (
  `material_id` int(11) NOT NULL,
  `material_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `materials`
--

INSERT INTO `materials` (`material_id`, `material_name`) VALUES
(6, 'Silver'),
(7, 'Rosegold'),
(8, 'Gold');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `gemstone_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `default_image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `description`, `stock`, `gemstone_id`, `type_id`, `material_id`, `default_image_url`) VALUES
(34, 'Amethyst Bracelet', 69.99, 'Beautiful amethyst bracelet featuring intricate design, perfect for any occasion.', 0, 10, 5, 6, 'ametist_bracelet_2-removebg-preview.png'),
(35, 'Amethyst Necklace', 79.99, 'Elegant amethyst necklace with delicate detailing, adding a touch of sophistication to your look.', 0, 10, 6, 6, 'ametist_necklace_1-removebg-preview.png'),
(36, 'Amethyst Necklace', 89.99, 'Exquisite amethyst necklace featuring a unique pendant design, a must-have addition to your jewelry collection.', 0, 10, 6, 6, 'ametist_necklace_2-removebg-preview.png'),
(42, 'Opal Bracelet', 49.99, 'Elegant opal bracelet with intricate design, perfect for any occasion.', 0, 6, 5, 6, 'opal_bracelet_1-removebg-preview.png'),
(43, 'Opal Bracelet', 59.99, 'Stunning opal bracelet featuring a modern twist design, guaranteed to turn heads.', 7, 6, 5, 6, 'opal_bracelet_2-removebg-preview.png'),
(44, 'Opal Bracelet', 39.99, 'Simple yet chic opal bracelet, ideal for everyday wear.', 3, 6, 5, 6, 'opal_bracelet_3-removebg-preview.png'),
(45, 'Opal Bracelet', 69.99, 'Exquisite opal bracelet adorned with intricate patterns, a timeless piece for your collection.', 0, 6, 5, 6, 'opal_bracelet_4-removebg-preview.png'),
(46, 'Opal Bracelet', 79.99, 'Opulent opal bracelet featuring a luxurious design, perfect for special occasions.', 0, 6, 5, 6, 'opal_bracelet_5-removebg-preview.png'),
(47, 'Opal Ring', 79.99, 'Opulent opal ring featuring a classic design, perfect for adding a touch of glamour to your look.', 7, 6, 4, 6, 'opal_ring_2-removebg-preview.png'),
(48, 'Opal Ring', 69.99, 'Exquisite opal ring with intricate detailing, a timeless piece that exudes sophistication.', 0, 6, 4, 6, 'opal_ring_3-removebg-preview.png'),
(49, 'Opal Ring', 89.99, 'Stunning opal ring showcasing a modern design, a must-have addition to your jewelry collection.', 6, 6, 4, 6, 'opal_ring_4-removebg-preview.png'),
(50, 'Opal Ring', 99.99, 'Elegant opal ring featuring a minimalist design, perfect for everyday wear.', 9, 6, 4, 6, 'opal_ring_5-removebg-preview.png'),
(51, 'Pink Bracelet', 49.99, 'Charming pink bracelet with delicate detailing, ideal for adding a pop of color to your look.', 14, 7, 5, 6, 'pink_bracelet_2-removebg-preview.png'),
(52, 'Pink Necklace', 59.99, 'Feminine pink necklace featuring a stunning pendant design, a versatile piece for any occasion.', 18, 7, 6, 6, 'pink_necklace_1-removebg-preview.png'),
(53, 'Rosegold Opal Ring', 129.99, 'Luxurious rosegold opal ring adorned with intricate patterns, a statement piece for any jewelry lover.', 0, 6, 4, 7, 'rosegold_opal_ring_1-removebg-preview.png'),
(54, 'Rosegold Opal Ring', 139.99, 'Exquisite rosegold opal ring featuring a modern design, perfect for adding a touch of elegance to your look.', 6, 6, 4, 7, 'rosegold_opal_ring_2-removebg-preview.png'),
(81, 'Twisted Amethyst Bracelet', 59.99, 'Stunning amethyst bracelet with a modern twist design, sure to make a statement.', 1, 10, 5, 6, 'ametist_bracelet_1-removebg-preview.png');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`address_id`, `user_id`, `phone_number`, `country`, `postal_code`, `city`, `street_address`) VALUES
(8, 1, '06204040404', 'Test Country', '7370', 'Test City', 'Test Address 12.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `types`
--

INSERT INTO `types` (`type_id`, `type_name`) VALUES
(4, 'Ring'),
(5, 'Bracelet'),
(6, 'Necklace');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`) VALUES
(1, 'TestUser', '$2y$10$.TufdtV8WsPCLEbM9DqTR.lCmQWWrdSVV30GrilDhYCaoozIODOd6', 'testuser@gmail.com', 'Test', 'User');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- A tábla indexei `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- A tábla indexei `final_orders`
--
ALTER TABLE `final_orders`
  ADD PRIMARY KEY (`final_order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shipping_address_id` (`shipping_address_id`);

--
-- A tábla indexei `final_order_items`
--
ALTER TABLE `final_order_items`
  ADD PRIMARY KEY (`final_order_item_id`),
  ADD KEY `final_order_id` (`final_order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- A tábla indexei `gemstones`
--
ALTER TABLE `gemstones`
  ADD PRIMARY KEY (`gemstone_id`);

--
-- A tábla indexei `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `gemstone_id` (`gemstone_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `material_id` (`material_id`);

--
-- A tábla indexei `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT a táblához `final_orders`
--
ALTER TABLE `final_orders`
  MODIFY `final_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT a táblához `final_order_items`
--
ALTER TABLE `final_order_items`
  MODIFY `final_order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `gemstones`
--
ALTER TABLE `gemstones`
  MODIFY `gemstone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT a táblához `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Megkötések a táblához `final_orders`
--
ALTER TABLE `final_orders`
  ADD CONSTRAINT `final_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `final_orders_ibfk_2` FOREIGN KEY (`shipping_address_id`) REFERENCES `shipping_addresses` (`address_id`);

--
-- Megkötések a táblához `final_order_items`
--
ALTER TABLE `final_order_items`
  ADD CONSTRAINT `final_order_items_ibfk_1` FOREIGN KEY (`final_order_id`) REFERENCES `final_orders` (`final_order_id`),
  ADD CONSTRAINT `final_order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Megkötések a táblához `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`gemstone_id`) REFERENCES `gemstones` (`gemstone_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`);

--
-- Megkötések a táblához `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD CONSTRAINT `shipping_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
