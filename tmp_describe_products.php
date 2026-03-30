<?php
require_once __DIR__ . '/admin/includes/db.php';
$stmt = $pdo->query("DESCRIBE products");
$cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($cols, JSON_PRETTY_PRINT);
?>
