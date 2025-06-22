<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        require_once 'controllers/homeController.php';
        break;
    case 'post':
        require_once 'controllers/postController.php';
        break;
    default:
        echo "404 - Page introuvable";
}
