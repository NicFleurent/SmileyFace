-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 22 Septembre 2023 à 14:43
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
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`id`, `nom`) VALUES
(1, 'Techniques de design d\'intérieur'),
(2, 'Techniques de la documentation'),
(3, 'Techniques d\'hygiène dentaire'),
(4, 'Techniques de diététique'),
(5, 'Techniques de soins infirmiers'),
(6, 'Techniques de soins infirmiers destiné aux infirmières auxiliaires'),
(7, 'Techniques de travail social'),
(8, 'Techniques d\'éducation à l\'enfance'),
(9, 'Techniques policières'),
(10, 'Techniques de génie mécanique'),
(11, 'Techniques de l\'informatique'),
(12, 'Techniques de l\'architecture'),
(13, 'Techniques de la mécanique du bâtiment (Génie du bâtiment)'),
(14, 'Techniques de la mécanique industrielle (maintenance)'),
(15, 'Techniques de génie civil'),
(16, 'Techniques de génie électrique - Automatisation et contrôle'),
(17, 'Techniques de génie électrique : Électrique programmable'),
(18, 'Techniques de génie industriel'),
(19, 'Techniques de génie métallurgique'),
(20, 'DEC-Bac en logistique'),
(21, 'DEC-Bac en marketing'),
(22, 'DEC-Bac en sciences comtables'),
(23, 'Gestion de commerces'),
(24, 'Gestion des opérations et de la chaine logistique'),
(25, 'Technique de comptabilité et de gestion'),
(26, 'Arts visuels'),
(27, 'Arts, lettres et communication - Théatre et création médias'),
(28, 'Musique'),
(29, 'Arts, lettres et communication - Langues'),
(30, 'Arts, lettres et communication - Littérature, arts et cinéma'),
(31, 'Histoire et civilisation'),
(32, 'Sciences de la nature'),
(33, 'Sciences humaines'),
(34, 'Sciences informatique et mathématiques'),
(35, 'Sciences, lettres et arts'),
(36, 'Sciences humaines avec préalables en mathématiques'),
(37, 'Tremplin DEC'),
(38, 'Aucun programme spécifique');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `lien` varchar(1500) NOT NULL,
  `departement` varchar(255) DEFAULT NULL,
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
(3, 'Test #3 3', '2023-10-02', 'https://lecampusti.ca/', 'Génie Mécanique', 'https://lecampusti.ca/wp-content/uploads/2021/09/Campus_TI_Logo-Final-tagline-01-01.png', 3, 1, 1, 3, 1, 1),
(44, 'Test Party noel', '2023-09-21', '', NULL, 'https://th.bing.com/th/id/OIP.R9unmoPwddPsQkMcptGOiwHaHa?pid=ImgDet&amp;rs=1', 0, 0, 0, 0, 0, 0),
(45, 'TEst demo', '2023-09-28', '', NULL, 'img/CTR_Logo_RVB.jpg', 0, 0, 0, 0, 0, 0),
(47, 'One piece Fest', '2023-09-15', '', NULL, 'https://i.pinimg.com/originals/03/7f/4b/037f4bfef599b4ffaae712f5f9709ccd.jpg', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `evenement_departement`
--

CREATE TABLE `evenement_departement` (
  `id` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Contenu de la table `evenement_departement`
--

INSERT INTO `evenement_departement` (`id`, `id_evenement`, `id_departement`) VALUES
(12, 45, 12),
(13, 45, 18),
(14, 44, 34),
(15, 44, 35),
(16, 44, 8),
(21, 1, 38),
(59, 3, 20),
(60, 3, 33),
(62, 47, 38);

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
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `evenement_departement`
--
ALTER TABLE `evenement_departement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_evenementDepartement_idEvenement` (`id_evenement`),
  ADD KEY `fk_evenementDepartement_idDepartement` (`id_departement`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table `evenement_departement`
--
ALTER TABLE `evenement_departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `evenement_departement`
--
ALTER TABLE `evenement_departement`
  ADD CONSTRAINT `fk_evenementDepartement_idDepartement` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id`),
  ADD CONSTRAINT `fk_evenementDepartement_idEvenement` FOREIGN KEY (`id_evenement`) REFERENCES `evenement` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
