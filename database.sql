CREATE DATABASE IF NOT EXISTS sport_reserve CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sport_reserve;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS terrains (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    categorie_id INT NOT NULL,
    description TEXT,
    prix_heure DECIMAL(10,2) NOT NULL,
    localisation VARCHAR(255),
    image VARCHAR(255),
    statut ENUM('disponible', 'indisponible') DEFAULT 'disponible',
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    terrain_id INT NOT NULL,
    date_reservation DATE NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    statut ENUM('en_attente', 'validee', 'refusee', 'annulee') DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (terrain_id) REFERENCES terrains(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    terrain_id INT NOT NULL,
    note INT NOT NULL CHECK(note >= 1 AND note <= 5),
    commentaire TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (terrain_id) REFERENCES terrains(id) ON DELETE CASCADE
);

-- Insert admin user (password: admin123)
INSERT INTO users (nom, prenom, email, password, role) 
VALUES ('Admin', 'Super', 'admin@sportreserve.com', '$2y$10$7W3b1x5QYV.U6kP.K.zHMeUu9uR7kHwSj6P5E1M2XG6vVb2dD8O0u', 'admin') 
ON DUPLICATE KEY UPDATE email=email;

-- Insert default categories
INSERT IGNORE INTO categories (id, nom, description) VALUES 
(1, 'Football', 'Terrains de football (gazon synthétique ou naturel)'),
(2, 'Tennis', 'Courts de tennis (terre battue ou dur)'),
(3, 'Padel', 'Courts de padel (vitrés)'),
(4, 'Basketball', 'Terrains de basketball en salle ou en extérieur');
