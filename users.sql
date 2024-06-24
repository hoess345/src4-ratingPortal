-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Jun 2024 um 22:33
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ratingportal`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `passwordhash` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `passwordhash`, `username`) VALUES
(1, '$2y$10$WPA9PJ0SXbd8OVY8iCS8q.yFONz5QoA4BZVWc31EGegBnC7w2aIEa', 'yannick'),
(2, '$2y$10$O1EFFD123J4BMmV3Gf5T7.s3R/.pNFWwUG466Wqz0Ik.nL.Bt0R1y', 'elena'),
(3, '$2y$10$kHL6sOOpOszN5zELr0F/beaJku0ZzkVUHnIeRbzKLAWlXg.JU8Acu', 'hoess'),
(4, '$2y$10$MLLw4BCn/Uay5/v1Z0uQXOYsdbT/GwoJA6.hDNDjZHpXG0qa8DyhK', 'asd'),
(5, '$2y$10$uRRbMKKiQNqv1coNlH85m./aKmWQ3Fb4/0ZP3KN4YQVo5WzXOeYdO', 'test'),
(6, '$2y$10$xZzXZ60Sk9dg0BLrs9qVzeHqPEQfBK8g4lS0yDKQEsI4qMD7FWVF2', 'huan'),
(7, '$2y$10$NU7l5UVJzKnXRqFuVVvgAODbw9zyvnj031fV10CM4telYsANrlwJG', 'test2');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
