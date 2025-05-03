<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="registrationForm" action="register_process.php" method="POST">
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
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
        <div id="registrationMessage"></div>
    </div>
    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const registrationForm = document.getElementById('registrationForm');
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const usernameError = document.getElementById('usernameError');
            const passwordError = document.getElementById('passwordError');

            registrationForm.addEventListener('submit', (event) => {
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
                } else if (passwordInput.value.length < 6) {
                    passwordError.textContent = 'Password must be at least 6 characters long.';
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