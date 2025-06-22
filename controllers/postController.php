<?php
require_once 'models/postModel.php';

$id = $_GET['id'] ?? null;
$post = getPostById($id);
require_once 'views/header.php';
require_once 'views/post.php';
require_once 'views/footer.php';
