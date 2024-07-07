<?php
session_start();

// Check if the user is logged in and if they are an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    die("Access denied.");
}

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
    $id = intval($_POST['id']);

    // Fetch the file path
    $sql = "SELECT file_path FROM notices WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $row['file_path'];

        // Delete the file from the server
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Delete the notice from the database
        $sql = "DELETE FROM notices WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Notice deleted successfully.";
        } else {
            echo "Error deleting notice: " . $conn->error;
        }
    } else {
        echo "Notice not found.";
    }
}

$conn->close();
header("Location: view_notices.php");
exit();
?>
