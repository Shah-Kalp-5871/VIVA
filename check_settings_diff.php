<?php
$prod_sql = file_get_contents('c:/Users/Mann/Downloads/u362391755_Vivaeng.sql');
require_once 'admin/includes/db.php';

// Extract SETTINGS table INSERT statements from prod SQL
preg_match("/INSERT INTO `settings`.*?VALUES.*?;/s", $prod_sql, $match);
$settings_sql = $match[0] ?? '';

// Extract keys from the production SQL
$prod_keys = [];
if ($settings_sql) {
    preg_match_all("/\('\d+', '(.*?)',/i", $settings_sql, $keyMatches);
    $prod_keys = $keyMatches[1];
}

// Get local settings
$local_settings = $pdo->query("SELECT * FROM settings")->fetchAll(PDO::FETCH_ASSOC);

$missing_settings = [];
foreach ($local_settings as $setting) {
    if (!in_array($setting['field_key'], $prod_keys)) {
        $missing_settings[] = $setting;
    }
}

file_put_contents('missing_settings.json', json_encode($missing_settings, JSON_PRETTY_PRINT));
echo "Missing settings identified: " . count($missing_settings);
?>
