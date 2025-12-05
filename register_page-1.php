<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="login_style.css">

    <link rel="stylesheet" href="./responsive.css">
</head>
<body>

    <!-- Back Button -->
    <button class="back-btn" onclick="history.back()">← Back</button>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Create Account</h2>
                <p>Join us today — it's quick and easy!</p>
            </div>

            <form id="registerForm" class="login-form" method="post" action="register_process.php" novalidate>
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" required autocomplete="username">
                        <label for="username">Username</label>
                        <span class="focus-border"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" required autocomplete="email">
                        <label for="email">Email Address</label>
                        <span class="focus-border"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="password" name="password" required autocomplete="new-password">
                        <label for="password">Password</label>
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
                    <span class="btn-text">Sign Up</span>
                    <span class="btn-loader"></span>
                </button>
            </form>

            <div class="signup-link">
                <p>Already have an account? <a href="login_page-1.php">Sign In</a></p>
            </div>

            <div class="success-message" id="successMessage">
                <div class="success-icon">✓</div>
                <h3>Registration Successful!</h3>
                <p>Redirecting to your login page...</p>
            </div>
        </div>
    </div>

    <script>
    document.querySelectorAll('.password-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            const input = btn.parentElement.querySelector('input');
            input.type = input.type === 'password' ? 'text' : 'password';
            btn.querySelector('.eye-icon').classList.toggle('show-password');
        });
    });

    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', e => {
            if (link.getAttribute('href').startsWith('#') || link.target === '_blank') return;
            e.preventDefault();
            document.body.style.opacity = '0';
            setTimeout(() => window.location.href = link.href, 300);
        });
    });
    window.addEventListener('pageshow', () => document.body.style.opacity = '1');
    </script>
</body>
</html>
