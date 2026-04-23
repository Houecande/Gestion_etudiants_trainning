-- Création de la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS gestions_etudiants_trainning;
-- Selection de la base de données
USE gestions_etudiants_trainning;
-- Créatiom de la table filières
CREATE TABLE IF NOT EXISTS filieres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);
-- création de la table étudiants
CREATE TABLE IF NOT EXISTS etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,          
    prenom VARCHAR(255) NOT NULL,      
    filiere_id INT,                    
    -- Définition de la relation entre etudiants et filieres
    FOREIGN KEY (filiere_id) REFERENCES filieres(id)
);
-- Insertion de données de test dans la table filieres
INSERT INTO filieres (nom) VALUES 
('Systèmes Industriel'),
('Energie Renouvelable'),
('Réseaux Informatique et Télécom'),
('Systèmes Informatique et Logiciel');

    
    
    