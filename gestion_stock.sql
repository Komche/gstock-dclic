-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 11 mai 2023 à 21:25
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.4.15
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
--
-- Base de données : `gestion_stock_dclic`
--

-- --------------------------------------------------------
--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `nom_article` varchar(50) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `date_fabrication` datetime NOT NULL,
  `date_expiration` datetime NOT NULL,
  `images` varchar(255) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (
    `id`,
    `nom_article`,
    `id_categorie`,
    `quantite`,
    `prix_unitaire`,
    `date_fabrication`,
    `date_expiration`,
    `images`
  )
VALUES (
    1,
    'HP',
    1,
    3,
    200000,
    '2022-09-15 22:32:00',
    '2022-09-18 19:36:00',
    NULL
  ),
  (
    2,
    'Imprimante scanner',
    2,
    1,
    50000,
    '2022-09-09 20:41:00',
    '2022-10-02 19:47:00',
    NULL
  ),
  (
    3,
    'Cable VGA',
    3,
    65,
    1500,
    '2022-09-18 18:55:00',
    '2022-09-16 18:57:00',
    NULL
  ),
  (
    4,
    'souris',
    3,
    105,
    6000,
    '2022-09-16 19:58:00',
    '2022-09-16 19:02:00',
    NULL
  ),
  (
    5,
    'Ecouteur',
    3,
    3,
    1000,
    '2022-09-23 00:26:00',
    '2022-09-23 20:33:00',
    NULL
  ),
  (
    6,
    'Chargeur',
    3,
    35,
    500,
    '2022-09-23 22:27:00',
    '2022-09-23 01:27:00',
    NULL
  ),
  (
    7,
    'HP 15',
    1,
    7,
    7888,
    '2023-03-04 18:13:00',
    '2023-03-04 18:13:00',
    NULL
  ),
  (
    8,
    'Télécommande',
    3,
    10,
    1000,
    '2023-03-03 18:35:00',
    '2023-04-09 18:35:00',
    '../public/images/WhatsApp Image 2023-01-23 at 12.57.19.jpeg'
  );
-- --------------------------------------------------------
--
-- Structure de la table `categorie_article`
--

CREATE TABLE `categorie_article` (
  `id` int(11) NOT NULL,
  `libelle_categorie` varchar(60) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Déchargement des données de la table `categorie_article`
--

INSERT INTO `categorie_article` (`id`, `libelle_categorie`)
VALUES (1, 'Ordinateur'),
  (2, 'Imprimante'),
  (3, 'Accessoire');
-- --------------------------------------------------------
--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `adresse` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `telephone`, `adresse`)
VALUES (
    1,
    'Adamou',
    'Abdoul Razak',
    '+22798960382',
    'Tahoua Niger'
  ),
  (
    2,
    'Maiga',
    'Abdoul rachid Amadou',
    '+22758907514',
    '45 rue saint pallais'
  );
-- --------------------------------------------------------
--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (
    `id`,
    `id_article`,
    `id_fournisseur`,
    `quantite`,
    `prix`,
    `date_commande`
  )
VALUES (1, 2, 2, 4, 200000, '2022-09-23 17:54:48'),
  (2, 4, 1, 5, 30000, '2022-09-23 17:56:45'),
  (3, 1, 2, 12, 2400000, '2022-09-23 19:23:07'),
  (4, 4, 2, 56, 336000, '2022-09-24 10:23:22');
-- --------------------------------------------------------
--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `adresse` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `prenom`, `telephone`, `adresse`)
VALUES (
    1,
    'Komche',
    'Issa',
    '+22792470763',
    'Yantala, Niamey'
  ),
  (
    2,
    'MAMAN SANI',
    'HASSAN',
    '+22798655425',
    'Zinder, Jeune cadre'
  );
-- --------------------------------------------------------
--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `date_vente` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat` enum('0', '1') NOT NULL DEFAULT '1'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (
    `id`,
    `id_article`,
    `id_client`,
    `quantite`,
    `prix`,
    `date_vente`,
    `etat`
  )
VALUES (3, 1, 2, 1, 200000, '2022-09-21 06:31:25', '0'),
  (4, 2, 1, 5, 230000, '2022-09-21 06:35:14', '1'),
  (5, 4, 1, 2, 12000, '2022-09-21 18:24:18', '0'),
  (6, 3, 2, 6, 9000, '2022-09-23 19:24:12', '1'),
  (7, 1, 2, 10, 2000000, '2022-09-23 19:25:08', '1'),
  (8, 4, 1, 20, 120000, '2022-09-23 19:25:17', '1'),
  (9, 5, 1, 5, 5000, '2022-09-23 19:31:02', '1'),
  (10, 1, 1, 5, 1000000, '2022-09-23 19:48:16', '1'),
  (11, 2, 2, 3, 150000, '2022-09-23 19:48:23', '1'),
  (12, 5, 1, 2, 2000, '2022-09-23 19:48:29', '1'),
  (13, 6, 1, 40, 20000, '2022-09-23 19:48:37', '1'),
  (14, 4, 1, 15, 90000, '2022-09-23 19:48:46', '1'),
  (15, 6, 2, 5, 2500, '2022-09-23 19:49:01', '1'),
  (16, 3, 1, 13, 19500, '2022-09-23 19:49:07', '1'),
  (17, 1, 2, 1, 200000, '2022-09-23 19:49:12', '1'),
  (18, 4, 2, 3, 18000, '2022-09-23 19:49:20', '1'),
  (19, 4, 2, 8, 48000, '2022-09-24 09:07:14', '1'),
  (20, 2, 1, 3, 150000, '2022-09-24 10:23:57', '1');
--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`);
--
-- Index pour la table `categorie_article`
--
ALTER TABLE `categorie_article`
ADD PRIMARY KEY (`id`);
--
-- Index pour la table `client`
--
ALTER TABLE `client`
ADD PRIMARY KEY (`id`);
--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_fournisseur` (`id_fournisseur`);
--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
ADD PRIMARY KEY (`id`);
--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_client` (`id_client`);
--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 9;
--
-- AUTO_INCREMENT pour la table `categorie_article`
--
ALTER TABLE `categorie_article`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;
--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT pour la table `vente`
--
ALTER TABLE `vente`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 21;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id`);
--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
ADD CONSTRAINT `vente_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `vente_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`);
COMMIT;

CREATE TABLE contact (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(2) NOT NULL,
  `prenom` VARCHAR(3) NOT NULL,
  `email` VARCHAR(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO contact (id, nom, prenom, email, numero_de_téléphone)
VALUES
    (1, 'Jaharou', 'Amadou', 'j.amadou@example.com', '1234567890'),
    (2, 'Kalle', 'Youssouf', 'kalle.youssouf@example.com', '9876543210');

SELECT * FROM contact;


UPDATE contact
SET email = 'jaha.amadou.@example.com'
WHERE id = 1;

DELETE FROM contact
WHERE id = 2;

