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
// Retrieve data from the form
$email = $_POST['email'];
$payment = $_POST['payment'];
$event_name = $_POST['event-name2'];  // Assumes the event name is passed in the form
$event_date = $_POST['event-date2'];  // Assumes the event date is passed in the form


// Determine the event number and registration status based on the event name
    if($event_name == 'Goa State Table Tennis Championship'){
        $event1_registered = 1;
        $query = "UPDATE players SET event1_registered = $event1_registered WHERE email = '$email'";
    }
    elseif($event_name == 'Inter-School Table Tennis Competition'){
        $event2_registered = 1;
        $query = "UPDATE players SET event2_registered = $event2_registered WHERE email = '$email'";
    }

// Query to insert the registration details
// Execute the query
if ($conn->query($query) === TRUE) {
    echo "Registration successful! <a href='homepage.html'>Homepage</a>";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
