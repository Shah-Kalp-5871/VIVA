<?php
require_once 'admin/includes/db.php';
$out = "";
try {
    $c = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
    $p = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
    $out .= "Categories: $c\n";
    $out .= "Products: $p\n";
    
    $res = $pdo->query("SELECT name FROM categories WHERE parent_id IS NULL ORDER BY id ASC");
    $out .= "\nMain Groups:\n";
    while($row = $res->fetch()) {
        $out .= "- " . $row['name'] . "\n";
    }
} catch (Exception $e) {
    $out .= "DB ERROR: " . $e->getMessage();
}
file_put_contents('db_check_result.txt', $out);
echo "DONE";
