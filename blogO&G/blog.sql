-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Feb 03, 2022 alle 08:47
-- Versione del server: 5.7.31
-- Versione PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `articles`
--

INSERT INTO `articles` (`id`, `article`, `id_utilisateur`, `id_categorie`, `date`) VALUES
(1, 'Lithium fields: Beautiful from the air, trouble on the ground. For geothermal fields around the world, produced geothermal brine has been simply injected back underground, but now it\'s become clear that the brines produced at the Salton Sea geothermal field contain an immense amount of lithium, a critical resource need for low-carbon transportation and energy storage. Demand for lithium is skyrocketing, as it is an essential ingredient in lithium-ion batteries. Researchers have recently published a comprehensive review of past and current technologies for extracting minerals from geothermal brine. ', 1, 1, '2022-01-29 05:20:56'),
(2, 'Jitter Recipes: Book 1, Recipes 0-12\r\nJitter Recipes: Book 1, Recipes 0-12\r\nSo, you\'ve finished the tutorials, you understand the basics of digital audio, and you can imagine using a jitter matrix for something. Perhaps you are looking for a couple of new recipes to expand your repertoire...\r\nThe following is a collection of simple examples that began as weekly posts to the Max mailing list. Here you will find some clever solutions, advanced trans-coding techniques, groovy audio/visual toys, and basic building blocks for more complex processing. The majority of these recipes are specific implementations of a more general patching concept. As with any collection of recipes, you will want to take these basic techniques and personalize them for your own uses. I encourage you to take them all apart, add in your own touches and make these your own.', 1, 2, '2022-01-29 05:20:57'),
(3, 'Trend Cemetery: Long Live Mugler. Welcome to Trend Cemetery, a new bi-weekly column where our Senior Editor Taylore Scarabelli tries to make sense of meaningless micro-trends, luxury fashion, and street style in the age of social media. This week, she mourns the loss of  Thierry Mugler, glamour, and André Leon Talley. \r\n\r\n———\r\n\r\nAs the late André Leon Talley once said, “It’s been a bleak streak over here in America…It’s a famine of beauty.” That was a quote from the 2009 documentary, The September Issue, but it lands in 2022—not only because of a supposed dearth of innovation on the runways and in our feeds—but because style, in the contemporary milieu, feels devoid of glamour. In 2022, the dominant silhouette is oversized, and the most common looks at fashion events mix bright colors and logos in the way advertisements at sporting arenas might. This is not to say that we are without ostentation in fashion, but rather that our collective fashion fantasy has more to do with looking bold than it does with character building or storytelling. Bucket hats and flight jackets rear their comfortable silhouettes season after season, only slightly altered to mirror trending colorways or particular brands. And though consumers seem to be growing tired of the dominant normcore-inspired fashion du-jour, we continue buying bigger boots and bags, all in the hopes of getting attention online, and off.', 1, 3, '2022-01-29 05:20:58'),
(4, 'The ‘surprisingly simple’ arithmetic of smell. Smell a cup of coffee.\r\n\r\nSmell it inside or outside; summer or winter; in a coffee shop with a scone; in a pizza parlor with pepperoni -- even at a pizza parlor with a scone! -- coffee smells like coffee.\r\n\r\nWhy don\'t other smells or different environmental factors \"get in the way,\" so to speak, of the experience of smelling individual odors? Researchers at the McKelvey School of Engineering at Washington University in St. Louis turned to their trusted research subject, the locust, to find out.\r\n\r\nWhat they found was \"surprisingly simple,\" according to Barani Raman, professor of biomedical engineering. Their results were published in the journal Proceedings of the National Academy of Sciences.\r\n\r\nRaman and colleagues have been working with locusts for years, watching their brains and their behaviors related to smell in an attempt to engineer bomb-sniffing locusts. Along the way, they\'ve made substantial gains when it comes to understanding the mechanisms at play when it comes to locusts\' sense of smell.', 1, 1, '2022-01-29 05:21:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(1, 'test comment n1 ', 1, 1, '2022-01-28 14:06:59'),
(2, 'test comment n1 ', 1, 1, '2022-01-28 14:06:59');

-- --------------------------------------------------------

--
-- Struttura della tabella `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'moderateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Struttura della tabella `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(1, 'nami', '1234', 'nami@nami.io', 1337);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
