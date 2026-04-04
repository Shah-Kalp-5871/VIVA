<?php
require_once 'admin/includes/db.php';

/**
 * Robust Database Schema Comparer
 * Local SQL vs Production Dump
 */

$local_tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
$prod_sql = file_get_contents('c:/Users/Mann/Downloads/u362391755_Vivaeng.sql');

$final_queries = [];

// 1. Missing Settings Data (CRITICAL: Users adds settings locally)
preg_match("/INSERT INTO `settings`.*?VALUES.*?;/s", $prod_sql, $match);
$settings_insert_block = $match[0] ?? '';
$local_settings = $pdo->query("SELECT * FROM settings")->fetchAll(PDO::FETCH_ASSOC);

foreach ($local_settings as $s) {
    // Check if the field_key exists in the prod SQL block
    if (strpos($settings_insert_block, "'{$s['field_key']}'") === false) {
        $val = addslashes($s['field_value']);
        $label = addslashes($s['field_label']);
        $group = addslashes($s['group_name']);
        $final_queries[] = "INSERT IGNORE INTO `settings` (field_key, field_value, field_label, group_name) VALUES ('{$s['field_key']}', '$val', '$label', '$group');";
    }
}

// 2. Table & Column Comparison
foreach ($local_tables as $table) {
    // Check if table exists in Prod SQL
    $table_exists_in_prod = preg_match("/CREATE TABLE `$table`/", $prod_sql);

    if (!$table_exists_in_prod) {
        $create = $pdo->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_ASSOC)['Create Table'];
        // Use IF NOT EXISTS for safety
        $create = str_replace("CREATE TABLE", "CREATE TABLE IF NOT EXISTS", $create);
        $final_queries[] = $create . ";";
        continue;
    }

    // Table exists, check for missing columns
    // Extract the CREATE TABLE block for this specific table
    preg_match("/CREATE TABLE `$table` \((.*?)\) ENGINE=/s", $prod_sql, $tableMatch);
    $prod_table_def = $tableMatch[1] ?? '';

    $local_cols = $pdo->query("DESCRIBE `$table`")->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($local_cols as $lcol) {
        $col_name = $lcol['Field'];
        
        // Regex to check if column exists in the prod definition
        // Matches `col_name` type ...
        if (!preg_match("/`$col_name`/", $prod_table_def)) {
            $type = $lcol['Type'];
            $null = ($lcol['Null'] === 'YES') ? 'NULL' : 'NOT NULL';
            $default = ($lcol['Default'] !== null) ? "DEFAULT '" . addslashes($lcol['Default']) . "'" : (($lcol['Null'] === 'YES') ? "DEFAULT NULL" : "");
            $extra = $lcol['Extra']; // auto_increment, etc.
            
            $final_queries[] = "ALTER TABLE `$table` ADD COLUMN `$col_name` $type $null $default $extra;";
        }
    }
}

// Write to final artifact
$output = "-- FINAL DATABASE SYNC SCRIPT (LOCAL -> PROD)\n";
$output .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$output .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
$output .= "START TRANSACTION;\n\n";
$output .= implode("\n\n", $final_queries);
$output .= "\n\nCOMMIT;";

file_put_contents('final_prod_sync.sql', $output);
echo "Final sync script generated in final_prod_sync.sql";
?>
