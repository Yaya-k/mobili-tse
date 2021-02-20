-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  sam. 20 fév. 2021 à 20:23
-- Version du serveur :  5.7.28
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_mobilite`
--

-- --------------------------------------------------------

--
-- Structure de la table `demande_mobilite`
--

DROP TABLE IF EXISTS `demande_mobilite`;
CREATE TABLE IF NOT EXISTS `demande_mobilite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_personne` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `promo` varchar(255) DEFAULT NULL,
  `ville` varchar(255) NOT NULL,
  `statue` varchar(255) DEFAULT NULL,
  `pays` varchar(255) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `demande_mobilite`
--

INSERT INTO `demande_mobilite` (`id`, `id_personne`, `nom`, `promo`, `ville`, `statue`, `pays`, `date_debut`, `date_fin`, `date_creation`) VALUES
(29, 5, 'yaya', 'Fise3', 'Bruxelles', 'enCours', 'Belgique', '2021-01-25', '2021-05-21', '2021-01-25 12:19:47');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `promo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified` int(11) NOT NULL DEFAULT '0',
  `statue` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `promo`, `password`, `token`, `date`, `verified`, `statue`) VALUES
(5, 'yaya', 'Kamissokho', 'yaya.kamissokho@gmail.com', 'Fise3', '$2y$10$GPLG0tNvpEV5O/eDGlf6TeqYn7/nFlWAkj3YwiWz7.dxG/wioVEBi', 'dd79bd74b6c02d3daa79054da0a61174', '2020-11-25 22:04:01', 0, 1),
(8, 'nomAdmin', 'pronomAdmin', 'admin@dev.dev', 'Fise3', '$2y$10$wxVfvsQa3Se5q426nCfToOET2E2.gRo6MO2.nogrXQOsnq.d4p0Mu', 'be909d37c1766e2b6f9cdea3b512ce6e', '2021-02-20 13:58:56', 0, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
