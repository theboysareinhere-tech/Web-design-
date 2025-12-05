<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login_page-1.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="login_style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
            padding-top: 100px;
            background: linear-gradient(120deg, #00b4db, #0083b0);
        }
        .btn {
            display: inline-block;
            margin: 10px;
            background: rgba(255,255,255,0.2);
            padding: 12px 24px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            transition: background 0.3s;
        }
        .btn:ho
    <link rel="stylesheet" href="./responsive.css">
ver {
            background: rgba(255,255,255,0.3);
        }
    </style>
</head>
<body>
    <h1>Welcome, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> 👋</h1>
    <p>You have successfully logged in.</p>
    <a href="reset_page-1.php" class="btn">Reset Password</a>
    <a href="logout.php" class="btn">Sign Out</a>
</body>
</html>
