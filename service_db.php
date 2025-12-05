<link rel="stylesheet" href="./responsive.css">
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "logininfo";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
