<?php
require_once 'admin/includes/db.php';

$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
$schema = [];

foreach ($tables as $table) {
    $columns = $pdo->query("DESCRIBE $table")->fetchAll(PDO::FETCH_ASSOC);
    $schema[$table] = $columns;
}

file_put_contents('local_schema.json', json_encode($schema, JSON_PRETTY_PRINT));
echo "Local schema dumped to local_schema.json";
?>
