<link rel="stylesheet" href="./responsive.css">
<?php
// login_process.php
session_start();
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT id, username, email, password, join_date, profile_image FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {

        mysqli_stmt_bind_param($stmt, "s", $email);

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) === 1) {

                mysqli_stmt_bind_result($stmt, $id, $username, $email_db, $password_db, $join_date, $profile_image);
                mysqli_stmt_fetch($stmt);

                // NOTE: this preserves your current plain-text check.
                // For security, consider hashing passwords with password_hash() and using password_verify().
                if ($password === $password_db) {

                    // set session consistently using 'id'
                    $_SESSION["loggedin"]  = true;
                    $_SESSION["id"]        = $id;
                    $_SESSION["username"]  = $username;
                    $_SESSION["email"]     = $email_db;
                    $_SESSION["join_date"] = $join_date;
                    // optionally store profile image filename if exists
                    $_SESSION["profile_image"] = $profile_image;

                    header("Location: index.php");
                    exit;
                } else {
                    $_SESSION['error'] = "Invalid email or password.";
                }

            } else {
                $_SESSION['error'] = "Invalid email or password.";
            }

        } else {
            $_SESSION['error'] = "Database error.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "Database error.";
    }

    mysqli_close($link);

    header("Location: login_page-1.html");
    exit;
}
