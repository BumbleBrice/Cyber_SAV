<?php
require_once 'models/postModel.php';

$posts = getAllPosts();
require_once 'views/header.php';
require_once 'views/home.php';
require_once 'views/footer.php';
