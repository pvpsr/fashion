<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'fashion_website_signup');
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch user data
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender']; // Added gender field
    $new_photo = $_FILES['profile_photo'];

    // Handle photo upload if a new photo is provided
    if ($new_photo['name'] != '') {
        // Create the 'uploads/' folder if it doesn't exist
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Generate a unique file name for the uploaded photo
        $photo_name = time() . '_' . $new_photo['name'];
        $upload_path = 'uploads/' . $photo_name;

        // Attempt to move the uploaded file
        if (!move_uploaded_file($new_photo['tmp_name'], $upload_path)) {
            echo "Failed to upload the profile photo.";
            exit();
        }
    } else {
        // Keep the existing photo if no new photo is uploaded
        $photo_name = $user['profile_photo'];
    }

    // Update user data in the database
    $update_sql = "UPDATE users SET name = ?, email = ?, gender = ?, profile_photo = ? WHERE username = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('sssss', $name, $email, $gender, $photo_name, $username);
    $stmt->execute();

    // Close the database connection
    $conn->close();

    // Redirect to profile page after update
    header("Location: profile.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male" <?php echo ($user['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo ($user['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                <option value="other" <?php echo ($user['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
            </select>
        </div>
        <div>
            <button type="submit">Update Profile</button>
        </div>
    </form>
</body>
</html>
