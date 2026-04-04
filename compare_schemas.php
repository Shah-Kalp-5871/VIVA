<?php
$local_schema = json_decode(file_get_contents('local_schema.json'), true);
$prod_sql = file_get_contents('c:/Users/Mann/Downloads/u362391755_Vivaeng.sql');

// Extract CREATE TABLE blocks
preg_match_all('/CREATE TABLE `(.*?)` \((.*?)\) ENGINE=/s', $prod_sql, $matches);

$prod_schema = [];
foreach ($matches[1] as $idx => $tableName) {
    $columnsRaw = $matches[2][$idx];
    $prod_schema[$tableName] = [];
    
    // Parse columns (rough parsing)
    $lines = explode("\n", $columnsRaw);
    foreach ($lines as $line) {
        $line = trim($line, " \t\r\n,");
        if (preg_match('/^`(.*?)`/', $line, $colMatch)) {
            $colName = $colMatch[1];
            $prod_schema[$tableName][] = $colName;
        }
    }
}

// Generate Migrations
$migrations = [];

foreach ($local_schema as $table => $columns) {
    if (!isset($prod_schema[$table])) {
        // Table missing in Prod - need full CREATE statement from local
        $migrations[] = "-- Table MISSING in Prod: $table. You should CREATE it.";
        // I'll grab local CREATE TABLE later if needed, or use a separate tool.
    } else {
        // Table exists, check for missing columns
        foreach ($columns as $col) {
            $fieldName = $col['Field'];
            if (!in_array($fieldName, $prod_schema[$table])) {
                $type = $col['Type'];
                $null = $col['Null'] === 'YES' ? 'NULL' : 'NOT NULL';
                $default = $col['Default'] !== null ? "DEFAULT '{$col['Default']}'" : ($col['Null'] === 'YES' ? "DEFAULT NULL" : "");
                $extra = $col['Extra'];
                
                $sql = "ALTER TABLE `$table` ADD COLUMN `$fieldName` $type $null $default $extra;";
                $migrations[] = $sql;
            }
        }
    }
}

file_put_contents('schema_diff_migrations.sql', implode("\n", $migrations));
echo "Diff migrations generated in schema_diff_migrations.sql";
?>
