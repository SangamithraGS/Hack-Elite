<?php
// Database connection settings
$servername = "localhost"; // Change this to your database server
$username = "username"; // Change this to your database username
$password = "password"; // Change this to your database password
$dbname = "database"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];

// SQL injection protection
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

// Hash password
$password = hash('sha256', $password); // You might use a different hashing algorithm

// Prepare SQL statement
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

// Check if user exists
if ($result->num_rows > 0) {
    // User exists, login successful
    echo "Login successful";
} else {
    // User does not exist or incorrect credentials
    echo "Invalid email or password";
}

// Close connection
$conn->close();
?>
