<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PC Troubleshooter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="?page=home">
                🛠️ PC Troubleshooter
            </a>
        </div>
    </nav>

    <!-- Messages (accessible alert) -->
    <?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
    <?php if (!empty($_SESSION['error']) || !empty($_SESSION['success'])): ?>
        <div class="notification
            <?= !empty($_SESSION['error']) ? 'is-danger' : 'is-success' ?>"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
        >
            <?= htmlspecialchars($_SESSION['error'] ?? $_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['error'], $_SESSION['success']); ?>
    <?php endif; ?>
    <?php if (!empty($_SESSION['user'])): ?>
    <div class="has-background-light p-3 mb-4">
        <div class="container is-flex is-justify-content-space-between is-align-items-center">
            <div>
                <strong>Bonjour, <?= htmlspecialchars($_SESSION['user']['pseudo']) ?> 👋</strong>
            </div>
            <div>
                <a href="?page=logout" class="button is-small is-danger" role="button" aria-label="Se déconnecter">
                    Déconnexion
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>
