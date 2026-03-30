<?php
require_once 'admin/includes/functions.php';
$stmt = $pdo->query("DESCRIBE products");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {
    echo "COL: " . $row['Field'] . " | TYPE: " . $row['Type'] . "\n";
}
?>
