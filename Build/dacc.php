<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "gtta_database");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted and email/password are provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['email']) && !empty($_POST['password'])) {
    // Get email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to select user with the provided email and password
    $query = "SELECT * FROM players WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // User found, proceed with deletion
        $delete_query = "DELETE FROM players WHERE email = '$email' AND password = '$password'";

        if (mysqli_query($conn, $delete_query)) {
            echo "<p>Account deleted successfully.</p>";
            header("Location: homepage.html"); // Redirect to homepage
            exit;
        } else {
            echo "<p>Error deleting account: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p>No account found with the given email and password.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <script>
        function gotohomepage(){
            window.location.href="homepage.html";
        }
    </script>
</head>
<body>
    <h1>Delete Account</h1>
    <form action="dacc.php" method="post">
        <label>Enter email:</label><br>
        <input type="email" name="email" required><br>
        <label>Enter password:</label><br>
        <input type="password" name="password" required><br>
        <input style="color:black;background-color:blue;border-radius:10px;margin:10px;" type="submit" value="Delete Account">
        <input style="color:black;background-color:blue;border-radius:10px;margin:10px;"  type="button" value="Go Back" onclick="gotohomepage()">
    </form>
</body>
</html>
