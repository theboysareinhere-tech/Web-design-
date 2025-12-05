<link rel="stylesheet" href="./responsive.css">
<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    $errors = [];

    if (empty($username)) $errors[] = "Username is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($password)) $errors[] = "Password is required";
    if ($password !== $confirm_password) $errors[] = "Passwords do not match";

    if (empty($errors)) {

        $join_date = date("Y-m-d");

        $sql = "INSERT INTO users (username, email, password, join_date) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "ssss", 
                $username, $email, $password, $join_date
            );

            if (mysqli_stmt_execute($stmt)) {
                header("Location: login_page-1.html");
                exit;

            } else {
                echo "Error saving user.";
            }

            mysqli_stmt_close($stmt);
        }
    } else {
        foreach ($errors as $e) {
            echo $e . "<br>";
        }
    }
}

mysqli_close($link);
?>

