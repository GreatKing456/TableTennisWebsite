<?php
    // Start the session to access session variables
    session_start();

    // Destroy all session variables
    session_unset();
    
    // Destroy the session
    session_destroy();

    echo "Logged out";    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log out</title>
</head>
<body>
    <a href="homepage.html">Homepage</a>
</body>
</html>