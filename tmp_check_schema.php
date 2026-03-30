<?php
$pdo = new PDO('mysql:host=localhost;dbname=viva_db', 'root', '');
$stmt = $pdo->query('DESCRIBE products');
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    printf("%-20s %-20s\n", $row['Field'], $row['Type']);
}
