
<?php
// Start the session to access user login data
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection settings
$host = "localhost";  // Database host
$username = "root";   // Database username
$password = "";       // Database password
$database = "gtta_database";   // Database name

// Create a new connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username from the session
$userUsername = $_SESSION['username'];

// Query to fetch user details from the database
$sql = "SELECT * FROM players WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userUsername);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the user data
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// Fetch the matches the user is registered for (if any)
$sqlMatches = "SELECT * FROM players WHERE username = ?";
$stmtMatches = $conn->prepare($sqlMatches);
$stmtMatches->bind_param("s", $userUsername);
$stmtMatches->execute();
$matchesResult = $stmtMatches->get_result();
$matches = [];
while ($row = $matchesResult->fetch_assoc()) {
    if ($row['event1_registered']) {
        $matches[] = 'Event 1: Goa State Table Tennis Championship';
    }
    if ($row['event2_registered']) {
        $matches[] = 'Event 2: Inter-School Table Tennis Competition';
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>GTTA | My Account</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f9; color: #333; padding: 20px;">

    <h1 style="text-align: center; color: #1a73e8;">My Account</h1>

    <div style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 0 auto;">
        <h2>Player Details</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['fname']); ?></p>
        <p><strong>Middle Name:</strong> <?php echo htmlspecialchars($user['mname']); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['lname']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
        <p><strong>Taluka:</strong> <?php echo htmlspecialchars($user['taluka']); ?></p>
        <p><strong>Birth Date:</strong> <?php echo htmlspecialchars($user['birthdate']); ?></p>
        <p><strong>Languages:</strong><?php echo htmlspecialchars($user['languages']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
    </div>

    <!-- Registered Matches Section -->
    <div style="background-color: #fff; padding: 20px; margin-top: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 20px auto;">
        <h2>Matches Registered</h2>
        <ul id="matches-list" style="list-style-type: none; padding: 0;">
            <?php
            if (!empty($matches)) {
                foreach ($matches as $match) {
                    if (!empty($match)) {
                        echo "<li style='padding: 8px 0;'>" . htmlspecialchars($match) . "</li>";
                    }
                }
            }
            
            else {
                echo "<li>No matches registered.</li>";
            }
            ?>
        </ul>
    </div>

    <button onclick="window.location.href='homepage.html'" style="display: block; width: 100%; padding: 10px; background-color: #1a73e8; color: #fff; font-size: 1em; border: none; border-radius: 4px; cursor: pointer;">
        Back to Home
    </button>

</body>
</html>


       
