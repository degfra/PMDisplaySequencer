-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 26 Septembre 2013 à 15:10
-- Version du serveur: 5.5.32-0ubuntu0.13.04.1-log
-- Version de PHP: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `pmdisplayseqdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `clip`
--

CREATE TABLE IF NOT EXISTS `clip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clipname` text NOT NULL,
  `clipcode` text NOT NULL,
  `clipdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `clip`
--

INSERT INTO `clip` (`id`, `clipname`, `clipcode`, `clipdate`) VALUES
(1, 'Test clip 1', '               <?php echo $header ?>\n                <br>\n                <br>\n                <br>\n                <br>\n                <div>Contenu du Clip 1</div>\n                <br>\n                <br>\n                <br>\n                <br>\n                <?php echo $footer ?>', '2013-09-11 06:27:22'),
(2, 'Test clip 2', '                <?php $header ?>\r\n                <br>\r\n                <br>\r\n                <br>\r\n                <br>\r\n                <div>Contenu du Clip 2</div>\r\n                <br>\r\n                <br>\r\n                <br>\r\n                <br>\r\n                <?php $footer ?>\r\n', '2013-09-11 14:36:14');

-- --------------------------------------------------------

--
-- Structure de la table `footer`
--

CREATE TABLE IF NOT EXISTS `footer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `footername` text CHARACTER SET utf8 NOT NULL,
  `footercode` text CHARACTER SET utf8 NOT NULL,
  `clipid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clipid` (`clipid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `footer`
--

INSERT INTO `footer` (`id`, `footername`, `footercode`, `clipid`) VALUES
(1, 'footer1', '<h3>Footer1</h3>', 1),
(2, 'footer2', '<h3>Footer2</h3>', 2);

-- --------------------------------------------------------

--
-- Structure de la table `header`
--

CREATE TABLE IF NOT EXISTS `header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headername` text NOT NULL,
  `headercode` text NOT NULL,
  `clipid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clipid` (`clipid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `header`
--

INSERT INTO `header` (`id`, `headername`, `headercode`, `clipid`) VALUES
(1, 'header 1', '<h1>Header 1</h1>', 1),
(2, 'Header 2', '<h1>Header 2</h1>', 2);

-- --------------------------------------------------------

--
-- Structure de la table `leftbar`
--

CREATE TABLE IF NOT EXISTS `leftbar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leftbarname` text NOT NULL,
  `leftbarcode` text NOT NULL,
  `clipid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `rightbar`
--

CREATE TABLE IF NOT EXISTS `rightbar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rightbaname` text NOT NULL,
  `rightbacode` text NOT NULL,
  `clipid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `footer`
--
ALTER TABLE `footer`
  ADD CONSTRAINT `footer_ibfk_2` FOREIGN KEY (`clipid`) REFERENCES `clip` (`id`);

--
-- Contraintes pour la table `header`
--
ALTER TABLE `header`
  ADD CONSTRAINT `header_ibfk_2` FOREIGN KEY (`clipid`) REFERENCES `clip` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
