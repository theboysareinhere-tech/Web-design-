<link rel="stylesheet" href="./responsive.css">
<?php
$host = "localhost";       // your DB host
$dbname = "your_database"; // your DB name
$username = "root";        // your DB username
$password = "";            // your DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
