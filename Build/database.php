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

// SQL query to fetch all data from the players table
$query = "SELECT * FROM players";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTTA Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #f4f4f9;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>GTTA Player Database</h1>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Taluka</th>
                    <th>Birth Date</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Password</th>
                    <th>Languages</th>
                    <th>Event 1 Registered</th>
                    <th>Event 2 Registered</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['fname']); ?></td>
                        <td><?php echo htmlspecialchars($row['mname']); ?></td>
                        <td><?php echo htmlspecialchars($row['lname']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['taluka']); ?></td>
                        <td><?php echo htmlspecialchars($row['birthdate']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['password']); ?></td>
                        <td><?php echo htmlspecialchars($row['languages']); ?></td>
                        <td><?php echo $row['event1_registered'] ? 'Yes' : 'No'; ?></td>
                        <td><?php echo $row['event2_registered'] ? 'Yes' : 'No'; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No records found in the database.</p>
    <?php endif; ?>

    <?php
    // Close the database connection
    $conn->close();
    ?>
    <a style="size:100px;text-decoration:none;color:black;" href="homepage.html">Homepage</a>
</body>
</html>
