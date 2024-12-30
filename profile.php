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

// Fetch user data from the database
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

$profilePhoto = $user['profile_photo'];
if (empty($profilePhoto)) {
    // Set default profile photo if none is found
    $gender = $user['gender'];
    $profilePhoto = ($gender === 'male') ? 'default_male.jpg' :
                    (($gender === 'female') ? 'default_female.jpg' : 'default_other.jpg');
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1e1e1e;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            width: 30%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .profile-details {
            margin-bottom: 20px;
        }
        .profile-details label {
            font-weight: bold;
        }
        .profile-details span {
            font-size: 1.1rem;
            color: #555;
        }
        .action-buttons {
            margin-top: 30px;
        }
        .action-buttons a {
            background-color: rgb(80, 80, 80);
            color: white;
            border-radius: 30px;
            padding: 8px 16px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <img src="assets/<?php echo htmlspecialchars($profilePhoto); ?>" alt="Profile Photo" class="profile-photo">
    <div class="profile-details">
        <h2><?php echo htmlspecialchars($user['name']); ?>'s Profile</h2>
        <p><label for="username">Username:</label> <span><?php echo htmlspecialchars($user['username']); ?></span></p>
        <p><label for="email">Email:</label> <span><?php echo htmlspecialchars($user['email']); ?></span></p>
        <p><label for="gender">Gender:</label> <span><?php echo htmlspecialchars($user['gender']); ?></span></p>
    </div>

    <div class="action-buttons">
        <a href="edit_profile.php">Edit Profile</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
