<?php
require_once 'includes/db.php';
$count = $pdo->query("SELECT COUNT(*) FROM media")->fetchColumn();
echo "TOTAL_MEDIA_COUNT: " . $count . "\n";
?>
