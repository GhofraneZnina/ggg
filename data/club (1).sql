-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:4306
-- Généré le : dim. 07 mai 2023 à 11:40
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `club`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `categorie_age` varchar(255) NOT NULL,
  `minimas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `intitule`, `categorie_age`, `minimas_id`) VALUES
(7, 'Poussins', '10-11', NULL),
(8, 'Benjamins', '12-13', NULL),
(9, 'Minimes', '14-15', NULL),
(10, 'Cadets', '16-17', NULL),
(11, 'TC', '18+', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `competition`
--

CREATE TABLE `competition` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `minimas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `competition`
--

INSERT INTO `competition` (`id`, `intitule`, `date_debut`, `date_fin`, `minimas_id`) VALUES
(7, 'pp', '2023-04-04', '2023-09-09', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cotisation_annuelle`
--

CREATE TABLE `cotisation_annuelle` (
  `id` int(11) NOT NULL,
  `nageur_id` int(11) DEFAULT NULL,
  `montant` double NOT NULL,
  `statut_paiement` tinyint(1) NOT NULL,
  `remarque` varchar(255) NOT NULL,
  `saison_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cotisation_annuelle`
--

INSERT INTO `cotisation_annuelle` (`id`, `nageur_id`, `montant`, `statut_paiement`, `remarque`, `saison_id`) VALUES
(1, 38, 150, 0, '5aales', 2),
(3, 31, 250, 0, '5aales', 2);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entraineur`
--

CREATE TABLE `entraineur` (
  `id` int(11) NOT NULL,
  `date_naissance` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entraineur`
--

INSERT INTO `entraineur` (`id`, `date_naissance`, `description`, `photo`) VALUES
(4, '2018-01-01', 'kkkkkk', 'kkkkkkkkkkkk'),
(5, '2018-01-01', 'kkkkkk', 'kkkkkkkkkkkk'),
(7, '2018-07-08', 'dez', 'sdsqdq'),
(18, '2018-01-01', 'fffffff', 'ffffffffz'),
(19, '2018-01-01', 'ddd', 'ddd'),
(24, '2018-01-01', 'ttt', 'ttt'),
(29, '2023-03-19', 'kkkkkk fff', 'ddd'),
(30, '2023-03-21', 'thtrg', 'ffffffffz');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `entraineur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `intitule`, `entraineur_id`) VALUES
(1, 'test', 4),
(2, 'ccbbg', 5),
(4, 'les champions', 7),
(5, 'rrrr', 4),
(6, 'aaaa', 5),
(7, 'eee', 7),
(8, 'hhhh', 4),
(9, 'uuuuuuuuuuuu', 5);

-- --------------------------------------------------------

--
-- Structure de la table `lieu_entrainement`
--

CREATE TABLE `lieu_entrainement` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type_picine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `lieu_entrainement`
--

INSERT INTO `lieu_entrainement` (`id`, `intitule`, `description`, `type_picine`) VALUES
(1, 'manzah', 'piscine picinr', 'autre'),
(2, 'rades', 'piscine', 'p50'),
(3, 'benzart', 'piscine', 'p25m');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `minimas`
--

CREATE TABLE `minimas` (
  `id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `chrono` varchar(255) NOT NULL,
  `type_minimas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nage`
--

CREATE TABLE `nage` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `minimas_id` int(11) DEFAULT NULL,
  `programme_competition_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `nage`
--

INSERT INTO `nage` (`id`, `label`, `status`, `minimas_id`, `programme_competition_id`) VALUES
(1, 'CRAWL-50', '1', NULL, NULL),
(2, 'CRAWL-100', '1', NULL, NULL),
(3, 'CRAWL-200', '1', NULL, NULL),
(4, 'CRAWL-400', '1', NULL, NULL),
(5, 'CRAWL-800', '1', NULL, NULL),
(6, 'CRAWL-1500', '1', NULL, NULL),
(7, 'CRAWL-4*100', '1', NULL, NULL),
(8, 'CRAWL-4*50', '1', NULL, NULL),
(9, 'CRAWL-4*200', '1', NULL, NULL),
(10, 'CRAWL-4*400', '1', NULL, NULL),
(11, 'CRAWL-4*800', '1', NULL, NULL),
(12, 'CRAWL-4*1500', '1', NULL, NULL),
(13, 'CRAWL-10*50', '1', NULL, NULL),
(14, 'CRAWL-10*100', '1', NULL, NULL),
(15, 'CRAWL-10*200', '1', NULL, NULL),
(16, 'CRAWL-10*400', '1', NULL, NULL),
(17, 'CRAWL-10*800', '1', NULL, NULL),
(18, 'CRAWL-10*1500', '1', NULL, NULL),
(19, 'PAP-50', '1', NULL, NULL),
(20, 'PAP-100', '1', NULL, NULL),
(21, 'PAP-200', '1', NULL, NULL),
(22, 'PAP-400', '1', NULL, NULL),
(23, 'PAP-800', '1', NULL, NULL),
(24, 'PAP-1500', '1', NULL, NULL),
(25, 'PAP-4*100', '1', NULL, NULL),
(26, 'PAP-4*50', '1', NULL, NULL),
(27, 'PAP-4*200', '1', NULL, NULL),
(28, 'PAP-4*400', '1', NULL, NULL),
(29, 'PAP-4*800', '1', NULL, NULL),
(30, 'PAP-4*1500', '1', NULL, NULL),
(31, 'PAP-10*50', '1', NULL, NULL),
(32, 'PAP-10*100', '1', NULL, NULL),
(33, 'PAP-10*200', '1', NULL, NULL),
(34, 'PAP-10*400', '1', NULL, NULL),
(35, 'PAP-10*800', '1', NULL, NULL),
(36, 'PAP-10*1500', '1', NULL, NULL),
(37, 'NL-50', '1', NULL, NULL),
(38, 'NL-100', '1', NULL, NULL),
(39, 'NL-200', '1', NULL, NULL),
(40, 'NL-400', '1', NULL, NULL),
(41, 'NL-800', '1', NULL, NULL),
(42, 'NL-1500', '1', NULL, NULL),
(43, 'NL-4*100', '1', NULL, NULL),
(44, 'NL-4*50', '1', NULL, NULL),
(45, 'NL-4*200', '1', NULL, NULL),
(46, 'NL-4*400', '1', NULL, NULL),
(47, 'NL-4*800', '1', NULL, NULL),
(48, 'NL-4*1500', '1', NULL, NULL),
(49, 'NL-10*50', '1', NULL, NULL),
(50, 'NL-10*100', '1', NULL, NULL),
(51, 'NL-10*200', '1', NULL, NULL),
(52, 'NL-10*400', '1', NULL, NULL),
(53, 'NL-10*800', '1', NULL, NULL),
(54, 'NL-10*1500', '1', NULL, NULL),
(55, 'DOS-50', '1', NULL, NULL),
(56, 'DOS-100', '1', NULL, NULL),
(57, 'DOS-200', '1', NULL, NULL),
(58, 'DOS-400', '1', NULL, NULL),
(59, 'DOS-800', '1', NULL, NULL),
(60, 'DOS-1500', '1', NULL, NULL),
(61, 'DOS-4*100', '1', NULL, NULL),
(62, 'DOS-4*50', '1', NULL, NULL),
(63, 'DOS-4*200', '1', NULL, NULL),
(64, 'DOS-4*400', '1', NULL, NULL),
(65, 'DOS-4*800', '1', NULL, NULL),
(66, 'DOS-4*1500', '1', NULL, NULL),
(67, 'DOS-10*50', '1', NULL, NULL),
(68, 'DOS-10*100', '1', NULL, NULL),
(69, 'DOS-10*200', '1', NULL, NULL),
(70, 'DOS-10*400', '1', NULL, NULL),
(71, 'DOS-10*800', '1', NULL, NULL),
(72, 'DOS-10*1500', '1', NULL, NULL),
(73, 'BR-50', '1', NULL, NULL),
(74, 'BR-100', '1', NULL, NULL),
(75, 'BR-200', '1', NULL, NULL),
(76, 'BR-400', '1', NULL, NULL),
(77, 'BR-800', '1', NULL, NULL),
(78, 'BR-1500', '1', NULL, NULL),
(79, 'BR-4*100', '1', NULL, NULL),
(80, 'BR-4*50', '1', NULL, NULL),
(81, 'BR-4*200', '1', NULL, NULL),
(82, 'BR-4*400', '1', NULL, NULL),
(83, 'BR-4*800', '1', NULL, NULL),
(84, 'BR-4*1500', '1', NULL, NULL),
(85, 'BR-10*50', '1', NULL, NULL),
(86, 'BR-10*100', '1', NULL, NULL),
(87, 'BR-10*200', '1', NULL, NULL),
(88, 'BR-10*400', '1', NULL, NULL),
(89, 'BR-10*800', '1', NULL, NULL),
(90, 'BR-10*1500', '1', NULL, NULL),
(91, 'N-50', '1', NULL, NULL),
(92, 'N-100', '1', NULL, NULL),
(93, 'N-200', '1', NULL, NULL),
(94, 'N-400', '1', NULL, NULL),
(95, 'N-800', '1', NULL, NULL),
(96, 'N-1500', '1', NULL, NULL),
(97, 'N-4*100', '1', NULL, NULL),
(98, 'N-4*50', '1', NULL, NULL),
(99, 'N-4*200', '1', NULL, NULL),
(100, 'N-4*400', '1', NULL, NULL),
(101, 'N-4*800', '1', NULL, NULL),
(102, 'N-4*1500', '1', NULL, NULL),
(103, 'N-10*50', '1', NULL, NULL),
(104, 'N-10*100', '1', NULL, NULL),
(105, 'N-10*200', '1', NULL, NULL),
(106, 'N-10*400', '1', NULL, NULL),
(107, 'N-10*800', '1', NULL, NULL),
(108, 'N-10*1500', '1', NULL, NULL),
(109, 'NL MIX-50', '1', NULL, NULL),
(110, 'NL MIX-100', '1', NULL, NULL),
(111, 'NL MIX-200', '1', NULL, NULL),
(112, 'NL MIX-400', '1', NULL, NULL),
(113, 'NL MIX-800', '1', NULL, NULL),
(114, 'NL MIX-1500', '1', NULL, NULL),
(115, 'NL MIX-4*100', '1', NULL, NULL),
(116, 'NL MIX-4*50', '1', NULL, NULL),
(117, 'NL MIX-4*200', '1', NULL, NULL),
(118, 'NL MIX-4*400', '1', NULL, NULL),
(119, 'NL MIX-4*800', '1', NULL, NULL),
(120, 'NL MIX-4*1500', '1', NULL, NULL),
(121, 'NL MIX-10*50', '1', NULL, NULL),
(122, 'NL MIX-10*100', '1', NULL, NULL),
(123, 'NL MIX-10*200', '1', NULL, NULL),
(124, 'NL MIX-10*400', '1', NULL, NULL),
(125, 'NL MIX-10*800', '1', NULL, NULL),
(126, 'NL MIX-10*1500', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `nageur`
--

CREATE TABLE `nageur` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `num_licence` varchar(255) NOT NULL,
  `date_licence` date NOT NULL,
  `photo` varchar(255) NOT NULL,
  `type_etablissement` varchar(255) NOT NULL,
  `date_debut_activite_sportive` date NOT NULL,
  `remarque` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `genre` varchar(255) NOT NULL,
  `groupe_id` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nageur`
--

INSERT INTO `nageur` (`id`, `parent_id`, `num_licence`, `date_licence`, `photo`, `type_etablissement`, `date_debut_activite_sportive`, `remarque`, `date_naissance`, `genre`, `groupe_id`, `categorie_id`) VALUES
(17, 25, 'ggggggg', '2023-03-25', 'E:\\XAMP\\htdocs\\symfony\\club-natation\\public\\assets\\app-assets\\images\\user\\5.jpg', 'systeme francais', '2018-01-01', 'gtrgtr', '2018-01-01', 'femme', 6, 7),
(27, 25, '11', '2023-03-25', 'E:\\XAMP\\htdocs\\symfony\\club-natation\\public\\assets\\app-assets\\images\\user\\5.jpg', 'systeme francais', '2018-12-01', 'eee', '2018-06-01', 'aaa', 1, 8),
(28, 26, '123', '2023-03-25', 'E:\\XAMP\\htdocs\\symfony\\club-natation\\public\\assets\\app-assets\\images\\user\\5.jpg', 'systeme francais', '2023-03-28', 'texte tete texte texte', '2023-03-28', 'femme', 2, 9),
(31, 25, '12', '2023-03-30', 'E:\\XAMP\\htdocs\\symfony\\club-natation\\public\\assets\\app-assets\\images\\user\\5.jpg', 'systeme canadien', '2023-03-22', 'texte tete texte texte', '2023-03-27', 'femme', 4, 10),
(32, 25, '123', '2023-03-31', 'E:\\XAMP\\htdocs\\symfony\\club-natation\\public\\assets\\app-assets\\images\\user\\5.jpg', 'systeme francais', '2023-03-26', 'texte tete texte texte tt', '2023-03-28', 'femme', 1, 7),
(34, 25, '123', '2023-03-04', 'E:\\XAMP\\htdocs\\symfony\\club-natation\\public\\assets\\app-assets\\images\\user\\5.jpg', 'systeme francais', '2023-03-31', 'aaa', '2023-03-21', 'homme', 1, 8),
(38, 25, '1789', '2023-03-25', 'Syloe-Schema-Pipeline-Devops-6419c1fdb7688.png', 'systeme canadien', '2023-03-20', 'rien rien rien', '2023-03-06', 'homme', 1, 9),
(39, 23, '456', '2023-03-31', 'Syloe-Schema-Pipeline-Devops-6419c2e0bd9f9.png', 'systeme tunisien', '2023-03-13', 'texte tete texte texte', '2023-03-27', 'femme', 1, 10),
(40, 21, '147', '2023-03-18', 'Syloe-Schema-Pipeline-Devops-6419c590142a8.png', 'systeme tunisien', '2023-03-06', 'texte tete texte texte', '2023-03-20', 'femme', 1, 7),
(41, 22, '147', '2023-03-08', 'Syloe-Schema-Pipeline-Devops-641ab98150e8c.png', 'systeme tunisien', '2023-03-07', 'texte tete texte texte', '2023-03-13', 'femme', 4, 8),
(42, 23, '147', '2023-03-31', 'Syloe-Schema-Pipeline-Devops-641afb2540fd6.png', 'systeme tunisien', '2023-03-20', 'texte tete texte texte', '2023-03-29', 'femme', 2, 9),
(44, 25, '1234', '2023-03-29', 'Syloe-Schema-Pipeline-Devops-64255ae80574a.png', 'systeme tunisien', '2023-03-20', 'texte tete texte texte', '2023-03-06', 'femme', 8, 10),
(45, 33, '1234', '2023-04-29', '337574146-3348961962034680-8952785377922012475-n-642bf19af30d7.jpg', 'systeme francais', '2023-04-16', 'texte tete texte texte', '2023-03-20', 'femme', 9, 7),
(46, 25, '147', '2023-04-29', 'Syloe-Schema-Pipeline-Devops-6439cd089f786.png', 'systeme canadien', '2023-04-25', 'texte tete texte texte', '2023-03-22', 'femme', 7, 9);

-- --------------------------------------------------------

--
-- Structure de la table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `remarque` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `parents`
--

INSERT INTO `parents` (`id`, `adresse`, `ville`, `type`, `remarque`) VALUES
(20, 'ssssdd', 'ssssszz', 'père', 'sssssrrr'),
(21, 'gggg', 'gggg', 'ggg', 'gggg'),
(22, 'ttt', 'ttt', 'ttt', 'ttt'),
(23, 'zzz', 'zzz', 'zzz', 'zzzz'),
(25, 'zzz', 'zzz', 'zzz', 'zzz'),
(26, 'zzz', 'zzz', 'zzz', 'zzz'),
(33, 'rue la la', 'ariena', 'père', 'eer fref fvgfr');

-- --------------------------------------------------------

--
-- Structure de la table `performance`
--

CREATE TABLE `performance` (
  `id` int(11) NOT NULL,
  `nageur_id` int(11) DEFAULT NULL,
  `programme_competition_id` int(11) DEFAULT NULL,
  `chrono` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `physionomie`
--

CREATE TABLE `physionomie` (
  `id` int(11) NOT NULL,
  `nageur_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `taille` double NOT NULL,
  `poids` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `physionomie`
--

INSERT INTO `physionomie` (`id`, `nageur_id`, `date`, `taille`, `poids`) VALUES
(3, 28, '2023-03-21', 190, 125.3),
(4, 28, '2023-03-21', 190, 125.3),
(5, 32, '2023-03-14', 190, 55),
(8, 32, '2023-03-14', 190, 55),
(9, 32, '2023-03-14', 190, 55),
(10, 40, '2023-03-06', 170, 54),
(11, 17, '2023-04-12', 200, 180),
(12, 17, '2023-04-12', 200, 180),
(13, 41, '2023-04-15', 199, 88),
(14, 41, '2023-04-15', 199, 88),
(15, 41, '2023-04-15', 199, 88);

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `lieu_entrainement_id` int(11) DEFAULT NULL,
  `saison_id` int(11) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`id`, `date`, `lieu_entrainement_id`, `saison_id`, `label`, `date_fin`, `status`) VALUES
(7, '2023-04-02', 1, 2, 'planning', '2023-06-20', 0),
(8, '2023-04-03', 1, 2, 'planning', '2023-06-20', 1),
(9, '2023-04-03', 1, 3, 'planning2', '2023-06-20', 0),
(10, '2023-04-03', 1, 3, 'planning2', '2023-06-20', 1),
(16, '2023-04-10', 2, 2, 'planning', '2023-04-30', 1);

-- --------------------------------------------------------

--
-- Structure de la table `presence`
--

CREATE TABLE `presence` (
  `id` int(11) NOT NULL,
  `nageur_id` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `programme_competition`
--

CREATE TABLE `programme_competition` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `horaire_debut` varchar(255) NOT NULL,
  `competition_id` int(11) DEFAULT NULL,
  `horaire_fin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `programme_competition`
--

INSERT INTO `programme_competition` (`id`, `date`, `horaire_debut`, `competition_id`, `horaire_fin`) VALUES
(1, '2023-04-02', '8', NULL, '10');

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

CREATE TABLE `saison` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `saison`
--

INSERT INTO `saison` (`id`, `intitule`, `date_debut`, `date_fin`) VALUES
(2, 'champions league', '2023-03-01', '2023-07-19'),
(3, 'saison 2', '2023-08-17', '2023-10-17');

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE `seance` (
  `id` int(11) NOT NULL,
  `horaire_debut` varchar(255) NOT NULL,
  `horaire_fin` varchar(255) NOT NULL,
  `jour` varchar(255) NOT NULL,
  `planning_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`id`, `horaire_debut`, `horaire_fin`, `jour`, `planning_id`) VALUES
(24, '8', '9', 'lundi', 9),
(25, '7', '8', 'lundi', 9),
(26, '5', '6', 'mardi', 9),
(27, '15', '16', 'samedi', 10),
(28, '8', '10', 'lundi', 7),
(29, '20', '23', 'jeudi', 7),
(30, '15', '18', 'mercredi', 7),
(31, '9', '11', 'mercredi', 7),
(32, '8', '10', 'lundi', 8),
(33, '12', '13', 'samedi', 7),
(34, '8', '10', 'jeudi', 16),
(35, '14', '15', 'lundi', 16),
(36, '7', '9', 'jeudi', 8),
(37, '21', '23', 'lundi', 7);

-- --------------------------------------------------------

--
-- Structure de la table `seance_groupe`
--

CREATE TABLE `seance_groupe` (
  `seance_id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `seance_groupe`
--

INSERT INTO `seance_groupe` (`seance_id`, `groupe_id`) VALUES
(24, 6),
(25, 5),
(26, 2),
(27, 6),
(27, 7),
(28, 5),
(28, 6),
(29, 6),
(30, 5),
(30, 6),
(31, 6),
(32, 7),
(33, 5),
(34, 1),
(35, 1),
(35, 2),
(35, 4),
(35, 5),
(35, 6),
(35, 7),
(35, 8),
(35, 9),
(36, 1),
(36, 2),
(36, 4),
(36, 5),
(36, 6),
(36, 7),
(36, 8),
(36, 9),
(37, 6);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `status` smallint(6) NOT NULL,
  `profile_facebook` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) NOT NULL,
  `discr_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `nom`, `telephone`, `roles`, `status`, `profile_facebook`, `prenom`, `discr_type`) VALUES
(1, 'ghofrane', '$2y$13$U9DGNWbHFpB/EJXpiXq6lesn9ojt61CdR.wwgT2pB.tXZrCtVJnQy', 'ghofranezenina@gmail.com', 'znina', '55965064f', '[\"ROLE_ENTRAINEUR\"]', 1, 'ghofrane zenina', 'ghofrane', 'user'),
(4, 'kkkk98596', '$2y$13$8yygJ65jlfEJC09UPt3ceuebZL3SSI42CnV01dgrfrf1D1m6FaiLu', 'kkkkdett', 'musk', 'kkkkkk', '[\"ROLE_ENTRAINEUR\"]', 1, 'kkkkk', 'elomn', 'entraineur'),
(5, 'kkkkjjj', '$2y$13$jda2aYWyIwj6Cwtu3sKDwufi0Crm0nDpGHvV.oFM4AaM0yjqFeu6S', 'kkkk', 'musk', 'kkkk', '[\"ROLE_ENTRAINEUR\"]', 1, 'kkkkk', 'elon', 'entraineur'),
(7, 'zdze', '$2y$13$CFq0FYBoKWXc6sTrO.qEsuuyQ0jPN3NKiiDonGMeSiDLeeUxEbnWu', 'zsds', 'szz', 'zdzd', '[\"ROLE_ENTRAINEUR\"]', 1, 'deds', 'msdmlvkb k', 'entraineur'),
(17, 'fzffzfzf', '$2y$13$mc6YT/.TNO95GEovhYvVA.JPxA0jQNB4tc2iArftV0e.NAHM23sdi', 'ghofrane1@gmail.compphh', 'sss', 'ggggggggg', '[\"ROLE_NAGEUR\"]', 1, 'zzzzzzzzr', 'ggggg', 'nageur'),
(18, 'fffffff', '$2y$13$rsnhAjowyHZsBTGzUqjbu.zEgi8RNgbWJv80EUebKPiPOsnPtyAmi', 'ffff', 'ffff', 'ffff', '[\"ROLE_ENTRAINEUR\"]', 1, 'ffff', 'msdmlvkb k', 'entraineur'),
(19, 'walid', '$2y$13$hWqGY00O9EBOXfvraxmey.0Dyt0uEUapqnQj3ufuqA9w8xHZHl4Wu', 'fddvd', 'fvvdvf', 'dfd', '[\"ROLE_ENTRAINEUR\"]', 1, 'dffdr', 'fgdfvg', 'entraineur'),
(20, 'sss', '$2y$13$euuljPiTOQDkJnur29aYouzNVxdvThCDrrpNoCK9GqQkZerpG6viq', 'ssdddtt', 'ddd', 'sss', '[\"ROLE_PARENTS\"]', 1, 'ssss', 'mpll', 'parent'),
(21, 'ggg', '$2y$13$dPM56o8EYRoDjbFkJijyJudBjOzgawJJH4LY0lT0ltQUk10nCqV4y', 'hhh', 'gg', 'ggg', '[\"ROLE_PARENTS\"]', 1, 'ggg', 'gg', 'parent'),
(22, 'ttt', '$2y$13$kTbZztm/2AtC4YAKpY14buUzcTIb8jv/WamZo2Tsdf8i19h2/aLne', 'ttt', 'ttt', 'ttt', '[\"ROLE_PARENTS\"]', 1, 'ttt', 'ttt', 'parent'),
(23, 'edez', '$2y$13$Gpdo.EKkWjmh8wnVRCD0suHKzUrMGZkoE9/6yLe/3SIH0saZMk3MS', 'edzdez', 'eez', 'edez', '[\"ROLE_PARENTS\"]', 1, 'edzdx', 'deezedez', 'parent'),
(24, 'ooo', '$2y$13$pseyZIxvq5rpvHzdzsw1sO508T6K9rjuKVhDnlockCnjPltdVf9Fi', 'gtrgt', 'tgregtre', 'rgregt', '[\"ROLE_ENTRAINEUR\"]', 1, 'gtretgre', 'rtgtg', 'entraineur'),
(25, 'fref', '$2y$13$RSyDG.RkXs.X99b/i.G5Ee/A8uXMAyY9UyE/a50EGsPuiI9i4Ffbu', 'rfref', 'refref', 'frre', '[\"ROLE_PARENTS\"]', 1, 'fre', 'reerzzrf', 'parent'),
(26, 'zzz', '$2y$13$UPzXEh3DyDJyDXgH6t7gxeZzUSHXFdBeX3ieCvQZ6VDPNvzKx1Cc2', 'zzz', 'zzz', 'zzz', '[\"ROLE_PARENTS\"]', 1, 'zzz', 'zzz', 'parent'),
(27, 'gggggggg555', '$2y$13$LY0bZsXDWZ0tUm4BI7iYBu8AyYkqxyQsYV2SIF/svq5nNCvmlCU.a', 'ghofrane999991@gmail.com', 'musk', '99999', '[\"ROLE_NAGEUR\"]', 1, 'ggggg', 'ggggg', 'nageur'),
(28, 'yasmine', '$2y$13$d6.A4RQbUeArKY4MARgM0eY5bkh1TlZd6DRenoILQdMsz/ulF8KF6', 'yasmine@gmail.com', 'younes', '98563214', '[\"ROLE_NAGEUR\"]', 1, 'yasmine', 'yasmine', 'nageur'),
(29, 'asma', '$2y$13$sdJLmLutbfANTEj75ugka.XSh60AjcqngE26I5LT315t7rvTcqfXa', 'asma@gmail.com', 'ben asma', '78965412', '[\"ROLE_ENTRAINEUR\"]', 1, 'asma asma', 'asma', 'entraineur'),
(30, 'kkkk', '$2y$13$DCO9zibFy.evevAue85HS.b/q9ftfLdLK6EJWGC2qax6klVfx6xtS', 'feferf', 'szzr', '2514752184', '[\"ROLE_ENTRAINEUR\"]', 1, 'cdscds df', 'elonr', 'entraineur'),
(31, 'elon', '$2y$13$RCvGmPtzb3uXQeA8bymaF.X9H6nhStuE2lPOXHX9NdZ6VfKW1CCEi', 'elon@gmail.com', 'musk', '12365478', '[\"ROLE_NAGEUR\"]', 1, 'elom musk', 'ahmes', 'nageur'),
(32, 'samar', '$2y$13$/7.ydpQk4CUY61.B583HaOkFpLy7NcfCjTBk8zF7gMHeMYEntE/2e', 'samar@gmail.com', 'ben samar', '123654785', '[\"ROLE_NAGEUR\"]', 1, 'samar en', 'samar', 'nageur'),
(33, 'pele', '$2y$13$yzOqG5dRhjJeIjv/hmoBqOjpTSo8bL0Aj1OeLoufRmGZct2eVa/e2', 'pele@gmail.com', 'pele', '123456789', '[\"ROLE_PARENTS\"]', 1, 'pele12', 'pele', 'parent'),
(34, 'edxse', '$2y$13$k6qDOY43fRDcqU2DvfPzEuHPDVKg.be3xLVLmITJW/K01idxCkJ8.', 'fvvcv@gmail.cm', 'vfdvf', '123654788', '[\"ROLE_NAGEUR\"]', 1, 'szdezdez', 'fgfff', 'nageur'),
(38, 'ede12', '$2y$13$YpRy1bvYpfGn8r90ZPa6GubBNVMOPiAaTgcOUqWNlBUvk3R3EAuMa', 'ghofrane.znina@etudiant-isi.utm.tn', 'muskee', '12365478', '[\"ROLE_NAGEUR\"]', 1, 'edfdez', 'dddddd', 'nageur'),
(39, 'siwar', '$2y$13$5Qxux93Ura7N67zpY9aOf.fU2AySqVAB/C//kWtyOG0EQ3WYtJUa.', 'siwar@gmail.com', 'maitii', '123456', '[\"ROLE_NAGEUR\"]', 1, 'siwar123', 'siwar', 'nageur'),
(40, 'ghofrane12', '$2y$13$.fxB7BiInDG0XsmO/iky5uIIsDZxjmFzo13cSNF3lD1mN1hl0WjwC', 'ghofrane.znina@etudiant-isi.utm.tn', 'znina', '12365478', '[\"ROLE_NAGEUR\"]', 1, 'ghofraneznina@gmail.com', 'ghofrane1', 'nageur'),
(41, 'ayman', '$2y$13$EcOnmaLroO0YfTsA1.n/T.0XRhjbAMeND19v.q0dg81f/xMM7y.Va', 'aymenben10@gmail.com', 'benten', '98653214', '[\"ROLE_NAGEUR\"]', 1, NULL, 'aymen', 'nageur'),
(42, 'thomas', '$2y$13$WCsstGZ6S2YlmD2SDu2EK.BPVbPEF.x.5lly.bz/2n86ygIdwF.mS', 'thomas@gmail.com', 'party', '123456789', '[\"ROLE_NAGEUR\"]', 1, NULL, 'thomas', 'nageur'),
(44, 'ttt111', '$2y$13$aozyRl1PV9lvnmUNs5LfvOMKgiH22LIeTc/3XHUb4R.tre4sA0U46', 'ghofrane.znina@etudiant-isi.utm.tnn', 'cfedd', '123654787', '[\"ROLE_NAGEUR\"]', 1, NULL, 'dddddd1', 'nageur'),
(45, 'gggggggg', '$2y$13$0wDSufq/q1phZAqvSUDcWeAdp0Daeq68a1trAbPOFrpzCwlkC39.2', 'ghofrane.znina@etudiant-isi.utm.tn', 'musk', '12365478', '[\"ROLE_NAGEUR\"]', 1, NULL, 'dddddd', 'nageur'),
(46, 'tajrba1', '$2y$13$drgeSDDU/KpoT.C8GciBXeWzXFJxMMcCGyEEpa3.x0YQTldVNUWTO', 'tajrba@gmail.com', 'tajrba', '12365478', '[\"ROLE_NAGEUR\"]', 1, NULL, 'tajrba', 'nageur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_497DD6341CAE3ADF` (`minimas_id`);

--
-- Index pour la table `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B50A2CB11CAE3ADF` (`minimas_id`);

--
-- Index pour la table `cotisation_annuelle`
--
ALTER TABLE `cotisation_annuelle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E5ED87BD11C519B5` (`nageur_id`),
  ADD KEY `IDX_E5ED87BDF965414C` (`saison_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `entraineur`
--
ALTER TABLE `entraineur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B98C21F8478A1` (`entraineur_id`);

--
-- Index pour la table `lieu_entrainement`
--
ALTER TABLE `lieu_entrainement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `minimas`
--
ALTER TABLE `minimas`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nage`
--
ALTER TABLE `nage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A4CC968C1CAE3ADF` (`minimas_id`),
  ADD KEY `IDX_A4CC968C843CAF76` (`programme_competition_id`);

--
-- Index pour la table `nageur`
--
ALTER TABLE `nageur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23C0CAA6727ACA70` (`parent_id`),
  ADD KEY `IDX_23C0CAA67A45358C` (`groupe_id`),
  ADD KEY `IDX_23C0CAA6BCF5E72D` (`categorie_id`);

--
-- Index pour la table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `performance`
--
ALTER TABLE `performance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_82D7968111C519B5` (`nageur_id`),
  ADD KEY `IDX_82D79681843CAF76` (`programme_competition_id`);

--
-- Index pour la table `physionomie`
--
ALTER TABLE `physionomie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4269C3EC11C519B5` (`nageur_id`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D499BFF64E769E96` (`lieu_entrainement_id`),
  ADD KEY `IDX_D499BFF6F965414C` (`saison_id`);

--
-- Index pour la table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6977C7A511C519B5` (`nageur_id`);

--
-- Index pour la table `programme_competition`
--
ALTER TABLE `programme_competition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_633BE76E7B39D312` (`competition_id`);

--
-- Index pour la table `saison`
--
ALTER TABLE `saison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DF7DFD0E3D865311` (`planning_id`);

--
-- Index pour la table `seance_groupe`
--
ALTER TABLE `seance_groupe`
  ADD PRIMARY KEY (`seance_id`,`groupe_id`),
  ADD KEY `IDX_7BCC9789E3797A94` (`seance_id`),
  ADD KEY `IDX_7BCC97897A45358C` (`groupe_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649AA08CB10` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `competition`
--
ALTER TABLE `competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `cotisation_annuelle`
--
ALTER TABLE `cotisation_annuelle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `lieu_entrainement`
--
ALTER TABLE `lieu_entrainement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `minimas`
--
ALTER TABLE `minimas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `nage`
--
ALTER TABLE `nage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT pour la table `performance`
--
ALTER TABLE `performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `physionomie`
--
ALTER TABLE `physionomie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `presence`
--
ALTER TABLE `presence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `programme_competition`
--
ALTER TABLE `programme_competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `saison`
--
ALTER TABLE `saison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `FK_497DD6341CAE3ADF` FOREIGN KEY (`minimas_id`) REFERENCES `minimas` (`id`);

--
-- Contraintes pour la table `competition`
--
ALTER TABLE `competition`
  ADD CONSTRAINT `FK_B50A2CB11CAE3ADF` FOREIGN KEY (`minimas_id`) REFERENCES `minimas` (`id`);

--
-- Contraintes pour la table `cotisation_annuelle`
--
ALTER TABLE `cotisation_annuelle`
  ADD CONSTRAINT `FK_E5ED87BD11C519B5` FOREIGN KEY (`nageur_id`) REFERENCES `nageur` (`id`),
  ADD CONSTRAINT `FK_E5ED87BDF965414C` FOREIGN KEY (`saison_id`) REFERENCES `saison` (`id`);

--
-- Contraintes pour la table `entraineur`
--
ALTER TABLE `entraineur`
  ADD CONSTRAINT `FK_3D247E87BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `FK_4B98C21F8478A1` FOREIGN KEY (`entraineur_id`) REFERENCES `entraineur` (`id`);

--
-- Contraintes pour la table `nage`
--
ALTER TABLE `nage`
  ADD CONSTRAINT `FK_A4CC968C1CAE3ADF` FOREIGN KEY (`minimas_id`) REFERENCES `minimas` (`id`),
  ADD CONSTRAINT `FK_A4CC968C843CAF76` FOREIGN KEY (`programme_competition_id`) REFERENCES `programme_competition` (`id`);

--
-- Contraintes pour la table `nageur`
--
ALTER TABLE `nageur`
  ADD CONSTRAINT `FK_23C0CAA6727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`),
  ADD CONSTRAINT `FK_23C0CAA67A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_23C0CAA6BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `FK_23C0CAA6BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `FK_FD501D6ABF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `performance`
--
ALTER TABLE `performance`
  ADD CONSTRAINT `FK_82D7968111C519B5` FOREIGN KEY (`nageur_id`) REFERENCES `nageur` (`id`),
  ADD CONSTRAINT `FK_82D79681843CAF76` FOREIGN KEY (`programme_competition_id`) REFERENCES `programme_competition` (`id`);

--
-- Contraintes pour la table `physionomie`
--
ALTER TABLE `physionomie`
  ADD CONSTRAINT `FK_4269C3EC11C519B5` FOREIGN KEY (`nageur_id`) REFERENCES `nageur` (`id`);

--
-- Contraintes pour la table `planning`
--
ALTER TABLE `planning`
  ADD CONSTRAINT `FK_D499BFF64E769E96` FOREIGN KEY (`lieu_entrainement_id`) REFERENCES `lieu_entrainement` (`id`),
  ADD CONSTRAINT `FK_D499BFF6F965414C` FOREIGN KEY (`saison_id`) REFERENCES `saison` (`id`);

--
-- Contraintes pour la table `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `FK_6977C7A511C519B5` FOREIGN KEY (`nageur_id`) REFERENCES `nageur` (`id`);

--
-- Contraintes pour la table `programme_competition`
--
ALTER TABLE `programme_competition`
  ADD CONSTRAINT `FK_633BE76E7B39D312` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`);

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `FK_DF7DFD0E3D865311` FOREIGN KEY (`planning_id`) REFERENCES `planning` (`id`);

--
-- Contraintes pour la table `seance_groupe`
--
ALTER TABLE `seance_groupe`
  ADD CONSTRAINT `FK_7BCC97897A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7BCC9789E3797A94` FOREIGN KEY (`seance_id`) REFERENCES `seance` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
