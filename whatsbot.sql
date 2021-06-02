-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 18 mai 2021 à 22:59
-- Version du serveur :  10.5.9-MariaDB-1
-- Version de PHP : 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `whatsbot`
--

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_to` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `content`, `answer`, `related_to`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Quel sont les départements de notre faculté ?', '', 0, 1, '2021-05-15 14:38:01', '2021-05-15 14:38:01'),
(2, 'Quel est Nom de chef de département de cette filière ?', '', 0, 1, '2021-05-15 14:38:27', '2021-05-15 14:38:27'),
(3, ' Est-ce que tous les étudient peut accéder à l’Université ?', 'Oui bien sur tous le monde peut accéder.', 0, 1, '2021-05-15 14:38:40', '2021-05-15 14:42:40'),
(4, 'Comment je peux accéder à ent ?', 'Vous pouvez accéder en utilisant le lien http://ent.univcasa.ma/uPortal/render.userLayoutRootNode.uP', 0, 1, '2021-05-15 14:39:02', '2021-05-15 14:40:43'),
(5, 'Qu’est les listes de group de travaux dirigé ?', '', 0, 1, '2021-05-15 14:39:14', '2021-05-15 14:39:14'),
(6, 'Comment je peux s’inscrire à l’exam?', 'Inscription aux Examens S2/S4/S6 http://www.fsb.univh2c.ma/reins/insc_examen.php', 0, 1, '2021-05-15 14:52:52', '2021-05-15 15:12:09'),
(7, 'Quel est la durée de l’exam ?', '', 0, 1, '2021-05-15 14:53:04', '2021-05-15 14:53:04'),
(8, 'Quand on va recevoir une convocation aux exams ? ', 'http://www.fsb.univh2c.ma/reins/insc_examen.php', 0, 1, '2021-05-15 14:53:22', '2021-05-15 14:53:22'),
(9, 'Quel sont les documents nécessaires pour passer l’examen ?', '', 0, 1, '2021-05-15 14:53:39', '2021-05-15 14:53:39'),
(10, 'Quel est l’imploi de temps de cette année ?', 'image', 0, 1, '2021-05-15 14:53:58', '2021-05-15 14:53:58'),
(11, 'Quel est l imploi de temps d’examens de ce semestre ?', 'Normal/ rattrapage (image)', 0, 1, '2021-05-15 14:54:27', '2021-05-15 14:54:27'),
(12, 'Est-ce que les notes de ce semestre a-t-il', 'oui / non ', 0, 1, '2021-05-15 14:54:47', '2021-05-15 14:54:47'),
(13, 'Quel sont des type formation ?', '', 0, 1, '2021-05-15 14:55:02', '2021-05-15 14:55:02'),
(14, 'Quel est la durée de chaque formation ? ', 'Licence : 3ans ,  master: 2ans , doctorat: 2 ans  , licence profissionnel: 4ans', 0, 1, '2021-05-15 14:55:28', '2021-05-15 14:55:28'),
(15, ' Quel il est les filières de (une formation)', '', 0, 1, '2021-05-15 14:55:53', '2021-05-15 14:55:53'),
(16, ' Quel les la note qui il faut avoir pour accéder à une formation ?', '', 0, 1, '2021-05-15 14:56:17', '2021-05-15 14:56:17'),
(17, 'Commets-je peut vous contacter ?', '', 0, 1, '2021-05-15 14:56:28', '2021-05-15 14:56:28'),
(18, ' Adresse d’université ? ', '', 0, 1, '2021-05-15 14:56:42', '2021-05-15 14:56:42'),
(19, 'Gmail d’un professeur ?', '', 0, 1, '2021-05-15 14:57:25', '2021-05-15 14:57:25'),
(20, 'Nemro de bereaux d’un professeur ?', '', 0, 1, '2021-05-15 14:57:37', '2021-05-15 14:57:37'),
(21, ' Quel est Nom de professeur d’un module', '', 0, 1, '2021-05-15 14:57:52', '2021-05-15 14:57:52'),
(22, 'Est-ce que c’est possible de changer filière ? ', '(Réponse fermée oui/non)', 0, 1, '2021-05-15 14:58:12', '2021-05-15 14:58:12'),
(23, 'Quel sont les chapitres qui contienne ce module ', '', 0, 1, '2021-05-15 14:58:23', '2021-05-15 14:58:23'),
(24, 'Quelles le nom des modules d’un semestre d’une filière.', '', 0, 1, '2021-05-15 14:58:45', '2021-05-15 14:58:45'),
(25, 'Comment je peux accéder aux mon cours en ligne ?', '', 0, 1, '2021-05-15 14:58:57', '2021-05-15 14:58:57'),
(26, 'Est-ce que c’est possible de changer filière ?', '(Réponse fermée oui/non)', 0, 1, '2021-05-15 14:59:18', '2021-05-15 14:59:18'),
(27, 'bonjour bonsoir salam hello hi hola', 'Bonjour, besoin d\'aide ?', 0, 1, '2021-05-15 15:08:13', '2021-05-15 15:08:13');

-- --------------------------------------------------------

--
-- Structure de la table `questions_tags`
--

CREATE TABLE `questions_tags` (
  `question_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `questions_tags`
--

INSERT INTO `questions_tags` (`question_id`, `tag_id`) VALUES
(1, 1),
(2, 1),
(5, 1),
(4, 1),
(3, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 3),
(11, 3),
(12, 4),
(13, 5),
(14, 5),
(15, 5),
(16, 5),
(17, 6),
(18, 6),
(19, 6),
(20, 7),
(21, 7),
(22, 8),
(23, 9),
(24, 9),
(25, 9),
(26, 10),
(27, 11),
(6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `synonyms` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id`, `name`, `description`, `synonyms`, `level`, `created_at`, `updated_at`) VALUES
(1, 'departements', '', NULL, 1, '2021-05-15 14:36:05', '2021-05-15 14:36:05'),
(2, 'exams', '', NULL, 1, '2021-05-15 14:36:22', '2021-05-15 14:36:22'),
(3, 'emplois', '', NULL, 2, '2021-05-15 14:36:30', '2021-05-15 14:36:30'),
(4, 'notes', '', NULL, 1, '2021-05-15 14:36:38', '2021-05-15 14:36:38'),
(5, 'formation', '', NULL, 2, '2021-05-15 14:36:50', '2021-05-15 14:36:50'),
(6, 'contact', '', NULL, 3, '2021-05-15 14:36:58', '2021-05-15 14:36:58'),
(7, 'professeurs', '', NULL, 3, '2021-05-15 14:37:11', '2021-05-15 14:37:11'),
(8, 'temps', '', NULL, 2, '2021-05-15 14:37:20', '2021-05-15 14:37:20'),
(9, 'cours', '', NULL, 1, '2021-05-15 14:37:27', '2021-05-15 14:37:27'),
(10, 'filieres', '', NULL, 2, '2021-05-15 14:37:38', '2021-05-15 14:37:38'),
(11, 'hello', '', NULL, 3, '2021-05-15 15:07:18', '2021-05-15 15:07:18');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'asmaa khoumani', 'khoumaniasmaa.97@gmail.com', '9d69a8b5c3f32b2605e623ac86293347', '2021-05-13 15:36:46', '2021-05-16 09:36:51');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `unique_name` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `questions_tags`
--
ALTER TABLE `questions_tags`
  ADD CONSTRAINT `questions_tags_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `questions_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  ADD CONSTRAINT `questions_tags_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
