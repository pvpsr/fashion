<?php
// signup.php - Handles signup form submission

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'fashion_website_signup');

// Check for connection errors
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Set default profile photo based on gender
    $defaultPhoto = ($gender === 'male') ? 'default_male.jpg' : ($gender === 'female' ? 'default_female.jpg' : 'default_other.jpg');

    // Check if email or username already exists
    $checkQuery = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param('ss', $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email or Username already exists!";
    } else {
        // Insert user data into the database
        $insertQuery = "INSERT INTO users (username, name, email, password, gender, profile_photo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param('ssssss', $username, $name, $email, $hashedPassword, $gender, $defaultPhoto);

        if ($stmt->execute()) {
            echo "Signup successful! Redirecting to login page...";
            header("refresh:2;url=login.html");
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
$conn->close();
?>
