<?php
// Database connection variables
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'gtta_database';

// Create a connection to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variable to hold any messages for user feedback
$message = "";

// Handle form submission for updating name and age
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $new_fname = $_POST['fname'];
    $new_lname = $_POST['lname'];
    $new_age = $_POST['age'];

    // Query to check if user exists with the provided email and password
    $check_query = "SELECT * FROM players WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($check_query);

    if ($result && $result->num_rows > 0) {
        // User found; proceed with the update
        $update_query = "UPDATE players SET fname = '$new_fname', lname = '$new_lname', age = '$new_age' WHERE email = '$email'";
        
        if ($conn->query($update_query) === TRUE) {
            $message = "Account updated successfully!";
        } else {
            $message = "Error updating account: " . $conn->error;
        }
    } else {
        $message = "Invalid email or password. Please try again.";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        label, input[type="text"], input[type="number"], input[type="email"], input[type="password"] {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 8px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #ffab00;
        }
        .message {
            text-align: center;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
        }

        #goback{
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

    </style>
    <script>
        function gotohomepage(){
            window.location.href="homepage.html";
        }
    </script>
</head>
<body>
    <h2>Update Account Information</h2>
    <form action="updatepage.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="fname">New First Name:</label>
        <input type="text" id="fname" name="fname" required>
        
        <label for="lname">New Last Name:</label>
        <input type="text" id="lname" name="lname" required>
        
        <label for="age">New Age:</label>
        <input type="number" id="age" name="age" min="7" max="80" required>
        
        <input type="submit" value="Update Account">
        <input id="goback" type="button" value="Go Back" onclick="gotohomepage()">
    </form>

    <?php if ($message): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
</body>
</html>
