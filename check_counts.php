<?php
require_once 'admin/includes/db.php';
$pCount = $pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
$cCount = $pdo->query('SELECT COUNT(*) FROM categories')->fetchColumn();
echo "PRODUCTS_COUNT: $pCount\n";
echo "CATEGORIES_COUNT: $cCount\n";
?>
