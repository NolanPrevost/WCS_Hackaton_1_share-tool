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
-- Creation de la base de données
--
DROP DATABASE IF EXISTS share_tools;
CREATE DATABASE share_tools;

USE share_tools;

--
-- Structure de la table `pot`
--

CREATE TABLE `pot` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Structure de la table `tool`
--

CREATE TABLE `tool` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(80) NOT NULL,
  `booking_start` date DEFAULT NULL,
  `booking_end` date DEFAULT NULL,
  `image` VARCHAR(255) NOT NULL,
  `is_booked` TINYINT (1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `firstname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Structure de la table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(80) NOT NULL,
  `price` int(11) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `website` VARCHAR(255) NOT NULL,
  `vote` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `vote` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  CONSTRAINT fk_vote_user
  FOREIGN KEY (user_id)
  REFERENCES user(id),
  `wishlist_id` int(11) NOT NULL,
  CONSTRAINT fk_vote_wishlist
  FOREIGN KEY (wishlist_id)
  REFERENCES wishlist(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Insert tools
--
INSERT INTO `tool` (`name`, `booking_start`, `booking_end`, `image`, `is_booked`) VALUES
('Marteau', NULL, NULL, 'https://i.ibb.co/Kbgf2t4/Adobe-Stock-430355929.jpg', 0),
('Pistolet laser', NULL, NULL, 'https://i.ibb.co/0rn0hFL/Adobe-Stock-463917493.jpg', 0),
('Nimbus 2000', NULL, NULL, 'https://i.ibb.co/mFHByRh/Adobe-Stock-403407802.jpg', 0);

--
-- Insert wishlist
--
INSERT INTO `wishlist` (`name`, `price`, `image`, `website`) VALUES
('Sabre laser', 280, 'https://static.lacitedesnuages.be/153097-large_default/star-wars-episode-ix-black-series-replique-11-sabre-laser-force-fx-elite-leia-organa.webp', 'https://www.micromania.fr/replique-black-series-star-wars-sabre-laser-leia-force-fx-elite-116646.html'),
('Appareil à raclette', 48,'https://www.backmarket.fr/cdn-cgi/image/format=auto,quality=75,width=3840/https://d1eh9yux7w8iql.cloudfront.net/product_images/1575526783.81.jpg', 'https://www.backmarket.fr/grill-raclette-oneconcept-woklette-pas-cher/309945.html#l=10'),
('Appareil à fondue', 50, 'https://www.papillesetpupilles.fr/wp-content/uploads/2019/07/Fondue-savoyarde-%C2%A9margouillat-photo-shutterstock.jpg', 'https://www.backmarket.fr/appareil-a-fondue-tefal-ef351412-pas-cher/261725.html?shopping=gmc&gclid=Cj0KCQjw4PKTBhD8ARIsAHChzRIYk0yOuA-rpWiTjjcPBtK3pFgKkhR3OdfIJRx-NHK_TZN24d2FD9oaAsiOEALw_wcB#?l=12'),
('Glacière électrique', 55, 'https://www.backmarket.fr/cdn-cgi/image/format=auto,quality=75,width=3840/https://d1eh9yux7w8iql.cloudfront.net/product_images/1524819912.57.jpg', 'https://www.backmarket.fr/severin-kb2922-glaciere-electrique-20l-cool-box-pas-cher/12302.html#l=10');

--
-- Insert users
--
INSERT INTO `user` (`firstname`, `lastname`) VALUES
('Bob', 'Léponge'),
('Ranma', 'Demi'),
('Dark', 'Vador'),
('Sailor', 'Moon');

--
-- Insert pot
--
INSERT INTO `pot` (`amount`) VALUES
('300');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;