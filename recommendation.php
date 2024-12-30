<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['category'] ?? null;
    $occasions = $_POST['occasion'] ?? [];

    if ($category && !empty($occasions)) {
        // Handle the data, such as saving to the database or redirecting
        echo "<script>alert('Category: $category, Occasions: " . implode(", ", $occasions) . "');</script>";
    } else {
        echo "<script>alert('Please select both a category and at least one occasion.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fashion Recommendation</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    .recommendation-page {
    font-family: 'Poppins', sans-serif;
    max-width: 800px;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
    color: #333;
    text-align: center;
    }

    .for-whom-options, .occasion-options {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    color: #1e1e1e;
    }

    label {
    background: #e3e3e3;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease;
    }

    label:hover {
    background: #d1d1d1;
    }

    .submit-btn {
    display: block;
    margin: 20px auto;
    background: #ff6b6b;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s ease;
    font-family: 'Poppins', sans-serif;
    }

    .submit-btn:hover {
    background: #ff4747;
    }

</style>

</head>
<body>

<header>
  <nav class="navbar">
    <div class="logo">Dressify</div>
    <ul class="nav-links">
      <li><a href="dashboard.php">Home</a></li>
      <li><a href="profile.php"><i class="fa-solid fa-user"></i></a></li>
    </ul>
  </nav>
</header>

<div class="recommendation-page">
  <h1>Get Your Fashion Recommendation</h1>
  <form method="POST">

    <!-- For Whom -->
    <h2>For Whom:</h2>
    <div class="for-whom-options">
      <label>
        <input type="radio" name="category" value="kids" required>
        Kids
      </label>
      <label>
        <input type="radio" name="category" value="boys">
        Boys
      </label>
      <label>
        <input type="radio" name="category" value="girls">
        Girls
      </label>
      <label>
        <input type="radio" name="category" value="men">
        Men
      </label>
      <label>
        <input type="radio" name="category" value="women">
        Women
      </label>
    </div>

    <!-- Occasion -->
    <h2>Occasion:</h2>
    <div class="occasion-options">
      <label>
        <input type="radio" name="occasion[]" value="wedding">
        Wedding
      </label>
      <label>
        <input type="radio" name="occasion[]" value="party">
        Party
      </label>
      <label>
        <input type="radio" name="occasion[]" value="formal">
        Formal Event
      </label>
      <label>
        <input type="radio" name="occasion[]" value="casual">
        Casual Outing
      </label>
      <label>
        <input type="radio" name="occasion[]" value="festival">
        Festival
      </label>
      <label>
        <input type="radio" name="occasion[]" value="travel">
        Travel
      </label>
      <label>
        <input type="radio" name="occasion[]" value="interview">
        Interview
      </label>
    </div>

    <!-- Submit -->
    <button type="submit" class="submit-btn">Get Recommendations</button>
  </form>
</div>

</body>
</html>
