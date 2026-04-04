<?php
require_once 'admin/includes/db.php';

try {
    $stmt = $pdo->query("DESCRIBE lead_submissions");
    $columns = $stmt->fetchAll();
    echo "Table 'lead_submissions' structure:\n";
    foreach ($columns as $col) {
        echo "- " . $col['Field'] . " (" . $col['Type'] . ")\n";
    }

    // Attempt a direct insert
    $stmt = $pdo->prepare("INSERT INTO lead_submissions (name, email, phone) VALUES (?, ?, ?)");
    if ($stmt->execute(['Test Manual Lead', 'test@manual.com', '1234567890'])) {
        echo "Manually inserted a lead successfully.\n";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}
?>
