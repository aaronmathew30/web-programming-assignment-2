<?php
// db.php
// Update these credentials to match your local environment
$db_host = 'localhost';
$db_name = 'dynamic_project';
$db_user = 'root';
$db_pass = ''; // for XAMPP default is empty

$dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    // Friendly error for development; in production log this and show generic message
    exit('Database connection failed: ' . htmlspecialchars($e->getMessage()));
}
