<?php
session_start();

// Database connection
$servername = "db";
$username = "user";
$password = "userpassword";
$dbname = "college_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admin (username, password, role) VALUES ('$username', '$password', 'admin')"; // Assuming 'role' column exists in 'admin' table

    if ($conn->query($sql) === TRUE) {
        echo "Admin registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Register Admin</h2>
    <form action="register_admin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
