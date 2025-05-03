<?php
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo json_encode(['error' => 'Username and password are required.']);
        exit();
    }

    try {
        // Check if the username already exists (preventing duplicates)
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            echo json_encode(['error' => 'Username already exists. Please choose another.']);
            exit();
        }

        // Password Hashing
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Prevent SQL Injection using Prepared Statements
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password_hash', $password_hash);
        $stmt->execute();

        echo json_encode(['success' => 'Registration successful! You can now <a href="login.php">login</a>.']);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Registration failed: ' . $e->getMessage()]);
    }
} else {
    // If accessed directly, redirect to the registration page
    header("Location: register.php");
    exit();
}
?>