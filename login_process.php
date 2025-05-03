<?php
require 'db_config.php';

session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo json_encode(['error' => 'Username and password are required.']);
        exit();
    }

    try {
        // Prevent SQL Injection using Prepared Statements
        $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Authentication successful

            // Session-based Authentication
            $_SESSION['user_id'] = $user['id'];

            // Secure Cookies for Session ID
            $session_lifetime = 3600; // 1 hour (adjust as needed)
            session_set_cookie_params($session_lifetime, '/', '', true, true); // httponly, secure

            echo json_encode(['success' => 'Login successful! Redirecting...']);
        } else {
            echo json_encode(['error' => 'Invalid username or password.']);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Login failed: ' . $e->getMessage()]);
    }
} else {
    // If accessed directly, redirect to the login page
    header("Location: login.php");
    exit();
}
?>