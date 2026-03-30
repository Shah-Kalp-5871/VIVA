<?php
$pdo = new PDO('mysql:host=localhost;dbname=viva_db', 'root', '');
$stmt = $pdo->query("SELECT name, slug FROM products WHERE name LIKE '%Aluminium Jumbo%'");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['name'] . " => " . $row['slug'] . "\n";
}
