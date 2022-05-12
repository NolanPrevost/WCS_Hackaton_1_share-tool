-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 12 mai 2022 à 17:24
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `share_tools`
--

-- --------------------------------------------------------

--
-- Structure de la table `pot`
--

CREATE TABLE `pot` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tool`
--

CREATE TABLE `tool` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `booking_start` date DEFAULT NULL,
  `booking_end` date DEFAULT NULL
  'image' VARCHAR(255) NOT NULL,
  `is_booked` TINYINT (1) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tool`
--

INSERT INTO `tool` (`id`, `name`, `booking_start`, `booking_end`, `is_booked`) VALUES
(1, 'Marteau', NULL, NULL, 1),
(2, 'Pistolet laser', NULL, NULL, 1),
(3, 'Nimbus 2000', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`) VALUES
(1, 'Bob', 'Léponge'),
(2, 'Ranma', 'Demi'),
(3, 'Dark', 'Vador'),
(4, 'Sailor', 'Moon'),

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `vote` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_wishlist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `price` int(11) NOT NULL,
  `vote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`id`, `name`, `price`, `vote`) VALUES
(3, 'Sabre laser', 1000, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pot`
--
ALTER TABLE `pot`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tool`
--
ALTER TABLE `tool`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pot`
--
ALTER TABLE `pot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tool`
--
ALTER TABLE `tool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

INSERT INTO tool (name, booking_start, booking_end, image, ) VALUES 
('Shiro', '15.05.2022', '25.05.2022', 'https://i.ibb.co/Kbgf2t4/Adobe-Stock-430355929.jpg',),
('Atokuchi', '17.05.2022', '27.05.2022', 'https://i.ibb.co/0rn0hFL/Adobe-Stock-463917493.jpg',),
('Akibine', '19.05.2022', '29.05.2022', 'https://i.ibb.co/mFHByRh/Adobe-Stock-403407802.jpg',),

INSERT INTO user (firstname, lastname) VALUES
('Bob', 'Léponge'), 
('Ranma', 'Demi'), 
('Dark', 'Vador'), 
('Sailor', 'Moon');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
