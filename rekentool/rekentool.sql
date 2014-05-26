-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Gegenereerd op: 26 mei 2014 om 12:04
-- Serverversie: 5.6.16
-- PHP-versie: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `rekentool`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `caos`
--

CREATE TABLE IF NOT EXISTS `caos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `wage` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `caos`
--

INSERT INTO `caos` (`id`, `name`, `duration`, `wage`, `created_at`, `updated_at`) VALUES
(1, 'Glas en Tuinbouw', 38, 8.84, '2014-05-06 04:58:00', '2014-05-06 04:58:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden uitgevoerd voor tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_04_16_140156_glastuin-loontabel-initial', 1),
('2014_04_24_090008_new_caos_new_salaries', 2),
('2014_04_24_090754_new_salaries', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `salaries`
--

CREATE TABLE IF NOT EXISTS `salaries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cao_id` int(10) unsigned NOT NULL,
  `age` int(10) unsigned NOT NULL,
  `catagory` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `salaries`
--

INSERT INTO `salaries` (`id`, `cao_id`, `age`, `catagory`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 'B', '3.536', '2014-05-06 04:58:00', '2014-05-06 04:58:00'),
(2, 1, 16, 'B', '4.42', '2014-05-06 04:58:00', '2014-05-06 04:58:00'),
(3, 1, 17, 'B', '5.304', '2014-05-06 04:58:00', '2014-05-06 04:58:00'),
(4, 1, 18, 'B', '6.188', '2014-05-06 04:58:00', '2014-05-06 04:58:00'),
(5, 1, 19, 'B', '7.072', '2014-05-06 04:58:00', '2014-05-06 04:58:00'),
(6, 1, 20, 'B', '8.84', '2014-05-06 04:58:00', '2014-05-06 04:58:00'),
(7, 1, 21, 'B', '8.990', '2014-05-06 04:58:00', '2014-05-06 04:58:00'),
(8, 1, 22, 'B', '9.114', '2014-05-06 04:58:00', '2014-05-06 04:58:00'),
(9, 1, 23, 'B', '9,41', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
