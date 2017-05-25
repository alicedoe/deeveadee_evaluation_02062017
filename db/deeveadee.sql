-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 25 Mai 2017 à 11:35
-- Version du serveur :  5.7.18-0ubuntu0.17.04.1
-- Version de PHP :  7.0.18-0ubuntu0.17.04.1

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
-- Structure de la table `acteur`
--

CREATE TABLE `acteur` (
  `numA` int(11) NOT NULL,
  `nomA` varchar(45) DEFAULT NULL,
  `prénomA` varchar(45) DEFAULT NULL,
  `ageA` date DEFAULT NULL,
  `sexeA` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `casting`
--

CREATE TABLE `casting` (
  `dvdC` int(11) NOT NULL,
  `acteurC` int(11) DEFAULT NULL,
  `roleC` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `numG` int(11) NOT NULL,
  `nomG` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dvd`
--

CREATE TABLE `dvd` (
  `numD` int(11) NOT NULL,
  `titreD` varchar(45) DEFAULT NULL,
  `auteurD` varchar(45) DEFAULT NULL,
  `annéeD` date DEFAULT NULL,
  `catégorieD` int(11) DEFAULT NULL,
  `dateAchatD` date DEFAULT NULL,
  `nombreD` int(11) DEFAULT NULL,
  `consultationsD` int(11) NOT NULL,
  `commentairesD` int(11) NOT NULL,
  `sociétéD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE `emprunt` (
  `dvdE` int(11) NOT NULL,
  `dateE` date DEFAULT NULL,
  `clientE` date DEFAULT NULL,
  `dureeE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notesN`
--

CREATE TABLE `notesN` (
  `numN` int(11) NOT NULL,
  `dvdN` int(11) NOT NULL,
  `noteN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `remarques`
--

CREATE TABLE `remarques` (
  `numR` int(11) NOT NULL,
  `commentairesR` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `société`
--

CREATE TABLE `société` (
  `numS` int(11) NOT NULL,
  `nomS` varchar(45) DEFAULT NULL,
  `rueS` varchar(45) DEFAULT NULL,
  `villeS` varchar(45) DEFAULT NULL,
  `directeurS` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acteur`
--
ALTER TABLE `acteur`
  ADD PRIMARY KEY (`numA`);

--
-- Index pour la table `casting`
--
ALTER TABLE `casting`
  ADD PRIMARY KEY (`dvdC`),
  ADD KEY `acteurC` (`acteurC`),
  ADD KEY `dvdC` (`dvdC`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`numG`);

--
-- Index pour la table `dvd`
--
ALTER TABLE `dvd`
  ADD PRIMARY KEY (`numD`),
  ADD UNIQUE KEY `numD_UNIQUE` (`numD`),
  ADD KEY `sociétéD` (`sociétéD`),
  ADD KEY `catégorieD` (`catégorieD`),
  ADD KEY `commentairesD` (`commentairesD`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`dvdE`),
  ADD UNIQUE KEY `dvdE_UNIQUE` (`dvdE`);

--
-- Index pour la table `notesN`
--
ALTER TABLE `notesN`
  ADD PRIMARY KEY (`numN`),
  ADD KEY `dvdN` (`dvdN`);

--
-- Index pour la table `remarques`
--
ALTER TABLE `remarques`
  ADD PRIMARY KEY (`numR`);

--
-- Index pour la table `société`
--
ALTER TABLE `société`
  ADD PRIMARY KEY (`numS`),
  ADD UNIQUE KEY `numS_UNIQUE` (`numS`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `acteur`
--
ALTER TABLE `acteur`
  MODIFY `numA` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `casting`
--
ALTER TABLE `casting`
  MODIFY `dvdC` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `numG` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `dvd`
--
ALTER TABLE `dvd`
  MODIFY `numD` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `dvdE` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `notesN`
--
ALTER TABLE `notesN`
  MODIFY `numN` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `remarques`
--
ALTER TABLE `remarques`
  MODIFY `numR` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `société`
--
ALTER TABLE `société`
  MODIFY `numS` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `casting`
--
ALTER TABLE `casting`
  ADD CONSTRAINT `casting_ibfk_1` FOREIGN KEY (`acteurC`) REFERENCES `acteur` (`numA`),
  ADD CONSTRAINT `casting_ibfk_2` FOREIGN KEY (`dvdC`) REFERENCES `dvd` (`numD`);

--
-- Contraintes pour la table `dvd`
--
ALTER TABLE `dvd`
  ADD CONSTRAINT `dvd_ibfk_1` FOREIGN KEY (`sociétéD`) REFERENCES `société` (`numS`),
  ADD CONSTRAINT `dvd_ibfk_2` FOREIGN KEY (`catégorieD`) REFERENCES `categories` (`numG`),
  ADD CONSTRAINT `dvd_ibfk_3` FOREIGN KEY (`commentairesD`) REFERENCES `remarques` (`numR`);

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`dvdE`) REFERENCES `dvd` (`numD`);

--
-- Contraintes pour la table `notesN`
--
ALTER TABLE `notesN`
  ADD CONSTRAINT `notesN_ibfk_1` FOREIGN KEY (`dvdN`) REFERENCES `dvd` (`numD`);

--
-- Contraintes pour la table `société`
--
ALTER TABLE `société`
  ADD CONSTRAINT `société_ibfk_1` FOREIGN KEY (`numS`) REFERENCES `dvd` (`sociétéD`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
