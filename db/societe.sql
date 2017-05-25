-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 25 Mai 2017 à 11:38
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `deeveadee`
--

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE `societe` (
  `numS` int(11) NOT NULL,
  `nomS` varchar(45) DEFAULT NULL,
  `rueS` varchar(45) DEFAULT NULL,
  `villeS` varchar(45) DEFAULT NULL,
  `directeurS` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `societe`
--

INSERT INTO `societe` (`numS`, `nomS`, `rueS`, `villeS`, `directeurS`) VALUES
(1, 'DVD store 1', 'rue des chevaliers blancs', 'trifouillis les oies', 'Le roi arthur'),
(2, 'DVD store 2', 'rue de la peine perdue', 'schtroumpf village', 'Le grand schtroumpf'),
(3, 'DVD store 3', 'rue du bulot', 'crustacé sur mer', 'Poséidon'),
(4, 'DVD store 4', 'rue des nuages', 'village dans les nuages', 'Patanok');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`numS`),
  ADD UNIQUE KEY `numS_UNIQUE` (`numS`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `societe`
--
ALTER TABLE `societe`
  MODIFY `numS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
