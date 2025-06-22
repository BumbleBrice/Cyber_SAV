<?php

require_once 'config.php';

// ⚠️ TEMPORAIRE – Setup de la base de données au premier lancement
require_once 'core/setup.php';
// setupDatabase(); 

// Redirige vers la page de connexion si aucune page spécifiée
if (!isset($_GET['page'])) {
    header('Location: index.php?page=login');
    exit;
}

require_once 'core/router.php';
