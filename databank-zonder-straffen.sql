-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 04 apr 2020 om 21:58
-- Serverversie: 10.1.39-MariaDB
-- PHP-versie: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databank`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `laws`
--

CREATE TABLE `laws` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `fine` int(11) NOT NULL DEFAULT '0',
  `months` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `laws`
--

INSERT INTO `laws` (`id`, `name`, `description`, `fine`, `months`) VALUES
(8, 'Artikel 5 WVW', 'Persoon heeft zich zodanig misdragen dat hij/zij het verkeer hindert en een gevaar is voor andere', 1250, 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `citizenid` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT 'https://i.imgur.com/tdi3NGa.png',
  `fingerprint` varchar(255) DEFAULT NULL,
  `dnacode` varchar(255) DEFAULT NULL,
  `note` text,
  `lastsearch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `profiles`
--

INSERT INTO `profiles` (`id`, `citizenid`, `fullname`, `avatar`, `fingerprint`, `dnacode`, `note`, `lastsearch`) VALUES
(4, 'IER15810', 'Theo Janssen', 'https://image.prntscr.com/image/gaKqMDNHS4_ammOV-DqOKw.png', '', '', 'Woont in Apartment Integrity.<br />\r\n<br />\r\nRijdt veel in een zwarte schafter.<br />\r\nEerder opgepakt voor vuurwapenbezit', 1575119563);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `profileid` int(11) DEFAULT NULL,
  `report` text NOT NULL,
  `laws` text,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `reports`
--

INSERT INTO `reports` (`id`, `title`, `author`, `profileid`, `report`, `laws`, `created`) VALUES
(7, 'Artikel 5 WVW en Rijden zonder rijbewijs', 'Austin Kash', 4, '13-12 Commissaris Austin K. was aan het surveilleren bij Intergrity Way waarnaar hij een zwarte schafter erg overdreven zag rijden in noordelijke richting.<br />\r\n<br />\r\nNa de persoon zwervend over het wegdek reedt en meerdere malen door rood reed heeft de 13-12 heb staande gehouden en is meneer Janssen mee gegaan naar het bureau.<br />\r\n<br />\r\nVerklaring Dhr. Janssen:<br />\r\n\"Ja ik weet niet ik had zin om te planken\"<br />\r\n<br />\r\nDe HOVJ heeft een Artikel 5 WVW toegewezen en daarbij is dhr. Janssen veroordeelt.', '[8]', 1575077082);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `last_login` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `role`, `rank`, `last_login`) VALUES
(1, 'test', '$2y$10$Y7Nr8jG0TWPzsZC9G38yFe3.iRcxLw5Z7Qf7/2EuirILTlcefHrEO', 'Austin Kash', 'admin', 'Commissaris', '2019-11-30');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `warrants`
--

CREATE TABLE `warrants` (
  `id` int(11) NOT NULL,
  `citizenid` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `laws`
--
ALTER TABLE `laws`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexen voor tabel `warrants`
--
ALTER TABLE `warrants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `laws`
--
ALTER TABLE `laws`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `warrants`
--
ALTER TABLE `warrants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
