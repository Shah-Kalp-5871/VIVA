<?php
include 'admin/includes/db.php';
$stmt = $pdo->query("SELECT name, slug, image FROM categories WHERE status = 'active'");
$cats = $stmt->fetchAll();
echo "Count: " . count($cats) . "\n";
foreach($cats as $cat) {
    echo $cat['name'] . " (" . $cat['slug'] . ")\n";
}
?>
