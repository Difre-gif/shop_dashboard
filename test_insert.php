<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Insert</title>
</head>
<body>

<h1>Test Insert into Text Table</h1>

<form action="" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <button type="submit">Submit</button>
</form>

<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_inventory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    // Sanitize input
    $name = htmlspecialchars($name);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO text (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<p>New entry added successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    // Close statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

</body>
</html>
