-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 30 Octobre 2013 à 16:41
-- Version du serveur: 5.5.34-0ubuntu0.13.04.1-log
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
  `clipdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `clipbackgroundcolor` text NOT NULL,
  `clipDurationInSeconds` int(11) NOT NULL DEFAULT '4',
  `clipOrderNumber` int(11) NOT NULL DEFAULT '1',
  `isLoop` tinyint(1) NOT NULL DEFAULT '1',
  `singleClip` tinyint(1) NOT NULL DEFAULT '1',
  `cliplayoutid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliplayoutid` (`cliplayoutid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `clip`
--

INSERT INTO `clip` (`id`, `clipname`, `clipdate`, `clipbackgroundcolor`, `clipDurationInSeconds`, `clipOrderNumber`, `isLoop`, `singleClip`, `cliplayoutid`) VALUES
(1, 'Clip 1 Sidebars', '2013-10-22 11:22:05', '#CCCCCC', 4, 1, 1, 1, 1),
(2, 'Clip 2 Sidebars', '2013-10-22 11:37:33', '#C3E3D3', 4, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cliplayout`
--

CREATE TABLE IF NOT EXISTS `cliplayout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliplayoutname` text NOT NULL,
  `cliplayoutcssref` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `cliplayout`
--

INSERT INTO `cliplayout` (`id`, `cliplayoutname`, `cliplayoutcssref`) VALUES
(1, '2 Sidebars', '<link rel="stylesheet" href="../../css/layout_sidebars_1920.css">'),
(2, 'Left sidebar', '<link rel="stylesheet" href="../../css/layout_leftsidebar_1920.css">'),
(3, 'Main area', '<link rel="stylesheet" href="../../css/layout_full_1920.css">'),
(4, 'Right sidebar', '<link rel="stylesheet" href="../../css/layout_rightsidebar_1920.css">');

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sectionname` text NOT NULL,
  `sectioncode` text NOT NULL,
  `sectiontypeid` int(11) NOT NULL,
  `clipid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clipid` (`clipid`),
  KEY `sectiontypeid` (`sectiontypeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `section`
--

INSERT INTO `section` (`id`, `sectionname`, `sectioncode`, `sectiontypeid`, `clipid`) VALUES
(1, 'Clip 1 header', '<h4>Header 1</h4>', 1, 1),
(2, 'Clip 2 header', '<h4>Header 2</h4>', 1, 2),
(3, 'Left sidebar 1', '<h4>Left sidebar 1</h4>', 2, 1),
(4, 'Left sidebar 2', '<h4>Left sidebar 2</h4>', 2, 2),
(5, 'Main area 1', '<h1>Main area 1</h1>\r\n<img src=''../../images/beach.jpg'' width=''400'' height=''267''/>', 7, 1),
(6, 'Main area 2', '<h1>Main area 2</h1>', 7, 2),
(7, 'Right sidebar 1', '<h4>Right sidebar 1</h4>', 4, 1),
(8, 'Right sidebar 2', '<h4>Right sidebar 2</h4>', 4, 2),
(9, 'Footer 1', '<h4>Footer 1</h4>', 5, 1),
(10, 'Footer 2', '<h4>Footer 2</h4>', 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `sectiontype`
--

CREATE TABLE IF NOT EXISTS `sectiontype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sectiontypewidth` text NOT NULL,
  `sectiontypename` text NOT NULL,
  `sectiontypecode` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `sectiontype`
--

INSERT INTO `sectiontype` (`id`, `sectiontypewidth`, `sectiontypename`, `sectiontypecode`) VALUES
(1, 'sixteen columns', 'Header', '<h4>Header</h4>'),
(2, 'three columns', 'Left sidebar', '<h4>Left sidebar</h4>'),
(3, 'sixteen columns', 'Main area', '<h4>Main content area</h4>'),
(4, 'three columns', 'Right sidebar', '<h4>Right sidebar</h4>'),
(5, 'sixteen columns', 'Footer', '<h4>Footer</h4>'),
(6, 'thirteen columns', 'Main area 1 sidebar', '<h4>Main content area with 1 sidebar</h4>'),
(7, 'ten columns', 'Main area 2 sidebars', '<h4>Main content area with 2 sidebars</h4>');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `clip`
--
ALTER TABLE `clip`
  ADD CONSTRAINT `clip_ibfk_1` FOREIGN KEY (`cliplayoutid`) REFERENCES `cliplayout` (`id`),
  ADD CONSTRAINT `clip_ibfk_2` FOREIGN KEY (`cliplayoutid`) REFERENCES `cliplayout` (`id`);

--
-- Contraintes pour la table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`clipid`) REFERENCES `clip` (`id`),
  ADD CONSTRAINT `section_ibfk_2` FOREIGN KEY (`clipid`) REFERENCES `clip` (`id`),
  ADD CONSTRAINT `section_ibfk_3` FOREIGN KEY (`sectiontypeid`) REFERENCES `sectiontype` (`id`),
  ADD CONSTRAINT `section_ibfk_4` FOREIGN KEY (`sectiontypeid`) REFERENCES `sectiontype` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
