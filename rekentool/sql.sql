-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 23 apr 2014 om 13:06
-- Serverversie: 5.5.33
-- PHP-versie: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databank: `rekentool`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `caos`
--

CREATE TABLE `caos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `caos`
--

INSERT INTO `caos` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Glas en Tuinbow', '2014-04-21 22:00:00', '2014-04-22 10:14:05');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `salaries`
--

CREATE TABLE `salaries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cao_id` int(11) NOT NULL,
  `age` int(2) NOT NULL,
  `category` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Gegevens worden uitgevoerd voor tabel `salaries`
--

INSERT INTO `salaries` (`id`, `cao_id`, `age`, `category`, `value`, `created_at`, `updated_at`) VALUES
(21, 1, 15, 'B', '3.536', '2014-04-17 06:53:53', '2014-04-22 10:18:15'),
(22, 1, 16, 'B', '4.42', '2014-04-17 06:53:53', '2014-04-22 10:18:15'),
(23, 1, 17, 'B', '5.304', '2014-04-17 06:53:53', '2014-04-22 10:18:15'),
(24, 1, 18, 'B', '7.072', '2014-04-17 06:53:53', '2014-04-22 10:18:15'),
(25, 1, 19, 'B', '7.956', '2014-04-17 06:53:53', '2014-04-22 10:18:15');
