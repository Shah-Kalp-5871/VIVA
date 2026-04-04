<?php
/**
 * API: Save Lead Submission
 */
require_once '../admin/includes/db.php';
require_once '../admin/includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');

// Validation
if (empty($name)) {
    echo json_encode(['success' => false, 'message' => 'Name is required.']);
    exit;
}

if (empty($email) && empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Please provide either an Email ID or a Phone Number.']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO lead_submissions (name, email, phone) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $email, $phone])) {
        echo json_encode(['success' => true, 'message' => 'Thank you! We will contact you soon.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save lead. Please try again.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
