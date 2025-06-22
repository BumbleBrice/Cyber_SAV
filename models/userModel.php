<?php
require_once 'core/db.php';

function findUserByPseudoOrEmail($identifier) {
    $db = getDbConnection();
    $stmt = $db->prepare("SELECT * FROM users WHERE pseudo = :id OR email = :id");
    $stmt->execute(['id' => $identifier]);
    return $stmt->fetch();
}

function userExists($pseudo, $email) {
    $db = getDbConnection();
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE pseudo = ? OR email = ?");
    $stmt->execute([$pseudo, $email]);
    return $stmt->fetchColumn() > 0;
}

function createUser($pseudo, $email, $hashedPassword) {
    $db = getDbConnection();
    $stmt = $db->prepare("
        INSERT INTO users (pseudo, email, pwd, isValidate, role)
        VALUES (?, ?, ?, 0, 'user')
    ");
    return $stmt->execute([$pseudo, $email, $hashedPassword]);
}

