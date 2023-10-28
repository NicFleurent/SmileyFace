-- Adminer 4.8.1 MySQL 8.0.18 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `departement`;
CREATE TABLE `departement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

INSERT INTO `departement` (`id`, `nom`) VALUES
(1,	'Techniques de design d\'intérieur'),
(2,	'Techniques de la documentation'),
(3,	'Techniques d\'hygiène dentaire'),
(4,	'Techniques de diététique'),
(5,	'Techniques de soins infirmiers'),
(6,	'Techniques de soins infirmiers destiné aux infirmières auxiliaires'),
(7,	'Techniques de travail social'),
(8,	'Techniques d\'éducation à l\'enfance'),
(9,	'Techniques policières'),
(10,	'Techniques de génie mécanique'),
(11,	'Techniques de l\'informatique'),
(12,	'Techniques de l\'architecture'),
(13,	'Techniques de la mécanique du bâtiment (Génie du bâtiment)'),
(14,	'Techniques de la mécanique industrielle (maintenance)'),
(15,	'Techniques de génie civil'),
(16,	'Techniques de génie électrique - Automatisation et contrôle'),
(17,	'Techniques de génie électrique : Électrique programmable'),
(18,	'Techniques de génie industriel'),
(19,	'Techniques de génie métallurgique'),
(20,	'DEC-Bac en logistique'),
(21,	'DEC-Bac en marketing'),
(22,	'DEC-Bac en sciences comtables'),
(23,	'Gestion de commerces'),
(24,	'Gestion des opérations et de la chaine logistique'),
(25,	'Technique de comptabilité et de gestion'),
(26,	'Arts visuels'),
(27,	'Arts, lettres et communication - Théatre et création médias'),
(28,	'Musique'),
(29,	'Arts, lettres et communication - Langues'),
(30,	'Arts, lettres et communication - Littérature, arts et cinéma'),
(31,	'Histoire et civilisation'),
(32,	'Sciences de la nature'),
(33,	'Sciences humaines'),
(34,	'Sciences informatique et mathématiques'),
(35,	'Sciences, lettres et arts'),
(36,	'Sciences humaines avec préalables en mathématiques'),
(37,	'Tremplin DEC'),
(38,	'Aucun programme spécifique');

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `lien` varchar(1500) NOT NULL,
  `image` varchar(1500) NOT NULL DEFAULT 'img/CTR_Logo_RVB.jpg',
  `etudiantSatisfait` int(11) NOT NULL DEFAULT '0',
  `etudiantNeutre` int(11) NOT NULL DEFAULT '0',
  `etudiantInsatisfait` int(11) NOT NULL DEFAULT '0',
  `employeurSatisfait` int(11) NOT NULL DEFAULT '0',
  `employeurNeutre` int(11) NOT NULL DEFAULT '0',
  `employeurInsatisfait` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

INSERT INTO `evenement` (`id`, `nom`, `date`, `lien`, `image`, `etudiantSatisfait`, `etudiantNeutre`, `etudiantInsatisfait`, `employeurSatisfait`, `employeurNeutre`, `employeurInsatisfait`) VALUES
(1,	'Visite Hydro-Québec',	'2023-09-28',	'https://emploi.hydroquebec.com/',	'https://th.bing.com/th/id/OIP.mdwpzTfcQi_CobjgCywkIAHaFC?pid=ImgDet&amp;rs=1',	65,	49,	58,	10,	5,	2),
(3,	'Pizza Stage Campus TI',	'2023-10-02',	'https://lecampusti.ca/',	'https://lecampusti.ca/wp-content/uploads/2021/09/Campus_TI_Logo-Final-tagline-01-01.png',	7,	2,	3,	3,	1,	1),
(44,	'Party Noël',	'2022-12-09',	'',	'https://th.bing.com/th/id/OIP.R9unmoPwddPsQkMcptGOiwHaHa?pid=ImgDet&amp;rs=1',	2,	2,	2,	2,	1,	1),
(66,	'Fête à Shany',	'2023-10-09',	'https://www.starwars.com/',	'https://i.pinimg.com/originals/a8/21/42/a82142476bed09602170ea4a573a5281.jpg',	1,	1,	1,	1,	0,	0),
(69,	'Pizza Stage 2023',	'2023-10-13',	'',	'img/CTR_Logo_RVB.jpg',	1,	1,	0,	0,	0,	0);

DROP TABLE IF EXISTS `evenement_departement`;
CREATE TABLE `evenement_departement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evenement` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evenementDepartement_idEvenement` (`id_evenement`),
  KEY `fk_evenementDepartement_idDepartement` (`id_departement`),
  CONSTRAINT `fk_evenementDepartement_idDepartement` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id`),
  CONSTRAINT `fk_evenementDepartement_idEvenement` FOREIGN KEY (`id_evenement`) REFERENCES `evenement` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

INSERT INTO `evenement_departement` (`id`, `id_evenement`, `id_departement`) VALUES
(120,	3,	11),
(121,	3,	34),
(123,	44,	38),
(124,	1,	38),
(137,	66,	11),
(138,	66,	34),
(139,	66,	36),
(144,	69,	33),
(145,	69,	36);

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usager` varchar(255) NOT NULL,
  `mot_de_passe` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

INSERT INTO `utilisateur` (`id`, `usager`, `mot_de_passe`) VALUES
(1,	'anick.bruneau@cegeptr.qc.ca',	'cfe74471cf92dca8d43434de643293798682e4b1'),
(2,	'shany.carle@cegeptr.qc.ca',	'cfe74471cf92dca8d43434de643293798682e4b1'),
(3,	'admin',	'31f4fda73e3c95d4d298e05b9d5b08df2971b655');

-- 2023-10-18 21:36:01