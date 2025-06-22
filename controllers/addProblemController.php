<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=home');
    exit;
}

require_once 'core/db.php';

$pdo = getDbConnection();
$errors = [];
$success = false;

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $brand_id = $_POST['brand_id'] ?? null;
    $new_brand = trim($_POST['new_brand'] ?? '');
    $component_model_id = $_POST['component_model_id'] ?? null;
    $peripheral_id = $_POST['peripheral_id'] ?? null;
    $setup_id = $_POST['setup_id'] ?? null;

    if (empty($title)) $errors[] = "Le titre est requis.";
    if (empty($description)) $errors[] = "La description est requise.";

    // Ajouter une nouvelle marque si fournie
    if (empty($brand_id) && !empty($new_brand)) {
        $stmt = $pdo->prepare("INSERT INTO brands (name) VALUES (?)");
        $stmt->execute([$new_brand]);
        $brand_id = $pdo->lastInsertId();
    }

    if (empty($brand_id)) $errors[] = "Veuillez choisir ou ajouter une marque.";

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO problems (title, description) VALUES (?, ?)");
        $stmt->execute([$title, $description]);
        $problemId = $pdo->lastInsertId();

        // Ajout des liens
        $stmt = $pdo->prepare("INSERT INTO problem_links (problem_id, target_type, target_id) VALUES (?, ?, ?)");
        if ($component_model_id) $stmt->execute([$problemId, 'component_model', $component_model_id]);
        if ($peripheral_id) $stmt->execute([$problemId, 'peripheral', $peripheral_id]);
        if ($setup_id) $stmt->execute([$problemId, 'setup', $setup_id]);

        $success = true;
    }
}

// Données pour les listes déroulantes
$brands = $pdo->query("SELECT id, name FROM brands ORDER BY name")->fetchAll();
$componentModels = $pdo->query("SELECT cm.id, cm.name, b.name AS brand FROM component_models cm JOIN brands b ON cm.brand_id = b.id ORDER BY b.name, cm.name")->fetchAll();
$peripherals = $pdo->query("SELECT id, name FROM peripherals ORDER BY name")->fetchAll();
$setups = $pdo->query("SELECT id, model FROM setups ORDER BY model")->fetchAll();

require_once 'views/header.php';
require_once 'views/add_problem.php';
require_once 'views/footer.php';
