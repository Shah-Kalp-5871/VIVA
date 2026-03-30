<?php
require 'admin/includes/db.php';
echo "--- PRODUCTS TABLE ---\n";
$res = $pdo->query("DESCRIBE products");
while($row = $res->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}
echo "\n--- CATEGORIES TABLE ---\n";
$res = $pdo->query("DESCRIBE categories");
while($row = $res->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}
?>
