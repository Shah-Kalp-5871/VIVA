<?php
/**
 * Test Lead Submission
 */

$url = 'http://localhost/VIVA/api/save_lead.php';
$data = [
    'name' => 'Automated Test User',
    'phone' => '1234567890',
    'email' => 'test@example.com'
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ],
];

$context  = stream_context_create($options);
$result = file_get_contents($url);

if ($result === FALSE) {
    echo "Error: Failed to reach API.\n";
} else {
    echo "API Response: " . $result . "\n";
}

// Verify in DB
require_once 'admin/includes/db.php';
$stmt = $pdo->query("SELECT * FROM lead_submissions WHERE name = 'Automated Test User' ORDER BY id DESC LIMIT 1");
$lead = $stmt->fetch();

if ($lead) {
    echo "Lead found in database: ID=" . $lead['id'] . ", Name=" . $lead['name'] . "\n";
} else {
    echo "Lead NOT found in database.\n";
}
?>
