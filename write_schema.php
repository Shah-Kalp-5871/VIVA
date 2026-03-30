<?php
require_once 'admin/includes/functions.php';
$stmt = $pdo->query("DESCRIBE products");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($rows as $row) {
    $output .= $row['Field'] . " | " . $row['Type'] . "\n";
}
file_put_contents('schema_output.txt', $output);
?>
