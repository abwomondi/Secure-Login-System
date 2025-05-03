<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" action="login_process.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <div class="error-message" id="usernameError"></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div class="error-message" id="passwordError"></div>
            </div>
            <button type="submit">Login</button>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </form>
        <div id="loginMessage"></div>
    </div>
    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginForm = document.getElementById('loginForm');
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const usernameError = document.getElementById('usernameError');
            const passwordError = document.getElementById('passwordError');

            loginForm.addEventListener('submit', (event) => {
                let isValid = true;

                usernameError.textContent = '';
                passwordError.textContent = '';

                if (!usernameInput.value.trim()) {
                    usernameError.textContent = 'Username is required.';
                    isValid = false;
                }

                if (!passwordInput.value) {
                    passwordError.textContent = 'Password is required.';
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>