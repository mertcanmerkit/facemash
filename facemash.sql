-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:8889
-- Üretim Zamanı: 14 Ara 2021, 20:59:58
-- Sunucu sürümü: 5.7.34
-- PHP Sürümü: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `facemash`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `adder` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `adder`, `name`) VALUES
(3, 32, 'collage'),
(4, 32, 'Seksi sarışınlar'),
(5, 32, 'hadi la hadi'),
(6, 32, 'kumrallar'),
(7, 32, 'kumral seyler');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categoryData`
--

CREATE TABLE `categoryData` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `imageId` int(11) NOT NULL,
  `voters` text,
  `count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `categoryData`
--

INSERT INTO `categoryData` (`id`, `categoryId`, `imageId`, `voters`, `count`) VALUES
(1, 3, 2, '27,32', 2),
(2, 3, 1, '', 1),
(4, 3, 1, '', 1),
(5, 3, 1, '', 1),
(6, 3, 1, '', 1),
(7, 3, 1, '', 1),
(8, 3, 1, '', 1),
(9, 3, 1, '', 1),
(10, 3, 1, '', 1),
(11, 3, 1, '', 1),
(12, 3, 1, '', 1),
(13, 3, 1, '', 1),
(14, 3, 1, '', 1),
(15, 3, 1, '', 1),
(16, 3, 1, '', 1),
(17, 3, 1, '', 1),
(18, 3, 1, '', 1),
(19, 3, 1, '', 1),
(20, 3, 1, '', 1),
(21, 3, 1, '', 1),
(22, 3, 1, '', 1),
(23, 3, 1, '', 1),
(24, 3, 1, '', 1),
(25, 3, 1, '', 1),
(26, 3, 1, '', 1),
(27, 3, 1, '', 1),
(28, 7, 5, NULL, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `adder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `images`
--

INSERT INTO `images` (`id`, `username`, `adder`) VALUES
(1, 'javaci', 27),
(2, 'mertcanmerkit', 32),
(4, 'duyguozaslan', 32),
(5, 'angelinajolie', 32);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `passwordReset`
--

CREATE TABLE `passwordReset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `secretKey` varchar(255) NOT NULL,
  `ip` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `token` varchar(255) NOT NULL,
  `ip` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `token`, `ip`) VALUES
(27, '@hakan', 'hakan@hakan.hakan', 'hakan', 'xXGhmYitMv89', '::1'),
(32, 'test', 'test@gmail.com', 'memet', 'uhapIdqTct8N', '::1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_user_id` (`adder`);

--
-- Tablo için indeksler `categoryData`
--
ALTER TABLE `categoryData`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ctgry_data_id` (`categoryId`),
  ADD KEY `ctgey_image_id` (`imageId`);

--
-- Tablo için indeksler `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`adder`);

--
-- Tablo için indeksler `passwordReset`
--
ALTER TABLE `passwordReset`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_unique` (`username`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `categoryData`
--
ALTER TABLE `categoryData`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Tablo için AUTO_INCREMENT değeri `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `passwordReset`
--
ALTER TABLE `passwordReset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `category_user_id` FOREIGN KEY (`adder`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `categoryData`
--
ALTER TABLE `categoryData`
  ADD CONSTRAINT `ctgey_image_id` FOREIGN KEY (`imageId`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `ctgry_data_id` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`);

--
-- Tablo kısıtlamaları `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`adder`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
