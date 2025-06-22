<?php

require_once 'config.php';

function getDbConnection() {
    try {
        return new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    } catch (PDOException $e) {
        if (defined('DEBUG') && DEBUG) {
            die('Database connection error: ' . $e->getMessage());
        } else {
            die('A system error occurred. Please try again later.');
        }
    }
}
