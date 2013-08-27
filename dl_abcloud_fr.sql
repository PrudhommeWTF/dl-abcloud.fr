-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 13 Août 2013 à 23:45
-- Version du serveur: 5.6.12
-- Version de PHP: 5.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `dl.abcloud.fr`
--
CREATE DATABASE IF NOT EXISTS `dl.abcloud.fr` DEFAULT CHARACTER SET ascii COLLATE ascii_bin;
USE `dl.abcloud.fr`;

-- --------------------------------------------------------

--
-- Structure de la table `dl_documents`
--

DROP TABLE IF EXISTS `dl_documents`;
CREATE TABLE IF NOT EXISTS `dl_documents` (
  `idDoc` int(11) NOT NULL AUTO_INCREMENT,
  `docOwner` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `docACL` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `docSize` int(11) DEFAULT NULL,
  `docType` mediumtext CHARACTER SET utf8 COLLATE utf8_bin,
  PRIMARY KEY (`idDoc`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `dl_folders`
--

DROP TABLE IF EXISTS `dl_folders`;
CREATE TABLE IF NOT EXISTS `dl_folders` (
  `idFolder` int(11) NOT NULL AUTO_INCREMENT,
  `folderName` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `folderOwner` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `folderACL` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  PRIMARY KEY (`idFolder`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `dl_users`
--

DROP TABLE IF EXISTS `dl_users`;
CREATE TABLE IF NOT EXISTS `dl_users` (
  `idUser` int(10) NOT NULL AUTO_INCREMENT,
  `userMail` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `userPwd` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `userUID` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `userFName` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `userSName` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `userDirectory` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=9 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
