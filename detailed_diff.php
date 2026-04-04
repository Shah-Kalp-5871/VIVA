<?php
require_once 'admin/includes/db.php';
$prod_sql = file_get_contents('c:/Users/Mann/Downloads/u362391755_Vivaeng.sql');

$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
$diff = [];

foreach ($tables as $table) {
    if (strpos($prod_sql, "CREATE TABLE `$table`") === false) {
        $diff[] = "CREATE TABLE `$table` missing.";
    } else {
        $cols = $pdo->query("DESCRIBE `$table`")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cols as $col) {
            $name = $col['Field'];
            if (strpos($prod_sql, "`$name`") === false) {
                $diff[] = "Column `$table`.`$name` missing.";
            }
        }
    }
}

file_put_contents('detailed_diff.txt', implode("\n", $diff));
echo "Detailed diff written to detailed_diff.txt";
?>
