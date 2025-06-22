<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'blog');
define('DB_USER', 'root');
define('DB_PASS', '');

define('DEBUG', true);

if (DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
