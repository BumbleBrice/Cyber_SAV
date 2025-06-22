<?php
require_once 'models/userModel.php';

session_start();

// Si c'est un GET : afficher le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once 'views/header.php';
    require_once 'views/register.php';
    require_once 'views/footer.php';
    exit;
}

// Traitement du formulaire (POST)
$pseudo = trim($_POST['pseudo'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if ($pseudo === '' || $email === '' || $password === '' || $confirm === '') {
    $_SESSION['error'] = "All fields are required.";
    header('Location: index.php?page=register');
    exit;
}

$regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

if (!preg_match($regex, $password)) {
    $_SESSION['error'] = "Password must be at least 8 characters and include uppercase, lowercase, number, and special character.";
    header('Location: index.php?page=register');
    exit;
}

// Email valide ?
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email address.";
    header('Location: index.php?page=register');
    exit;
}

// Mots de passe identiques ?
if ($password !== $confirm) {
    $_SESSION['error'] = "Passwords do not match.";
    header('Location: index.php?page=register');
    exit;
}

// Vérifier que le pseudo ou l'email n'existent pas
if (userExists($pseudo, $email)) {
    $_SESSION['error'] = "Username or email already in use.";
    header('Location: index.php?page=register');
    exit;
}

// Hacher le mot de passe
$hash = password_hash($password, PASSWORD_DEFAULT);

// Créer l'utilisateur
createUser($pseudo, $email, $hash);

// Message de succès
$_SESSION['success'] = "Account created! Please wait for validation before logging in.";
header('Location: index.php?page=login');
exit;
