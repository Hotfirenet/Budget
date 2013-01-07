-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 05 Novembre 2012 à 15:22
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `budget`
--

-- --------------------------------------------------------

--
-- Structure de la table `operations`
--

CREATE TABLE IF NOT EXISTS `operations` (
  `idOperation` int(11) NOT NULL AUTO_INCREMENT,
  `idCompte` int(11) NOT NULL,
  `motif` varchar(255) NOT NULL,
  `idCode` int(11) NOT NULL,
  `montant` decimal(9,2) NOT NULL,
  `releve` bit(1) NOT NULL,
  `dateOperation` datetime NOT NULL,
  `supprime` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`idOperation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `operations`
--

INSERT INTO `operations` (`idOperation`, `idCompte`, `motif`, `idCode`, `montant`, `releve`, `dateOperation`, `supprime`) VALUES
(1, 2, 'Versement ade', 7, '1000.00', b'0', '2012-11-02 00:00:00', b'0'),
(2, 2, 'versement djo', 7, '1400.00', b'0', '2012-10-27 00:00:00', b'0'),
(3, 1, 'Versement vie courante', 7, '-1400.00', b'0', '2012-10-27 00:00:00', b'0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
