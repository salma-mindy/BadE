-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 02 juil. 2020 à 05:10
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bad_event`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteurs`
--

CREATE TABLE `acteurs` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `dateModification` datetime DEFAULT NULL,
  `dateAjout` datetime DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `acteurs`
--

INSERT INTO `acteurs` (`id`, `intitule`, `dateModification`, `dateAjout`, `idUtilisateur`) VALUES
(4, 'enfant', NULL, NULL, 0),
(5, 'garçon', NULL, NULL, 0),
(6, 'filles', '2020-07-01 04:07:13', NULL, 39),
(7, 'fillette', NULL, NULL, 0),
(8, 'groupe de personnes', '2020-07-01 04:06:57', NULL, 39),
(9, 'femme', NULL, NULL, 0),
(10, 'homme', NULL, NULL, 0),
(12, 'azerty', '2020-07-01 02:45:52', '2020-07-01 02:45:52', 39),
(20, 'azerty1', '2020-07-01 03:31:16', '2020-07-01 03:31:16', 39);

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `id` int(11) NOT NULL,
  `intituleActivite` varchar(255) NOT NULL,
  `periode` datetime NOT NULL DEFAULT current_timestamp(),
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id`, `intituleActivite`, `periode`, `idUtilisateur`) VALUES
(1, 'Mise à jour de Ville', '2020-07-02 04:26:49', 39),
(2, 'Mise à jour de Ville', '2020-07-02 04:27:24', 39),
(3, 'Suppression de type de danger', '2020-07-02 05:08:31', 39);

-- --------------------------------------------------------

--
-- Structure de la table `danger`
--

CREATE TABLE `danger` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `idDangerType` int(11) NOT NULL,
  `idPays` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `idVille` int(11) NOT NULL,
  `sexeVictime` int(11) NOT NULL,
  `sexeResponsable` int(11) NOT NULL,
  `dateAjout` datetime NOT NULL,
  `dateModification` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `danger`
--

INSERT INTO `danger` (`id`, `description`, `date`, `idDangerType`, `idPays`, `source`, `idVille`, `sexeVictime`, `sexeResponsable`, `dateAjout`, `dateModification`, `idUtilisateur`) VALUES
(1, 'Grand spécialiste du genre, Udemy propose de nombreuses formations sur Python dans son catalogue. Assurées par des professionnels expérimentés, ces cours en vidéo sont accessibles soit à des débutants, soit à des des développeurs initiés, et s’appuient sur de nombreux exercices permettant de mettre immédiatement la théorie en pratique. Comme toujours, des extraits sont disponibles en visionnage gratuit, pour se faire une idée du contenu et du formateur. Offrant un accès illimité en vidéo à la demande (VOD), à la fois sur ordinateur, TV et mobile, toutes ces formations bénéficient en outre d’une garantie « Satisfait ou remboursé » de 30 jours, gage de qualité et de sérieux.', '2020-06-04', 1, 1, 'https://www.w3schools.com/bootstrap4/bootstrap_dropdowns.asp', 22, 4, 5, '2020-06-30 03:40:10', '2020-06-30 15:51:29', 39),
(5, 'Totalisant plus de 13 heures de vidéo réparties en 43 articles, ce cours se présente comme une formation complète et progressive à Python. Spécialiste de la programmation, le formateur aborde tous les aspects de ce langage très prisé, des bases essentielles aux concepts les plus évolués, en s’appuyant sur de nombreux quiz et exercices pratiques permettant de vérifier immédiatement les connaissances acquises. Du choix de l’environnement de développement (Sublime Text, Visual Studio Code, PyCharm, Anaconda…) et de la plateforme (Windows, macOS ou Linux) aux opérateurs ternaires, en passant par les packages, les fonctions, les listes ou la gestion d’erreurs avec des exceptions, tous les aspects de la programmation objet en Python sont passés en revue avec force d’exemples et d’explications. Plusieurs projets concrets sont proposés dans cette formation réalisée avec la version 3.7 qui s’adresse aussi bien aux débutants motivés qu’aux développeurs confirmés souhaitant apprendre un nouveau langage.', '2020-06-03', 3, 2, 'https://www.w3schools.com/bootstrap4/bootstrap_dropdowns.asp', 83, 5, 6, '2020-06-30 04:42:27', '2020-06-30 04:42:27', 39);

-- --------------------------------------------------------

--
-- Structure de la table `dangertype`
--

CREATE TABLE `dangertype` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `dateAjout` datetime NOT NULL,
  `dateModification` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dangertype`
--

INSERT INTO `dangertype` (`id`, `intitule`, `dateAjout`, `dateModification`, `idUtilisateur`) VALUES
(1, 'accident', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 39),
(2, 'vole à l’arraché', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 'viol', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 'inondation', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 'troubles(manifestation)', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, 'suicide', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, 'Arnaque', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, 'violence conjugale', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(10, 'crime passionnel', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(11, 'enlèvement', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(12, 'découverte de corps sans vie', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(13, 'crime rituel', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(14, 'Empoisonnement et intoxication', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(15, 'incendie', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(16, 'électrocution', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(17, 'bavure policière', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(18, 'Vol à main armée ( braquage, Coupeur de route)', '2020-07-01 13:47:05', '2020-07-01 13:47:05', 39),
(22, 'Vol à main armée ( braquage, Coupeur de route)', '2020-07-01 14:19:46', '2020-07-01 14:19:46', 39);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `objetMessage` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `descriptionPays` text NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `img` text NOT NULL,
  `dateAjout` datetime NOT NULL,
  `dateModification` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id`, `nom`, `descriptionPays`, `lat`, `lng`, `img`, `dateAjout`, `dateModification`, `idUtilisateur`) VALUES
(1, 'Côte d\'Ivoire', '', 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(2, 'Ghana', '', 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `intituleRole` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `intituleRole`, `description`) VALUES
(1, 'ROLE_ADMIN', 'Super admin'),
(2, 'ROLE_OPERATEUR', 'opérateur'),
(3, 'ROLE_SUPERVISEUR', 'Superviseur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT current_timestamp(),
  `idRole` int(11) NOT NULL,
  `image` varchar(150) DEFAULT NULL,
  `autorisationApays` text NOT NULL,
  `autorisationAtypeevent` text NOT NULL,
  `autorisationAville` text NOT NULL,
  `dateModification` datetime NOT NULL,
  `idparent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `genre`, `contact`, `adresse`, `email`, `motDePasse`, `dateInscription`, `idRole`, `image`, `autorisationApays`, `autorisationAtypeevent`, `autorisationAville`, `dateModification`, `idparent`) VALUES
(2, 'Aka', 'Anoa Sheila Melissa', 'feminin', '+22549060536', 'Abobo belleville', 'shellyaka998@gmail.com', '$2y$10$B3p5Aho8RkUkktyfepZqhuB2GZKKg8Iz8tylbjdjS3CLy7kefYZbq', '2020-06-06 13:32:35', 1, NULL, '', '', '', '0000-00-00 00:00:00', 0),
(29, 'Abie', 'Raissa', 'Feminin', '87147883', 'Niangon, Yopougon', 'raisa0@gmail.com', '$2y$10$lNRy2fHUBBPdkh74m4YPje2gq6o9qOeYzcgmhGMQODSTXRHHohNY6', '2020-06-20 15:12:56', 2, NULL, '', '', '', '0000-00-00 00:00:00', 0),
(30, 'Aka', 'Lory', 'Feminin', '87147883', 'Niangon, Yopougon', 'loryaka@gmail.com', '$2y$10$G30tPI7Xst/h4dzWSlYkuedoV4Fl//rreWoTtuVj.r0.5rl4JygQO', '2020-06-20 15:36:37', 2, NULL, '', '', '', '0000-00-00 00:00:00', 0),
(32, 'Meli', 'Anoa Melissa', 'Feminin', '43009312', 'Niangon, Yopougon', 'melissa@gmail.com', '$2y$10$z9cEY5Dq4CRZ3debUiBGxeVgIr/Njilo5aJ09d7CXCEqjxgbsCYCe', '2020-06-20 15:45:32', 2, NULL, '', '', '', '0000-00-00 00:00:00', 0),
(33, 'test2', 'Loriane', 'Feminin', '85154865', 'Niangon, Yopougon', 'teste0@gmail.com', '$2y$10$3Ax1NMsGTUIR33V.ONTLI.oAXhXrbbggFX2KOPJ6Onkv0um/JI7cO', '2020-06-20 15:58:07', 2, NULL, '', '', '', '0000-00-00 00:00:00', 0),
(35, 'Opérateu', 'koné', 'Masculin', '05285478', 'Bouaflé, CI', 'kouame@gmail.com', '$2y$10$Ru6v/jJ6kyt8SnmXLT3P8e/GHpn05Au6ivK/v5BdySHU5Ucio/Emu', '2020-06-21 09:03:44', 2, NULL, '', '', '', '0000-00-00 00:00:00', 0),
(36, 'Meli', 'Anoa Melissa', 'Feminin', '43009312', 'Niangon, Yopougon', 'melissa@gmail.com', '$2y$10$z9cEY5Dq4CRZ3debUiBGxeVgIr/Njilo5aJ09d7CXCEqjxgbsCYCe', '2020-06-20 15:45:32', 2, NULL, '', '', '', '0000-00-00 00:00:00', 0),
(37, 'test2', 'Loriane', 'Feminin', '85154865', 'Niangon, Yopougon', 'teste0@gmail.com', '$2y$10$3Ax1NMsGTUIR33V.ONTLI.oAXhXrbbggFX2KOPJ6Onkv0um/JI7cO', '2020-06-20 15:58:07', 2, NULL, '', '', '', '0000-00-00 00:00:00', 0),
(38, 'Opérateu', 'koné', 'Masculin', '05285478', 'Bouaflé, CI', 'kouame@gmail.com', '$2y$10$Ru6v/jJ6kyt8SnmXLT3P8e/GHpn05Au6ivK/v5BdySHU5Ucio/Emu', '2020-06-21 09:03:44', 2, NULL, '', '', '', '0000-00-00 00:00:00', 0),
(39, 'KOYA', 'Téan benoit', 'Masculin', '08880004', 'Abobo', 'tean.koya@gmail.com', '$2y$10$8VIa4CZ8dOZFeW7QIStJyeuTacQu9QhQ5DJ8K0vioV118NNH5iYOG', '2020-06-27 08:08:50', 2, NULL, '', '', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id` int(11) NOT NULL,
  `ville` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `descriptionVille` text COLLATE utf8_estonian_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `img` text COLLATE utf8_estonian_ci NOT NULL,
  `pays` int(11) NOT NULL,
  `dateAjout` date NOT NULL,
  `dateModification` date NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `ville`, `descriptionVille`, `lat`, `lng`, `img`, `pays`, `dateAjout`, `dateModification`, `idUtilisateur`) VALUES
(10, 'adjame', '', 5.36507, -4.02357, '', 1, '0000-00-00', '0000-00-00', 39),
(11, 'attecoube', '', 5.33625, -4.04145, '', 1, '0000-00-00', '0000-00-00', 39),
(12, 'cocody', '', 5.36022, -3.96744, '', 1, '0000-00-00', '0000-00-00', 39),
(13, 'koumassi', '', 5.30298, -3.94194, '', 1, '0000-00-00', '0000-00-00', 0),
(14, 'marcory', '', 5.30271, -3.98274, '', 1, '0000-00-00', '0000-00-00', 0),
(15, 'plateau', '', 5.32332, -4.02357, '', 1, '0000-00-00', '0000-00-00', 0),
(16, 'portbouet', '', 5.27725, -3.8859, '', 1, '0000-00-00', '0000-00-00', 0),
(17, 'treichville', '', 5.29209, -4.01336, '', 1, '0000-00-00', '0000-00-00', 0),
(18, 'yopougon', '', 5.31767, -4.08999, '', 1, '0000-00-00', '0000-00-00', 0),
(19, 'abengourou', '', 6.7157, -3.48013, '', 1, '0000-00-00', '0000-00-00', 0),
(20, 'aboisso', '', 5.47451, -3.20308, '', 1, '0000-00-00', '0000-00-00', 0),
(21, 'adzope', '', 6.10715, -3.85535, '', 1, '0000-00-00', '0000-00-00', 0),
(22, 'agboville', '', 5.9355, -4.22308, '', 1, '0000-00-00', '0000-00-00', 0),
(23, 'agnibilekrou', '', 7.13028, -3.20308, '', 1, '0000-00-00', '0000-00-00', 0),
(24, 'anyama', '', 5.48771, -4.05166, '', 1, '0000-00-00', '0000-00-00', 0),
(26, 'beoumi', '', 7.67309, -5.57223, '', 1, '0000-00-00', '0000-00-00', 0),
(27, 'bingerville', '', 5.35036, -3.87571, '', 1, '0000-00-00', '0000-00-00', 0),
(28, 'bocanda', '', 7.06591, -4.49543, '', 1, '0000-00-00', '0000-00-00', 0),
(29, 'bondoukou', '', 8.04788, -2.80786, '', 1, '0000-00-00', '0000-00-00', 0),
(30, 'bongouanou', '', 6.6487, -4.20515, '', 1, '0000-00-00', '0000-00-00', 0),
(31, 'bonoua', '', 5.27118, -3.59393, '', 1, '0000-00-00', '0000-00-00', 0),
(33, 'boundiali', '', 9.51836, -6.48232, '', 1, '0000-00-00', '0000-00-00', 0),
(34, 'dabou', '', 5.32621, -4.36679, '', 1, '0000-00-00', '0000-00-00', 0),
(35, 'daloa', '', 6.88833, -6.43969, '', 1, '0000-00-00', '0000-00-00', 0),
(36, 'bouaflé', '', 6.98274, -5.74051, '', 1, '0000-00-00', '0000-00-00', 0),
(37, 'danané', '', 7.2676, -8.14478, '', 1, '0000-00-00', '0000-00-00', 0),
(38, 'daoukro', '', 7.0654, -3.95724, '', 1, '0000-00-00', '0000-00-00', 0),
(39, 'dimbokro', '', 6.65747, -4.71223, '', 1, '0000-00-00', '0000-00-00', 0),
(40, 'divo', '', 5.84154, -5.36255, '', 1, '0000-00-00', '0000-00-00', 0),
(41, 'douekoue', '', 6.74738, -7.36246, '', 1, '0000-00-00', '0000-00-00', 0),
(42, 'ferkessedougou', '', 9.5842, -5.19536, '', 1, '0000-00-00', '0000-00-00', 0),
(43, 'gagnoa', '', 6.15144, -5.95154, '', 1, '0000-00-00', '0000-00-00', 0),
(44, 'gohitafla', '', 7.48828, -5.88024, '', 1, '0000-00-00', '0000-00-00', 0),
(45, 'grandlahou', '', 5.13652, -5.02605, '', 1, '0000-00-00', '0000-00-00', 0),
(46, 'grandbassam', '', 5.22594, -3.75367, '', 1, '0000-00-00', '0000-00-00', 0),
(47, 'Grand-Bereby', '', 4.65137, -6.92205, '', 1, '0000-00-00', '0000-00-00', 0),
(48, 'guiglo', '', 6.54906, -7.49765, '', 1, '0000-00-00', '0000-00-00', 0),
(49, 'issia', '', 6.48761, -6.58368, '', 1, '0000-00-00', '0000-00-00', 0),
(50, 'jacqueville', '', 5.20598, -4.42335, '', 1, '0000-00-00', '0000-00-00', 0),
(52, 'katiola', '', 8.14023, -5.09631, '', 1, '0000-00-00', '0000-00-00', 0),
(53, 'korhogo', '', 9.46693, -5.61426, '', 1, '0000-00-00', '0000-00-00', 0),
(55, 'mbahiakro', '', 7.4548, -4.3411, '', 1, '0000-00-00', '0000-00-00', 0),
(58, 'mankono', '', 8.05991, -6.18983, '', 1, '0000-00-00', '0000-00-00', 0),
(59, 'odienne', '', 9.51888, -7.55722, '', 1, '0000-00-00', '0000-00-00', 0),
(60, 'oumé', '', 6.37413, -5.40966, '', 1, '0000-00-00', '0000-00-00', 0),
(61, 'sassandra', '', 4.95128, -6.09175, '', 1, '0000-00-00', '0000-00-00', 0),
(62, 'seguela', '', 7.96018, -6.6745, '', 1, '0000-00-00', '0000-00-00', 0),
(63, 'sinfra', '', 6.62334, -5.91456, '', 1, '0000-00-00', '0000-00-00', 0),
(64, 'soubré', '', 5.78662, -6.58902, '', 1, '0000-00-00', '0000-00-00', 0),
(65, 'tengrela', '', 10.482, -6.41306, '', 1, '0000-00-00', '0000-00-00', 0),
(66, 'tiassale', '', 5.90426, -4.82614, '', 1, '0000-00-00', '0000-00-00', 0),
(67, 'Toulepleu', '', 6.57956, -8.4102, '', 1, '0000-00-00', '0000-00-00', 0),
(68, 'toumodi', '', 6.55603, -5.01565, '', 1, '0000-00-00', '0000-00-00', 0),
(69, 'vavoua', '', 7.37506, -6.47699, '', 1, '0000-00-00', '0000-00-00', 0),
(70, 'yamoussoukro', '', 6.82762, -5.28934, '', 1, '0000-00-00', '0000-00-00', 0),
(71, 'zuenoula', '', 7.42404, -6.05204, '', 1, '0000-00-00', '0000-00-00', 0),
(72, 'Bouna', '', 9.27166, -2.99256, '', 1, '0000-00-00', '0000-00-00', 0),
(73, 'lakota', '', 5.85947, -5.67735, '', 1, '0000-00-00', '0000-00-00', 0),
(74, 'kani', '', 8.47784, -6.60504, '', 1, '0000-00-00', '0000-00-00', 0),
(75, 'man', '', 7.40643, -7.55722, '', 1, '0000-00-00', '0000-00-00', 0),
(76, 'dabakala', '', 8.36626, -4.43364, '', 1, '0000-00-00', '0000-00-00', 0),
(77, 'kong', '', 9.15102, -4.61018, '', 1, '0000-00-00', '0000-00-00', 0),
(78, 'Touba', '', 8.28417, -7.68194, '', 1, '0000-00-00', '0000-00-00', 0),
(79, 'bouake', '', 7.69047, -5.03905, '', 1, '0000-00-00', '0000-00-00', 0),
(80, 'Accra', '', 5.5600141, -0.2057437, '', 2, '0000-00-00', '0000-00-00', 0),
(81, 'Kumasi', '', 6.698081, -1.6230404, '', 2, '0000-00-00', '0000-00-00', 0),
(82, 'Tamale', '', 9.4051992, -0.8423986, '', 2, '0000-00-00', '0000-00-00', 0),
(83, 'Sekondi-Takoradi', '', 4.927456, -1.7490216, '', 2, '0000-00-00', '0000-00-00', 0),
(84, 'Ashaiman', '', 5.694385, -0.029529, '', 2, '0000-00-00', '0000-00-00', 0),
(85, 'Sunyani', '', 7.3384389, -2.3309226, '', 2, '0000-00-00', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `visiteurs`
--

CREATE TABLE `visiteurs` (
  `adresseIp` varchar(30) NOT NULL,
  `dateVisite` date NOT NULL,
  `pagesVues` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `visiteurs`
--

INSERT INTO `visiteurs` (`adresseIp`, `dateVisite`, `pagesVues`) VALUES
('127.0.0.1', '2008-06-20', 2),
('::1', '2008-06-20', 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteurs`
--
ALTER TABLE `acteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `danger`
--
ALTER TABLE `danger`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dangertype`
--
ALTER TABLE `dangertype`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRole` (`idRole`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visiteurs`
--
ALTER TABLE `visiteurs`
  ADD PRIMARY KEY (`adresseIp`,`dateVisite`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acteurs`
--
ALTER TABLE `acteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `activites`
--
ALTER TABLE `activites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `danger`
--
ALTER TABLE `danger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `dangertype`
--
ALTER TABLE `dangertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
