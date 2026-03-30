<?php
$host = 'localhost';
$db   = 'viva_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $c = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
    $p = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
    echo "CATEGORIES: $c\n";
    echo "PRODUCTS: $p\n";
    
    echo "\nSAMPLE CATEGORIES:\n";
    $cats = $pdo->query("SELECT name, status FROM categories LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
    print_r($cats);
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
