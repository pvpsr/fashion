<?php
// Start session
session_start();

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'fashion_website_signup');

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if email exists in the database
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a unique reset token
        $token = bin2hex(random_bytes(16));
        $reset_link = "http://localhost/fashion/reset-password.php?token=$token";

        // Save the token in the database
        $updateQuery = "UPDATE users SET reset_token = ? WHERE email = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('ss', $token, $email);
        $stmt->execute();

        // Send the reset link via email (placeholder function for demonstration)
        echo "A password reset link has been sent to your email. <br> $reset_link";
        // You can use PHP's mail() function to send the link
    } else {
        echo "Email not found.";
    }

    $stmt->close();
}
$conn->close();
?>
