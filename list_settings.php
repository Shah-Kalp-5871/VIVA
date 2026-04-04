<?php
require_once 'admin/includes/db.php';
$stmt = $pdo->query('SELECT field_key FROM settings');
foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo $row['field_key'] . "\n";
}
?>
