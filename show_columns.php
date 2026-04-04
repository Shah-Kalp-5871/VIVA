<?php
require_once 'admin/includes/db.php';
$stmt = $pdo->query('DESCRIBE products');
foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo $row['Field'] . "\n";
}
?>
