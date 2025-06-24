<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

require_once 'core/db.php';

$pdo = getDbConnection();
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $brand_id = $_POST['brand_id'] ?: null;
    $new_brand = trim($_POST['new_brand'] ?? '');

    $component_id = $_POST['component_id'] ?? null;
    $new_component_type = trim($_POST['new_component_type'] ?? '');

    $component_model_id = $_POST['component_model_id'] ?: null;
    $new_component_model = trim($_POST['new_component_model'] ?? '');

    $peripheral_id = $_POST['peripheral_id'] ?: null;
    $new_peripheral = trim($_POST['new_peripheral'] ?? '');

    $setup_id = $_POST['setup_id'] ?: null;
    $new_setup = trim($_POST['new_setup'] ?? '');

    $user_id = $_SESSION['user']['id'];

    if (empty($title)) $errors[] = "Le titre est requis.";
    if (empty($description)) $errors[] = "La description est requise.";

    // Marque
    if (!$brand_id && $new_brand !== '') {
        $stmt = $pdo->prepare("INSERT INTO brands (name) VALUES (?)");
        $stmt->execute([$new_brand]);
        $brand_id = $pdo->lastInsertId();
    }

    // Type de composant
    if (!$component_id && $new_component_type !== '') {
        $stmt = $pdo->prepare("INSERT INTO components (type) VALUES (?)");
        $stmt->execute([$new_component_type]);
        $component_id = $pdo->lastInsertId();
    }

    // Modèle de composant
    if (!$component_model_id && $new_component_model !== '' && $component_id && $brand_id) {
        $stmt = $pdo->prepare("INSERT INTO component_models (name, component_id, brand_id) VALUES (?, ?, ?)");
        $stmt->execute([$new_component_model, $component_id, $brand_id]);
        $component_model_id = $pdo->lastInsertId();
    }

    // Périphérique
    if (!$peripheral_id && $new_peripheral !== '' && $brand_id) {
        $stmt = $pdo->prepare("INSERT INTO peripherals (name, brand_id) VALUES (?, ?)");
        $stmt->execute([$new_peripheral, $brand_id]);
        $peripheral_id = $pdo->lastInsertId();
    }

    // Setup
    if (!$setup_id && $new_setup !== '' && $brand_id) {
        $stmt = $pdo->prepare("INSERT INTO setups (model, brand_id) VALUES (?, ?)");
        $stmt->execute([$new_setup, $brand_id]);
        $setup_id = $pdo->lastInsertId();
    }

    // Problème
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO problems (
            title, description, brand_id, component_model_id,
            peripheral_id, setup_id, component_id, user_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $title,
            $description,
            $brand_id ?: null,
            $component_model_id ?: null,
            $peripheral_id ?: null,
            $setup_id ?: null,
            $component_id ?: null,
            $user_id
        ]);

        $success = true;
    }
}

// Données
$brands = $pdo->query("SELECT id, name FROM brands ORDER BY name")->fetchAll();
$components = $pdo->query("SELECT id, type FROM components ORDER BY type")->fetchAll();
$componentModels = $pdo->query("SELECT cm.id, cm.name, b.name AS brand FROM component_models cm JOIN brands b ON cm.brand_id = b.id ORDER BY b.name, cm.name")->fetchAll();
$peripherals = $pdo->query("SELECT id, name FROM peripherals ORDER BY name")->fetchAll();
$setups = $pdo->query("SELECT id, model FROM setups ORDER BY model")->fetchAll();

require_once 'views/header.php';
require_once 'views/add_problem.php';
require_once 'views/footer.php';
