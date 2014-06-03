-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Gegenereerd op: 03 jun 2014 om 14:24
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
  `wage` float(8,2) NOT NULL,
  `duration` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `caos`
--

INSERT INTO `caos` (`id`, `name`, `wage`, `duration`) VALUES
(1, 'Glas en Tuinbouw', 9.42, 38),
(2, 'Metaalbewerking', 8.22, 38),
(3, 'Transport', 0.00, 40);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `caos_steps`
--

CREATE TABLE IF NOT EXISTS `caos_steps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cao_id` int(10) unsigned NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `percent` float(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `caos_steps`
--

INSERT INTO `caos_steps` (`id`, `cao_id`, `category`, `percent`) VALUES
(1, 1, 'B2', 1.06),
(2, 1, 'C', 1.24),
(3, 1, 'D', 1.32),
(4, 1, 'E', 1.38),
(5, 1, 'F', 1.45),
(6, 1, 'G', 1.51),
(7, 1, 'H', 1.56);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `caos_wage`
--

CREATE TABLE IF NOT EXISTS `caos_wage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cao_id` int(10) unsigned NOT NULL,
  `age` int(10) unsigned NOT NULL,
  `percent` float(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Gegevens worden uitgevoerd voor tabel `caos_wage`
--

INSERT INTO `caos_wage` (`id`, `cao_id`, `age`, `percent`) VALUES
(1, 1, 15, 0.40),
(2, 1, 16, 0.50),
(3, 1, 17, 0.60),
(4, 1, 18, 0.70),
(5, 1, 19, 0.80),
(6, 1, 20, 0.90);

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
('2014_04_24_090754_new_salaries', 3),
('2014_06_02_102243_new_database_structure_new_cao', 4),
('2014_06_02_103025_new_database_structure_caos_wage', 4),
('2014_06_02_103215_new_database_structure_caos_steps', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
