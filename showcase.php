<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'fashion_website_signup');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all dresses from the database
$sql = "SELECT * FROM dresses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dresses Showcase</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .dress-card {
            width: 300px;
            background-color: white;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .dress-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .dress-card .info {
            padding: 15px;
        }
        .dress-card .info h3 {
            margin: 0;
            font-size: 1.5rem;
            color: #333;
        }
        .dress-card .info p {
            font-size: 1rem;
            color: #777;
        }
        .dress-card .info .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #28a745;
        }
        .dress-card .info button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .dress-card .info button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    if ($result->num_rows > 0) {
        // Output data of each dress
        while ($row = $result->fetch_assoc()) {
            echo '<div class="dress-card">';
            echo '<img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
            echo '<div class="info">';
            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p>' . htmlspecialchars($row['description']) . '</p>';
            echo '<p class="price">$' . number_format($row['price'], 2) . '</p>';
            echo '<button>Add to Cart</button>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>No dresses available at the moment.</p>";
    }
    ?>
</div>

</body>
</html>

<?php
$conn->close();
?>
