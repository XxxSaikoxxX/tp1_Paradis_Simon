-- Supprimez la table de voiture existante si elle existe déjà
DROP TABLE IF EXISTS `voiture`;

-- Structure de la table `voiture`
CREATE TABLE `voiture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) DEFAULT NULL,
  `annee_fabrication` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `prix_neuf` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Déchargement des données de la table `voiture`
INSERT INTO `voiture` (`marque`, `annee_fabrication`, `type`, `prix_neuf`) VALUES
('Toyota', 2017, 'SUV', 25000),
('Ford', 2015, 'Berline', 30000),
('Honda', 2019, 'Compacte', 20000),
('Tesla', 2022, 'Électrique', 60000),
('Chevrolet', 2020, 'SUV', 35000);

-- Réinitialise l'auto-incrémentation
ALTER TABLE `voiture` AUTO_INCREMENT = 1;
