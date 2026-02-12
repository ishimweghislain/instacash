<?php
// includes/db.php - Database Connection

$host = 'localhost';
$db   = 'instacash';
$user = 'root';
$pass = ''; // Default XAMPP/WAMP password. UPDATE THIS IF YOU SET A PASSWORD!
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // If database doesn't exist, try to create it (Only for local dev convenience)
    if ($e->getCode() == 1049) {
        try {
            $pdo = new PDO("mysql:host=$host;charset=$charset", $user, $pass, $options);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS instacash");
            $pdo->exec("USE instacash");
            // Import the structure
            $sql = file_get_contents(__DIR__ . '/../database.sql');
            $pdo->exec($sql);
            echo "Database created successfully! Please refresh.";
            exit;
        } catch (PDOException $e2) {
             die("Database Connection Failed: " . $e->getMessage() . " AND Failed to create DB: " . $e2->getMessage());
        }
    }
    die("Database Connection Failed: " . $e->getMessage());
}
?>
