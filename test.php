<?php
require_once 'admin/includes/functions.php';
include 'includes/header.php';
?>
<div style="padding: 100px; text-align: center; background: white; color: black;">
    <h1>TEST PAGE</h1>
    <p>If you see this, the basic includes and CSS are working.</p>
    <p>Site Name: <?php echo get_setting('site_name'); ?></p>
    <p>Database Status: <?php 
        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM products");
            echo "Connected (Products: " . $stmt->fetchColumn() . ")";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    ?></p>
</div>
<?php include 'includes/footer.php'; ?>
