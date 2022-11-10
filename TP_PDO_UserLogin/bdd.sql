SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Base de données : `loginjson`
--
--
-- Structure de la table `users`
--
CREATE TABLE `users` (
`Id` int(11) NOT NULL,
`Login` varchar(32) NOT NULL,
`Passwd` varchar(32) NOT NULL,
`Email` varchar(32) NOT NULL,
`Sexe` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Contenu de la table `users`
--
INSERT INTO `users` (`Id`, `Login`, `Passwd`, `Email`, `Sexe`) VALUES
(1, 'bibi', 'bibi', 'bibi.bibi@gmail.com', 'Female'),
(2, 'bobo', 'bobo', 'bobo.bobo@gmail.com', 'Male');
--
-- Index pour les tables exportées
--
--
-- Index pour la table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`Id`),
ADD UNIQUE KEY `Login` (`Login`,`Passwd`,`Email`,`Sexe`);
--
-- AUTO_INCREMENT pour les tables exportées
--
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;