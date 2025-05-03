<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}

// You can fetch user-specific data here based on $_SESSION['user_id']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to the Dashboard!</h2>
        <p>User ID: <?php echo $_SESSION['user_id']; ?></p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>