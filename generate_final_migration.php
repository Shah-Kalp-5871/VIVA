<?php
require_once 'admin/includes/db.php';

$local_tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
$prod_sql = file_get_contents('c:/Users/Mann/Downloads/u362391755_Vivaeng.sql');

$migrations = [];

foreach ($local_tables as $table) {
    // 1. Table missing?
    if (strpos($prod_sql, "CREATE TABLE `$table`") === false) {
        $create_stmt = $pdo->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_ASSOC)['Create Table'];
        $migrations[] = "-- Missing table: $table\n$create_stmt;";
        continue;
    }

    // 2. Extract Prod columns from SQL
    preg_match("/CREATE TABLE `$table` \((.*?)\) ENGINE=/s", $prod_sql, $match);
    $prod_cols_block = $match[1] ?? '';
    
    // 3. Get local columns metadata
    $local_cols = $pdo->query("DESCRIBE `$table`")->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($local_cols as $lcol) {
        $name = $lcol['Field'];
        $type = $lcol['Type'];
        $null = $lcol['Null'] === 'YES' ? 'NULL' : 'NOT NULL';
        $default = $lcol['Default'] !== null ? "DEFAULT '{$lcol['Default']}'" : ($lcol['Null'] === 'YES' ? "DEFAULT NULL" : "");
        $extra = $lcol['Extra'];

        // Simple check if column exists in prod block
        if (strpos($prod_cols_block, "`$name`") === false) {
            $migrations[] = "ALTER TABLE `$table` ADD COLUMN `$name` $type $null $default $extra;";
        } else {
            // Column exists, check for type/precision differences
            // This is harder via regex, but let's at least check types
            // Looking for lines like `name` varchar(255) ...
            if (preg_match("/`$name` (.*?),/i", $prod_cols_block, $pMatch)) {
                $pType = trim($pMatch[1]);
                // If types don't match (normalize spaces/quotes)
                if (strtolower($pType) !== strtolower($type)) {
                     // Note: This is an approximation since MySQL types can be formatted differently in DDL
                     // $migrations[] = "-- Type mismatch for $table.$name: Local=[$type], Prod=[$pType]\nALTER TABLE `$table` MODIFY COLUMN `$name` $type $null $default $extra;";
                }
            }
        }
    }
}

// 4. Missing settings data
// Get local keys
$local_settings = $pdo->query("SELECT * FROM settings")->fetchAll(PDO::FETCH_ASSOC);
preg_match("/INSERT INTO `settings`.*?VALUES.*?;/s", $prod_sql, $match);
$settings_sql = $match[0] ?? '';
foreach ($local_settings as $s) {
    if (strpos($settings_sql, "'{$s['field_key']}'") === false) {
        $val = addslashes($s['field_value']);
        $label = addslashes($s['field_label']);
        $group = addslashes($s['group_name']);
        $migrations[] = "INSERT INTO `settings` (field_key, field_value, field_label, group_name) VALUES ('{$s['field_key']}', '$val', '$label', '$group');";
    }
}

file_put_contents('final_migration_proper.sql', implode("\n", $migrations));
echo "Properly calculated migration script generated.";
?>
