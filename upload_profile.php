<link rel="stylesheet" href="./responsive.css">
<?php
session_start();
require_once "config.php";

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header("Location: login_page-1.php");
    exit;
}

$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_image'])) {

    $file = $_FILES['profile_image'];
    $allowed = ['image/jpeg','image/png','image/webp','image/gif'];
    $max = 2 * 1024 * 1024; // 2MB

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['upload_error'] = "Upload failed.";
        header("Location: account.php");
        exit;
    }

    if ($file['size'] > $max) {
        $_SESSION['upload_error'] = "File too large (max 2MB).";
        header("Location: account.php");
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowed)) {
        $_SESSION['upload_error'] = "Invalid file type.";
        header("Location: account.php");
        exit;
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $safeName = "user_{$user_id}_" . time() . "." . $ext;
    $uploadDir = __DIR__ . "/images";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $dest = $uploadDir . "/" . $safeName;

    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        $_SESSION['upload_error'] = "Failed to save file.";
        header("Location: account.php");
        exit;
    }

    // Remove old image (if not default)
    $sql_old = "SELECT profile_image FROM users WHERE id = ?";
    if ($stmt_old = mysqli_prepare($link, $sql_old)) {
        mysqli_stmt_bind_param($stmt_old, "i", $user_id);
        mysqli_stmt_execute($stmt_old);
        mysqli_stmt_bind_result($stmt_old, $old);
        mysqli_stmt_fetch($stmt_old);
        mysqli_stmt_close($stmt_old);

        if ($old && $old !== 'default.png') {
            $oldPath = __DIR__.'/images/'.$old;
            if (is_file($oldPath)) @unlink($oldPath);
        }
    }

    // Update DB
    $sql_up = "UPDATE users SET profile_image = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql_up)) {
        mysqli_stmt_bind_param($stmt, "si", $safeName, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("Location: account.php");
    exit;
}

header("Location: account.php");
exit;
