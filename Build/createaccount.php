<?php
// Database connection variables
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'gtta_database';

// Create a connection to MySQL
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it does not exist
$db_query = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($db_query) === FALSE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create the table if it does not exist
$table_query = "CREATE TABLE IF NOT EXISTS players (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    mname VARCHAR(50),
    lname VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    gender VARCHAR(10) NOT NULL,
    taluka VARCHAR(50) NOT NULL,
    birthdate DATE NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    age INT(3) NOT NULL,
    password VARCHAR(255) NOT NULL,
    languages VARCHAR(255),
    event1_registered TINYINT(1) DEFAULT 0, 
    event2_registered TINYINT(1) DEFAULT 0
)";
if ($conn->query($table_query) === FALSE) {
    die("Error creating table: " . $conn->error);
}

// Collect data from the form
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$gender = $_POST['gen'];
$taluka = $_POST['geo'];
$birthdate = $_POST['birthdate'];
$email = $_POST['email'];
$age = $_POST['age'];
$password = $_POST['password']; // Plain text password

if (isset($_POST['languages'])) {
    $languages = implode(", ", $_POST['languages']);  // Convert array to comma-separated string
} else {
    $languages = "";  // If no languages selected, set as empty string
}

// Directly insert values into SQL query (not recommended for production)
$query = "INSERT INTO players (fname, mname, lname, username, gender, taluka, birthdate, email, age, password, languages)
          VALUES ('$fname', '$mname', '$lname', '$username', '$gender', '$taluka', '$birthdate', '$email', '$age', '$password','$languages')";

// Execute the query
if ($conn->query($query) === TRUE) {
    echo "Account created successfully! <a href='login.html'>Login here</a>";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>


