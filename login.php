<?php
// Start session
session_start();

// 1. Connect to the database
$conn = new mysqli('localhost', 'root', '', 'fashion_website_signup');

// Check for connection errors
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// 2. Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize input to avoid SQL injection (good practice)
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Check if the user exists in the database
    $checkQuery = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Start session and store user data
            $_SESSION['username'] = $username;

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "Username not found. Please sign up.";
    }

    $stmt->close();
}
$conn->close();
?>
