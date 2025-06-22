<?php

function setupDatabase() {
    try {
        // Connexion sans sélectionner de base
        $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        // Création de la BDD si elle n'existe pas
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

        // Sélection de la BDD pour les prochaines requêtes
        $pdo->exec("USE `" . DB_NAME . "`");

        // Création des tables
        $queries = [
            "CREATE TABLE IF NOT EXISTS brands (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL
            )",

            "CREATE TABLE IF NOT EXISTS components (
                id INT AUTO_INCREMENT PRIMARY KEY,
                type VARCHAR(50) NOT NULL
            )",

            "CREATE TABLE IF NOT EXISTS component_models (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                details TEXT,
                component_id INT,
                brand_id INT,
                FOREIGN KEY (component_id) REFERENCES components(id) ON DELETE SET NULL,
                FOREIGN KEY (brand_id) REFERENCES brands(id) ON DELETE SET NULL
            )",

            "CREATE TABLE IF NOT EXISTS peripherals (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                brand_id INT,
                FOREIGN KEY (brand_id) REFERENCES brands(id) ON DELETE SET NULL
            )",

            "CREATE TABLE IF NOT EXISTS setups (
                id INT AUTO_INCREMENT PRIMARY KEY,
                model VARCHAR(100) NOT NULL,
                brand_id INT,
                FOREIGN KEY (brand_id) REFERENCES brands(id) ON DELETE SET NULL
            )",

            "CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                pseudo VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                pwd VARCHAR(255) NOT NULL,
                isValidate BOOLEAN DEFAULT FALSE,
                role VARCHAR(20) DEFAULT 'user',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",

            "CREATE TABLE IF NOT EXISTS problems (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                brand_id INT,
                component_model_id INT,
                peripheral_id INT,
                setup_id INT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (brand_id) REFERENCES brands(id) ON DELETE SET NULL,
                FOREIGN KEY (component_model_id) REFERENCES component_models(id) ON DELETE SET NULL,
                FOREIGN KEY (peripheral_id) REFERENCES peripherals(id) ON DELETE SET NULL,
                FOREIGN KEY (setup_id) REFERENCES setups(id) ON DELETE SET NULL
            )"
        ];

        foreach ($queries as $query) {
            $pdo->exec($query);
        }

        echo "✅ Base de données et tables créées avec succès.";

    } catch (PDOException $e) {
        die("❌ Setup error: " . $e->getMessage());
    }
}
