<?php
require_once 'admin/includes/db.php';

$local_tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
$prod_sql = file_get_contents('c:/Users/Mann/Downloads/u362391755_Vivaeng.sql');

$missing_tables = [];
$missing_columns = [];

foreach ($local_tables as $table) {
    if (strpos($prod_sql, "CREATE TABLE `$table`") === false) {
        $missing_tables[] = $table;
    } else {
        // Table exists, check columns
        $local_columns = $pdo->query("DESCRIBE $table")->fetchAll(PDO::FETCH_ASSOC);
        
        // Extract the CREATE TABLE block for this table from SQL
        preg_match("/CREATE TABLE `$table` \((.*?)\) ENGINE=/s", $prod_sql, $match);
        $prod_cols_raw = $match[1] ?? '';
        
        foreach ($local_columns as $col) {
            $col_name = $col['Field'];
            if (strpos($prod_cols_raw, "`$col_name`") === false) {
                $missing_columns[$table][] = $col;
            }
        }
    }
}

$report = [
    'missing_tables' => $missing_tables,
    'missing_columns' => $missing_columns
];

file_put_contents('final_schema_diff.json', json_encode($report, JSON_PRETTY_PRINT));
echo "Final schema diff generated.";
?>
