<?php
session_start();

// Rediriger si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

require_once 'views/header.php';
require_once 'views/dashboard.php';
require_once 'views/footer.php';
