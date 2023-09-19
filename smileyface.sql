-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 19 Septembre 2023 à 19:42
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `smileyface`
--

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `lien` varchar(1500) NOT NULL,
  `departement` varchar(255) NOT NULL,
  `image` varchar(1500) NOT NULL DEFAULT 'img/CTR_Logo_RVB.jpg',
  `etudiantSatisfait` int(11) NOT NULL DEFAULT '0',
  `etudiantNeutre` int(11) NOT NULL DEFAULT '0',
  `etudiantInsatisfait` int(11) NOT NULL DEFAULT '0',
  `employeurSatisfait` int(11) NOT NULL DEFAULT '0',
  `employeurNeutre` int(11) NOT NULL DEFAULT '0',
  `employeurInsatisfait` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`id`, `nom`, `date`, `lien`, `departement`, `image`, `etudiantSatisfait`, `etudiantNeutre`, `etudiantInsatisfait`, `employeurSatisfait`, `employeurNeutre`, `employeurInsatisfait`) VALUES
(1, 'Event test', '2023-11-05', 'https://lecampusti.ca/', 'Informatique', 'img/CTR_Logo_RVB.jpg', 63, 47, 56, 10, 5, 2),
(2, 'Test #2', '2023-09-29', 'https://lecampusti.ca/', 'Technique de l\'informatique', 'img/CTR_Logo_RVB.jpg', 0, 0, 0, 0, 0, 0),
(3, 'Test #3', '2023-10-02', 'https://lecampusti.ca/', 'Génie Mécanique', 'https://lecampusti.ca/wp-content/uploads/2021/09/Campus_TI_Logo-Final-tagline-01-01.png', 1, 0, 0, 0, 0, 0),
(4, 'Test less valid', '2023-09-22', '', '', 'img/CTR_Logo_RVB.jpg', 0, 1, 0, 0, 0, 0),
(7, 'test final', '2023-09-18', '', '', 'img/CTR_Logo_RVB.jpg', 0, 0, 0, 0, 0, 0),
(8, 'test final 2', '2023-09-18', '', '', 'img/CTR_Logo_RVB.jpg', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `usager` varchar(255) NOT NULL,
  `mot_de_passe` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `usager`, `mot_de_passe`) VALUES
(1, 'anick.bruneau', '71a4236acaaa09fa969570ae1368114faa96ede5'),
(2, 'shany.carle', 'b791ab2342bfc0302af3dd566649ef5d51c95930'),
(3, 'admin', '5e290a2a157c9779ba4c84b5aa72e114cc74d0e4');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
