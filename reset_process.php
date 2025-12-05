<link rel="stylesheet" href="./responsive.css">
<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["email_reset"])) {
    die("Unauthorized access.");
}

$new_password = trim($_POST["new_password"]);
$confirm_password = trim($_POST["confirm_password"]);

if ($new_password !== $confirm_password) {
    echo "Passwords do not match.";
    exit;
}

$email = $_SESSION["email_reset"];

$sql = "UPDATE users SET password = ? WHERE email = ?";

if ($stmt = mysqli_prepare($link, $sql)) {

    mysqli_stmt_bind_param($stmt, "ss", $new_password, $email);

    if (mysqli_stmt_execute($stmt)) {
        unset($_SESSION["email_reset"]);
        header("Location: login_page.php");
exit;

    } else {
        echo "Error updating password.";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($link);
?>
