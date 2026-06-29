-- Script SQL pour la base de données gestion_commerciale
CREATE DATABASE IF NOT EXISTS gestion_commerciale CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE gestion_commerciale;

CREATE TABLE IF NOT EXISTS client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(30) NOT NULL,
    adresse VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS produit (
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    nom_produit VARCHAR(150) NOT NULL,
    prix DECIMAL(12,2) NOT NULL DEFAULT 0,
    quantite INT NOT NULL DEFAULT 0
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS livreur (
    id_livreur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(30) NOT NULL,
    matricule_moto VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS commande (
    id_commande INT AUTO_INCREMENT PRIMARY KEY,
    date_commande DATE NOT NULL,
    montant DECIMAL(12,2) NOT NULL DEFAULT 0,
    statut VARCHAR(50) NOT NULL,
    id_client INT NOT NULL,
    id_livreur INT NOT NULL,
    FOREIGN KEY (id_client) REFERENCES client(id_client) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_livreur) REFERENCES livreur(id_livreur) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS details_commande (
    id_detail INT AUTO_INCREMENT PRIMARY KEY,
    id_produit INT NOT NULL,
    id_commande INT NOT NULL,
    quantite INT NOT NULL,
    montant DECIMAL(12,2) NOT NULL DEFAULT 0,
    FOREIGN KEY (id_produit) REFERENCES produit(id_produit) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (id_commande) REFERENCES commande(id_commande) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS facture (
    id_facture INT AUTO_INCREMENT PRIMARY KEY,
    date_facture DATE NOT NULL,
    montant DECIMAL(12,2) NOT NULL DEFAULT 0,
    id_commande INT NOT NULL,
    FOREIGN KEY (id_commande) REFERENCES commande(id_commande) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS paiement (
    id_paiement INT AUTO_INCREMENT PRIMARY KEY,
    date_paiement DATE NOT NULL,
    montant DECIMAL(12,2) NOT NULL DEFAULT 0,
    type_paiement VARCHAR(50) NOT NULL,
    id_facture INT NOT NULL,
    FOREIGN KEY (id_facture) REFERENCES facture(id_facture) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;
