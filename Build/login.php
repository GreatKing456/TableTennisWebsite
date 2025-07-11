<?php
// Database connection variables
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'gtta_database';

// Create a connection to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['passwd']; // Plain text password for this example

// Query to find matching user with given username and password
$query = "SELECT * FROM players WHERE username = '$username' AND password = '$password'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Login success: fetch user's data if needed
    session_start(); // Start session to store user info
    $_SESSION['username'] = $username; // Store username in session
    echo "Login successful! Welcome, " . htmlspecialchars($username) . ". <a href='homepage.html'>Go to homepage</a>";
} else {
    // Login failed: display error message
    echo "Invalid username or password. <a href='login.html'>Try again</a>";
}

// Close the connection
$conn->close();
?>
