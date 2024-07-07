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

// Delete notice if delete request is made
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Get the notice ID from the URL
    $sql = "DELETE FROM notices WHERE id=$id"; // SQL to delete the notice
    if ($conn->query($sql) === TRUE) {
        echo "Notice deleted successfully.";
    } else {
        echo "Error deleting notice: " . $conn->error;
    }
}

// Fetch notices
$sql = "SELECT * FROM notices";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Notices</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Reset and General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

header {
    background-color: #333;
    color: #fff;
    padding: 10px 0;
    text-align: center;
}

header h1 {
    margin: 0;
}

nav ul {
    list-style-type: none;
    padding: 0;
    text-align: center;
}

nav ul li {
    display: inline;
    margin-right: 10px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    background-color: #555;
}

nav ul li a:hover {
    background-color: #777;
}

/* Notices Section */
.notices {
    margin-top: 20px;
}

.notice {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
    position: relative;
}

.notice img {
    max-width: 100%;
    height: auto;
    display: block;
    margin-bottom: 10px;
    border-radius: 5px;
}

.delete-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    color: red;
    cursor: pointer;
    display: none;
}

.notice:hover .delete-btn {
    display: block;
}

    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>BIET Admin Panel</h1>
            <nav>
                <ul>
                    <li><a href="admin.php">Dashboard</a></li>
                    <li><a href="add_faculty.php">Add Faculty</a></li>
                    <li><a href="view_faculty.php">View Faculty</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="add_notice.php">Add Notice</a></li>
                    <li><a href="view_notices.php">View Notices</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Notices</h2>
        <div class="notices">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='notice'>";
                    echo "<img src='" . htmlspecialchars($row["file_path"]) . "' alt='Notice Image'>";
                    echo "<a class='delete-btn' href='view_notices.php?delete=" . intval($row["id"]) . "'>Delete</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No notices found</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
