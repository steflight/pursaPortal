-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 24 oct. 2017 à 14:27
-- Version du serveur :  5.6.37
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pursaco_portal`
--

-- --------------------------------------------------------

--
-- Structure de la table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `validity` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `codes`
--

INSERT INTO `codes` (`id`, `code`, `user_id`, `validity`) VALUES
(1, '8I6RSF', 17, 0),
(2, 'VYAO1M', 17, 1),
(3, 'JJCVFD', 17, 1),
(4, '5IVDKL', 18, 0),
(5, 'EUYNKH', 19, 1);

-- --------------------------------------------------------

--
-- Structure de la table `interests`
--

CREATE TABLE `interests` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `payout` varchar(255) NOT NULL,
  `percentage` float NOT NULL,
  `contract_duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `interests`
--

INSERT INTO `interests` (`id`, `package_id`, `payout`, `percentage`, `contract_duration`) VALUES
(1, 1, 'monthly', 3, 0),
(3, 2, 'monthly', 3.5, 3),
(6, 2, 'monthly', 7, 6),
(8, 3, 'monthly', 7.5, 6),
(10, 2, 'monthly', 13, 12),
(12, 3, 'monthly', 15, 12),
(13, 3, 'monthly', 3.75, 3);

-- --------------------------------------------------------

--
-- Structure de la table `investments`
--

CREATE TABLE `investments` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `issue_date` varchar(255) NOT NULL,
  `package_type` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `starting_date` varchar(255) NOT NULL,
  `payout` varchar(255) NOT NULL,
  `first_payout` varchar(255) NOT NULL,
  `last_payout` varchar(255) NOT NULL,
  `top_up_from` int(11) NOT NULL,
  `validity` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `investments`
--

INSERT INTO `investments` (`id`, `client_id`, `amount`, `issue_date`, `package_type`, `duration`, `starting_date`, `payout`, `first_payout`, `last_payout`, `top_up_from`, `validity`) VALUES
(1, 14, 1000000, 'Tuesday 24-10-2017 08:57:05am', 'premium', 12, 'Monday 30-10-2017 08:00:00am', 'monthly', 'Saturday 25-11-2017 08:00:00am', 'Saturday 29-09-2018 06:00:00am', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `minimum_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `packages`
--

INSERT INTO `packages` (`id`, `name`, `minimum_amount`) VALUES
(1, 'starter', 25000),
(2, 'business', 200000),
(3, 'premium', 1000000);

-- --------------------------------------------------------

--
-- Structure de la table `profits`
--

CREATE TABLE `profits` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `investment_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `due_date` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `duration` int(11) NOT NULL,
  `validity` tinyint(1) NOT NULL,
  `datestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profits`
--

INSERT INTO `profits` (`id`, `client_id`, `investment_id`, `amount`, `due_date`, `duration`, `validity`, `datestamp`) VALUES
(1, 14, 1, 150000, 'Saturday 02-12-2017 02:00:00pm', 12, 0, 1512223200),
(2, 14, 1, 150000, 'Saturday 06-01-2018 02:00:00pm', 12, 1, 1515247200),
(3, 14, 1, 150000, 'Saturday 10-02-2018 02:00:00pm', 12, 1, 1518271200),
(4, 14, 1, 150000, 'Saturday 17-03-2018 02:00:00pm', 12, 1, 1521295200),
(5, 14, 1, 150000, 'Saturday 21-04-2018 02:00:00pm', 12, 1, 1524319200),
(6, 14, 1, 150000, 'Saturday 26-05-2018 02:00:00pm', 12, 1, 1527343200),
(7, 14, 1, 150000, 'Saturday 30-06-2018 02:00:00pm', 12, 1, 1530367200),
(8, 14, 1, 150000, 'Saturday 04-08-2018 02:00:00pm', 12, 1, 1533391200),
(9, 14, 1, 150000, 'Saturday 08-09-2018 02:00:00pm', 12, 1, 1536415200),
(10, 14, 1, 150000, 'Saturday 13-10-2018 02:00:00pm', 12, 1, 1539439200),
(11, 14, 1, 150000, 'Saturday 17-11-2018 02:00:00pm', 12, 1, 1542463200),
(12, 14, 1, 150000, 'Saturday 22-12-2018 02:00:00pm', 12, 1, 1545487200);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` varchar(255) NOT NULL,
  `visacard` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `number`, `email`, `username`, `password`, `register_date`, `user_type`, `visacard`) VALUES
(11, 'Mr admin', 1, 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2017-09-24 16:20:04', 'admin', '0'),
(12, 'Mr client', 675119280, 'client@gmail.com', 'client', '62608e08adc29a8d6dbc9754e659f125', '2017-09-24 18:55:31', 'client', '0'),
(13, 'Mr super administrator', 1234567, 'superadmin@gmail.com', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', '2017-09-28 00:45:26', 'superadmin', '0'),
(14, 'Cyprian Nziim', 671390827, 'cypriannziim@gmail.com', 'Cyprian Nziim', '570953617899e5d9aedf0753e8fd2a53', '2017-10-16 10:20:04', '', ''),
(15, 'Test client', 64444444, 'nziimcyprian@gmail.com', 'Test Client', '', '2017-10-16 10:26:18', 'client', '4555');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profits`
--
ALTER TABLE `profits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `profits`
--
ALTER TABLE `profits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
