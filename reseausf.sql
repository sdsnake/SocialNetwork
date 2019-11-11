-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 01 sep. 2019 à 12:43
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `reseausf`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `title`, `description`) VALUES
(4, 'Informatique', 'Tout ce qui concerne l\'informatique'),
(5, 'jeuxvideo', 'Tout ce qui concerne les jeux video'),
(6, 'Loisirs', 'Le reste');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C4B89032C` (`post_id`),
  KEY `IDX_9474526CA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `content`, `created_at`, `user_id`) VALUES
(131, 68, 'Aie Bon courage :s', '2019-07-06 15:05:02', 21),
(134, 71, 'Passe moi ton lien Github ;)', '2019-07-13 18:54:09', 21),
(135, 68, 'Google est ton amie', '2019-07-30 14:08:42', 14),
(138, 69, 'Dragoon69 : 53 rue des marroniers Lyon', '2019-08-09 09:23:58', 24),
(152, 75, 'pas de quoi', '2019-09-01 12:36:16', 21);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `img_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A8A6C8D12469DE2` (`category_id`),
  KEY `IDX_5A8A6C8DA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `content`, `created_at`, `category_id`, `user_id`, `img_filename`) VALUES
(68, 'Quelqu\'un pour m\'aider? Mon code ne fonctionne pas!', '2019-07-06 15:04:51', 4, 21, '20190703-5d2e0fb5390b3.png'),
(69, 'La bouffe! Je recommande ce restaurant! tip top', '2019-07-07 21:32:11', 6, 22, '500x675_8119portrait-5d4021e486c09.jpeg'),
(71, 'Encore besoin d\'aide....', '2019-07-13 18:16:07', 4, 21, '20190625-5d2a1fe7a00f0.png'),
(75, 'Merci à tous pour votre aide!', '2019-07-16 08:56:52', 4, 21, 'nothing.png'),
(76, 'Je me présente je suis l\'administrateur! Amusez vous bien!', '2019-07-29 16:38:15', 4, 14, 'thanos-5d4022be5e157.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `post_user`
--

DROP TABLE IF EXISTS `post_user`;
CREATE TABLE IF NOT EXISTS `post_user` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`user_id`),
  KEY `IDX_44C6B1424B89032C` (`post_id`),
  KEY `IDX_44C6B142A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post_user`
--

INSERT INTO `post_user` (`post_id`, `user_id`) VALUES
(68, 21),
(69, 21),
(69, 22),
(69, 24),
(71, 21),
(75, 21),
(76, 14),
(76, 21);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Informatique'),
(2, 'Jeux Video'),
(3, 'Test'),
(4, 'symfony'),
(5, 'restaurant'),
(6, 'vacance');

-- --------------------------------------------------------

--
-- Structure de la table `tag_post`
--

DROP TABLE IF EXISTS `tag_post`;
CREATE TABLE IF NOT EXISTS `tag_post` (
  `tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`,`post_id`),
  KEY `IDX_B485D33BBAD26311` (`tag_id`),
  KEY `IDX_B485D33B4B89032C` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tag_post`
--

INSERT INTO `tag_post` (`tag_id`, `post_id`) VALUES
(1, 68),
(3, 76),
(4, 68),
(4, 71),
(4, 75),
(5, 69);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E16C6B94` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `alias`, `roles`, `password`, `active`) VALUES
(14, 'said69', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=6,p=1$VmxqcHRnUExVRHFERTlWSQ$k82ykmq1A1gP2BLeDypyJFy9ZOdkeLcSneuO/zH3kWQ', 1),
(20, 'Ken69', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$aFA2RXdhclFrckJ0eGdhVA$KQJAz38kmZnkEyHzQi/qLx/O2nCN2P6F7kPpK1cS8ns', 0),
(21, 'Diego69', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$UTFiWVFPd2hJb0R4dXVlaw$HXxSpE6K1XSycD7b/ObhwxmcPRvKrM2wRx9dekK+cP8', 1),
(22, 'Ganon69', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$a3MvU3FzWVd6VVBWL2p4Mw$S8vKsdmMkS2goRdA8ED6RyyWS0NV/Cfiy/+GHw3DZV4', 1),
(24, 'Thor69', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$UmtjRHBsYzhjRnExVUxpNg$dQoknk2Ozh4j+dHuBqAn+vilGqFH7GSanrFwA+OSxaI', 1),
(30, 'Dragoon69', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=6,p=1$VFA4MXJmQ2Z6bS5LYjBUcQ$OjnvbxpVlIDvqP1oqNgBdiUcnDFnBsQGGxvEm4i1nGs', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8D12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_5A8A6C8DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `post_user`
--
ALTER TABLE `post_user`
  ADD CONSTRAINT `FK_44C6B1424B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_44C6B142A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tag_post`
--
ALTER TABLE `tag_post`
  ADD CONSTRAINT `FK_B485D33B4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B485D33BBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
