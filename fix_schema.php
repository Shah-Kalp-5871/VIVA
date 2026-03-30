<?php
require_once 'admin/includes/functions.php';

try {
    $pdo->exec("ALTER TABLE products CHANGE full_description description LONGTEXT");
    echo "SUCCESS: Renamed full_description to description\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    // Check if it already has description
    $stmt = $pdo->query("DESCRIBE products");
    $cols = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (in_array('description', $cols)) {
        echo "INFO: 'description' column already exists.\n";
    }
}

// Final check
$stmt = $pdo->query("DESCRIBE products");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . "\n";
}
?>
