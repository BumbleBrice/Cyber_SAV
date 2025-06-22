<?php

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'login':
        require_once 'controllers/loginController.php';
        break;

    case 'register':
        require_once 'controllers/registerController.php';
        break;
    
    case 'logout':
        require_once 'controllers/logoutController.php';
        break;

    case 'dashboard':
        require_once 'controllers/dashboardController.php';
        break;

    case 'add-problem':
        require_once 'controllers/addProblemController.php';
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Page not found</h1>";
        break;
}
