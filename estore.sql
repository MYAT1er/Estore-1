-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 13 avr. 2024 à 01:01
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `estore`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id_jeux_id` int(11) DEFAULT NULL,
  `nombres_commandes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `user_id`, `id_jeux_id`, `nombres_commandes`) VALUES
(1, NULL, 6, 1),
(2, NULL, 6, 1),
(3, NULL, 6, 1),
(4, NULL, 6, 1),
(5, NULL, 10, 1),
(6, NULL, 12, 1),
(7, NULL, 11, 1),
(8, NULL, 15, 1);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240410154734', '2024-04-10 17:48:02', 136),
('DoctrineMigrations\\Version20240411134024', '2024-04-11 15:40:33', 138),
('DoctrineMigrations\\Version20240411135628', '2024-04-11 15:56:33', 222),
('DoctrineMigrations\\Version20240412114939', '2024-04-12 13:52:23', 1107),
('DoctrineMigrations\\Version20240412215332', '2024-04-12 23:53:49', 580),
('DoctrineMigrations\\Version20240412222801', '2024-04-13 00:28:06', 341);

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `plateforme` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `stock_disponible` int(11) NOT NULL,
  `date_sortie` date NOT NULL COMMENT '(DC2Type:date_immutable)',
  `editeur` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id`, `nom`, `description`, `plateforme`, `prix`, `stock_disponible`, `date_sortie`, `editeur`, `image`) VALUES
(5, 'NSUNS4', 'Disquette', 'Nintendo Switch', 25000, 0, '2024-04-11', 'copyright', 'ps4agrandit-66179828f1695.jpg'),
(6, 'pS4', 'ssss', 'playstation', 2333333, 28, '2024-04-11', 'copyright', '07-6617985418a14.jpg'),
(7, 'NSUNS4', 'Iiiiiiiii', 'Xbox', 1233333, 5, '2024-05-11', 'copyright', '08-6617987c43342.jpg'),
(8, 'Switch', 'slk,dkdd', 'pc', 1728792, 7, '2024-04-11', 'copyright', 'springBootI-661798ab06a75.png'),
(9, 'console', 'pzkpksp', 'Xbox', 11929, 28229829, '2024-04-11', 'copyright', 'symfony-logo-icon-167958-661798dadb868.png'),
(10, 'NSUNS4', 'naruto', 'playstation', 1233323, 22, '2024-04-04', 'copyright', 'langage-6617991a517fb.png'),
(11, 'pS4', 'ééééééééé', 'playstation', 233333, 5, '2024-04-21', 'copyright', 'ps4agrandit-6617994adb0c2.jpg'),
(12, 'Switch', 'sssssssss', 'Nintendo Switch', 2147483647, 32, '2024-04-26', 'copyright', '02-6617997e93c3b.jpg'),
(13, 'aaaaaaaas', 'sssssssssssssssss', 'Xbox', 1234567890, 4, '2024-04-01', 'copyright', '04-661799a760d08.jpg'),
(14, 'ZERRRRRRR', 'EEEEEEEEEEE', 'Nintendo Switch', 2147483647, 23, '2024-05-11', 'copyright', 'langage-661799ec567ad.png'),
(15, 'pS4', 'ssssssssss', 'pc', 23333, 22, '2024-04-24', 'copyright', 'img1-66179a1ec4e88.jpg'),
(16, 'aaaaaaaas', 'AAAAAAAAAAAAAA', 'playstation', 2147483647, 23, '2024-05-10', 'copyright', '06-66179a43a5b8d.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `jeux_commandes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`jeux_commandes`)),
  `prix_total` decimal(10,2) NOT NULL,
  `date_creation` datetime NOT NULL,
  `statut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(6, 'aimanebello100@gmail.com', '[]', '$2y$13$pKHk.pAhawo8zozKuVqbf.fGe2xVSCHDgMu.e8jzhMnhVyCdwCQIK');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_35D4282C32B700A2` (`id_jeux_id`),
  ADD KEY `IDX_35D4282CA76ED395` (`user_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `jeux`
--
ALTER TABLE `jeux`
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
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_24CC0DF2FB88E14F` (`utilisateur_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_35D4282C32B700A2` FOREIGN KEY (`id_jeux_id`) REFERENCES `jeux` (`id`),
  ADD CONSTRAINT `FK_35D4282CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `FK_24CC0DF2FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
