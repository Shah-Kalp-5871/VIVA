<?php
require_once 'admin/includes/db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS visitors (
        id int(11) NOT NULL AUTO_INCREMENT,
        ip_address varchar(45) NOT NULL,
        visit_date date NOT NULL,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY unique_visit (ip_address, visit_date)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $pdo->exec($sql);
    echo "Table 'visitors' created successfully.";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>
