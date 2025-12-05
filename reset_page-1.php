<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="login_style.css">

    <link rel="stylesheet" href="./responsive.css">
</head>
<body>

    <!-- Back Button -->
    <button class="back-btn" onclick="history.back()">← Back</button>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Reset Password</h2>
                <p>Enter your new password below</p>
            </div>

            <form id="resetForm" class="login-form" method="post" action="reset_process.php" novalidate>
                <div class="form-group">
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="new_password" name="new_password" required autocomplete="new-password">
                        <label for="new_password">New Password</label>
                        <button type="button" class="password-toggle" id="passwordToggle1">
                            <span class="eye-icon"></span>
                        </button>
                        <span class="focus-border"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="confirm_password" name="confirm_password" required autocomplete="new-password">
                        <label for="confirm_password">Confirm Password</label>
                        <button type="button" class="password-toggle" id="passwordToggle2">
                            <span class="eye-icon"></span>
                        </button>
                        <span class="focus-border"></span>
                    </div>
                </div>

                <button type="submit" class="login-btn btn">
                    <span class="btn-text">Reset Password</span>
                    <span class="btn-loader"></span>
                </button>
            </form>

            <div class="signup-link">
                <p>Remembered your password? <a href="login_page-1.php">Sign In</a></p>
            </div>

            <div class="success-message" id="successMessage">
                <div class="success-icon">✓</div>
                <h3>Password Updated!</h3>
                <p>Redirecting to login page...</p>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
