-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 25 Novembre 2013 à 12:35
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
  `nextClipId` int(11) NOT NULL DEFAULT '0',
  `isLoop` tinyint(1) NOT NULL DEFAULT '1',
  `singleClip` tinyint(1) NOT NULL DEFAULT '1',
  `updated` tinyint(1) NOT NULL DEFAULT '0',
  `cliplayoutid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliplayoutid` (`cliplayoutid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `clip`
--

INSERT INTO `clip` (`id`, `clipname`, `clipdate`, `clipbackgroundcolor`, `clipDurationInSeconds`, `clipOrderNumber`, `nextClipId`, `isLoop`, `singleClip`, `updated`, `cliplayoutid`) VALUES
(1, 'Clip 1 Sidebars', '2013-11-07 10:46:32', '#93BFCC', 4, 1, 2, 1, 0, 0, 1),
(2, 'Clip 2 Sidebars', '2013-11-07 10:46:36', '#B6E3C8', 4, 1, 3, 1, 0, 0, 1),
(3, 'Clip 3 Sidebars', '2013-11-07 10:46:40', '#CCCCCC', 4, 1, 4, 1, 0, 0, 1),
(4, 'Clip 4 Left sidebar', '2013-11-07 10:46:44', '#CCCCCC', 4, 1, 5, 1, 0, 0, 2),
(5, 'Clip 5 Main area', '2013-11-12 10:40:43', '#668ED1', 4, 1, 0, 1, 1, 0, 3),
(6, 'Clip 6 Right sidebar', '2013-11-19 10:51:59', '#CCCCCC', 6, 1, 0, 1, 1, 0, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `section`
--

INSERT INTO `section` (`id`, `sectionname`, `sectioncode`, `sectiontypeid`, `clipid`) VALUES
(1, 'Clip 1 header', '<h4>Header 1</h4>', 1, 1),
(2, 'Clip 2 header', '<h4>Header 2</h4>', 1, 2),
(3, 'Left sidebar 1', '<h4>Left sidebar 1</h4>\r\n', 2, 1),
(4, 'Left sidebar 2', '<h4>Left sidebar 2</h4>\r\n', 2, 2),
(5, 'Main area 1', '<h1>Main area 1</h1>\n\n<div class="animated bounceInDown" style="-moz-animation-duration: 3s;  animation-delay: 1.5s; ">\n<p><img src="../../images/beach.jpg" style="height:267px; width:400px" /></p>\n</div>\n', 7, 1),
(6, 'Main area 2', '<h1>Main area 2</h1>\r\n', 7, 2),
(7, 'Right sidebar 1', '<h4>Right sidebar 1</h4>\r\n', 4, 1),
(8, 'Right sidebar 2', '<h4>Right sidebar 2</h4>\r\n', 4, 2),
(9, 'Footer 1', '<h4>Footer 1</h4>\r\n', 5, 1),
(10, 'Footer 2', '<h4>Footer 2</h4>\r\n', 5, 2),
(11, 'Clip 3 Header', '<h4>Header</h4>\r\n', 1, 3),
(12, 'Clip 3 Left sidebar', '<h4>Left sidebar</h4>\r\n', 2, 3),
(13, 'Clip 3 Main area 2 sidebars', '<h4>Main area with 2 sidebars</h4>\r\n', 7, 3),
(14, 'Clip 3 Right sidebar', '<h4>Right sidebar</h4>\r\n', 4, 3),
(15, 'Clip 3 Footer', '<h4>Footer</h4>\r\n', 5, 3),
(16, 'Clip 4 Header', '<h4>Header</h4>\r\n', 1, 4),
(17, 'Clip 4 Left sidebar', '<h4>Left sidebar&nbsp;Left sidebar&nbsp;Left sidebar&nbsp;Left sidebar&nbsp;Left sidebar&nbsp;Left sidebar&nbsp;Left sidebar&nbsp;Left sidebar&nbsp;Left sidebar&nbsp;</h4>\n', 2, 4),
(18, 'Clip 4 Main area 1 sidebar', '<h4>Main content area with 1&nbsp;sidebar</h4>\r\n', 6, 4),
(19, 'Clip 4 Footer', '<h4>Footer</h4>\r\n', 5, 4),
(20, 'Clip 5 Header', '<h4>Header</h4>\r\n', 1, 5),
(21, 'Clip 5 Main area', '<div style="font-size: 70%; ">\n<h4>Main content area</h4>\n</div>\n', 3, 5),
(22, 'Clip 5 Footer', '<h4>Footer</h4>\r\n', 5, 5),
(23, 'Clip 6 Header', '<h4>Header</h4>\r\n', 1, 6),
(24, 'Clip 6 Main area 1 sidebar', '<h4>Main content area with 1 sidebar</h4>\r\n', 6, 6),
(25, 'Clip 6 Right sidebar', '<h4>Right sidebar</h4>\r\n', 4, 6),
(26, 'Clip 6 Footer', '<h4>Footer</h4>\r\n', 5, 6);

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

-- --------------------------------------------------------

--
-- Structure de la table `sequence`
--

CREATE TABLE IF NOT EXISTS `sequence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sequencename` text NOT NULL,
  `sequencedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sequenceDurationInSeconds` int(11) NOT NULL DEFAULT '0',
  `isLoop` tinyint(1) NOT NULL DEFAULT '0',
  `sequenceupdated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `sequence`
--

INSERT INTO `sequence` (`id`, `sequencename`, `sequencedate`, `sequenceDurationInSeconds`, `isLoop`, `sequenceupdated`) VALUES
(1, 'Sequence 1', '2013-11-12 11:51:18', 0, 0, 0),
(2, 'Sequence 2', '2013-11-12 11:52:14', 0, 0, 0),
(3, 'Sequence 3', '2013-11-12 11:52:23', 0, 0, 0),
(4, 'Default Clip 1 Sequence', '2013-11-25 11:24:20', 0, 0, 0),
(5, 'Default Clip 2 Sequence', '2013-11-25 11:24:20', 0, 0, 0),
(6, 'Default Clip 3 Sequence', '2013-11-25 11:25:18', 0, 0, 0),
(7, 'Default Clip 4 Sequence', '2013-11-25 11:25:18', 0, 0, 0),
(8, 'Default Clip 5 Sequence', '2013-11-25 11:25:32', 0, 0, 0),
(9, 'Default Clip 6 Sequence', '2013-11-25 11:25:32', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sequenceclip`
--

CREATE TABLE IF NOT EXISTS `sequenceclip` (
  `sequenceid` int(11) NOT NULL,
  `clipid` int(11) NOT NULL,
  `nextClipId` int(11) NOT NULL DEFAULT '0',
  `clipOrderNumber` int(11) NOT NULL DEFAULT '1',
  KEY `sequenceid` (`sequenceid`),
  KEY `clipid` (`clipid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sequenceclip`
--

INSERT INTO `sequenceclip` (`sequenceid`, `clipid`, `nextClipId`, `clipOrderNumber`) VALUES
(1, 1, 2, 1),
(1, 2, 3, 2),
(1, 3, 4, 3),
(1, 4, 5, 4),
(1, 5, 0, 5),
(2, 2, 4, 1),
(2, 4, 0, 2),
(3, 1, 3, 1),
(3, 3, 5, 2),
(3, 5, 0, 3),
(4, 1, 0, 1),
(5, 2, 0, 1),
(6, 3, 0, 1),
(7, 4, 0, 1),
(8, 5, 0, 1),
(9, 6, 0, 1);

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

--
-- Contraintes pour la table `sequenceclip`
--
ALTER TABLE `sequenceclip`
  ADD CONSTRAINT `sequenceclip_ibfk_2` FOREIGN KEY (`clipid`) REFERENCES `clip` (`id`),
  ADD CONSTRAINT `sequenceclip_ibfk_1` FOREIGN KEY (`sequenceid`) REFERENCES `sequence` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
