<?php
$pdo = new PDO('mysql:host=localhost;dbname=viva_db', 'root', '');
$stmt = $pdo->query('DESCRIBE products');
$cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($cols as $col) {
    echo $col['Field'] . " (" . $col['Type'] . ")\n";
}
