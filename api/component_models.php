<?php
require_once __DIR__ . '/../core/db.php';


header('Content-Type: application/json');

$q = trim($_GET['q'] ?? '');
if (strlen($q) < 2) {
    echo json_encode([]);
    exit;
}

$pdo = getDbConnection();
$stmt = $pdo->prepare("
    SELECT cm.id, cm.name, b.name AS brand
    FROM component_models cm
    JOIN brands b ON cm.brand_id = b.id
    WHERE cm.name LIKE ?
    ORDER BY cm.name ASC
");
$stmt->execute(["%$q%"]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results);
