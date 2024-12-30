<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in (via session)
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch user details from the session
$username = $_SESSION['username'];

// If you want to fetch more user info from the database, you can do it here
// Example: $userQuery = "SELECT * FROM users WHERE username = '$username'";
// Then fetch user data like $user = mysqli_fetch_assoc($result);

?>





<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="./assets/icon.png">
  <title>Dressify - Discover Your Style</title>


  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="styles1.css">  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="./assets/logo.png">

  

</head>



<body>


    <header>
        <nav class="navbar">
          <div class="logo">Dressify</div>
          <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="showcase.php">Kids</a></li>
            <li><a href="#womans">Womans</a></li>
            <li><a href="#mens">Mens</a></li>
            <li><a href="#jwellery">Jwellery</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="profile.php"><i class="fa-solid fa-user"></i></a></li>
          </ul>
        </nav>
       
    </header>
   
    <div class="fashion-card">
            <h2 class="slogan1">Need Some Fashion Recommendations?</h2>
            <p class="sub-slogan">Get personalized suggestions for your style!</p>
            <button class="let-button"> <a href="recommendation.php" style="text-decoration: none; color: inherit;">Let's Go !</a></button>
    </div>

    <h2 class="heading-text">Explore More</h2>

    <div class="card-container">
        <div class="fashion-card1" id="card1">
            <h2 class="slogan1">Wedding Fashion</h2>
            <p class="sub-slogan">Style and comfort combined.</p>
        </div>
        <div class="fashion-card1" id="card2">
            <h2 class="slogan1">Casual Wear</h2>
            <p class="sub-slogan">Your perfect look awaits.</p>
        </div>
        <div class="fashion-card1" id="card3">
            <h2 class="slogan1">Workwear Fashion </h2>
            <p class="sub-slogan">Upgrade your wardrobe.</p>
        </div>
        <div class="fashion-card1" id="card4">
            <h2 class="slogan1">Party Wear</h2>
            <p class="sub-slogan">Be bold, be stylish.</p>
        </div>
    </div>

    <h2 class="heading-text">Feedback</h2>

    <div class="review">
            <h2 class="slogan1">"Share Your Experience"</h2>
            <p class="sub-slogan">Tell us what made your day special.</p>
            <button class="let-button"> <a href="contact.html" style="text-decoration: none; color: inherit;">Click Me !</a></button>
    </div>


 
</body>
</html>

