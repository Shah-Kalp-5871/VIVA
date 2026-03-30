<?php
/**
 * VIVA Database Connection
 * Use PDO for secure database interactions
 */

$host = 'localhost';
$db   = 'viva_db'; // Ensure this matches your created database name
$user = 'root';
$pass = ''; // Default XAMPP password is empty
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // For production, log the error and show a generic message
     // throw new \PDOException($e->getMessage(), (int)$e->getCode());
     die("Database connection failed. Please ensure MySQL is running and the database 'viva_db' is created.");
}
?>
