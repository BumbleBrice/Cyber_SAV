<?php
require_once 'models/userModel.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $_SESSION['error'] = "Please fill in all required fields.";
        header('Location: index.php?page=login');
        exit;
    }

    $user = findUserByPseudoOrEmail($username);

    if ($user && password_verify($password, $user['pwd'])) {
        if ((int)$user['isValidate'] !== 1) {
            $_SESSION['error'] = "Your account has not been validated yet.";
            header('Location: index.php?page=login');
            exit;
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'pseudo' => $user['pseudo'],
            'role' => $user['role']
        ];

        $_SESSION['success'] = "Welcome, " . htmlspecialchars($user['pseudo']) . "!";
        header('Location: index.php?page=dashboard');
        exit;
    } else {
        $_SESSION['error'] = "Invalid credentials.";
        header('Location: index.php?page=login');
        exit;
    }
}

// 👉 Si on est en GET, on affiche simplement la vue
require_once 'views/header.php';
require_once 'views/login.php';
require_once 'views/footer.php';
