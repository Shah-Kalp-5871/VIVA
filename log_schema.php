<?php
require_once 'admin/includes/functions.php';
$stmt = $pdo->query("DESCRIBE products");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "SCHEMA LOG - " . date('Y-m-d H:i:s') . "\n";
foreach ($rows as $row) {
    $output .= $row['Field'] . " (" . $row['Type'] . ")\n";
}
file_put_contents('definitive_schema.txt', $output);
echo "Logged " . count($rows) . " columns.";
?>
