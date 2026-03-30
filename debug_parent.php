<?php
require_once 'admin/includes/db.php';

$cats = $pdo->query("SELECT id, name, parent_id FROM categories")->fetchAll(PDO::FETCH_ASSOC);
echo "--- CATEGORY PARENT CHECK ---\n";
foreach ($cats as $c) {
    $parent = $c['parent_id'];
    $type = gettype($parent);
    echo "ID: {$c['id']} | Name: {$c['name']} | Parent: [" . ($parent ?? 'NULL') . "] Type: $type\n";
}
echo "--- END ---";
