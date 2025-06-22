<?php
require_once 'core/db.php';

function getAllPosts() {
    $db = getDbConnection();
    $stmt = $db->query("SELECT id, title, content FROM posts ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPostById($id) {
    $db = getDbConnection();
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
