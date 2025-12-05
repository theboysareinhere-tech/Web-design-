<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login_style.css">

    <link rel="stylesheet" href="./responsive.css">
</head>
<body>

    <button class="back-btn" onclick="history.back()">← Back</button>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Welcome Back</h2>
                <p>Sign in to your account</p>
            </div>

            <!-- Display error messages -->
            <?php
            if (isset($_SESSION['error'])) {
                echo '<p class="error-msg">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
            ?>

            <form class="login-form" id="loginForm" method="post" action="login_process.php" novalidate>
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="email" name="email" required autocomplete="email">
                        <label for="email">Email Address</label>
                        <span class="focus-border"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="password" name="password" required autocomplete="current-password">
                        <label for="password">Password</label>
                        <span class="focus-border"></span>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-wrapper">
                        <input type="checkbox" id="remember" name="remember">
                        <span class="checkbox-label">
                            <span class="checkmark"></span>
                            Remember me
                        </span>
                    </label>
                    <a href="reset_page-1.php" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn btn">Sign In</button>
            </form>
        </div>
    </div>

    <footer>
        <p>© 2025 Power ECU. All Rights Reserved.</p>
    </footer>

</body>
</html>

