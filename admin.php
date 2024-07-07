<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BIET</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        /* Header styles */
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
    </style>
</head>
<body>
    <header>
        <h1>BIET Admin Panel</h1>
        <nav>
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="add_faculty.php">Add Faculty</a></li>
                <li><a href="view_faculty.php">View Faculty</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="add_notice.php">add notice</a></li>
                <li><a href="view_notices.php">view notice</a></li>
                <!-- <li><a href=".php">upload notice</a></li> -->
            </ul>
        </nav>
    </header>
    <main>
        <h2>Welcome, Admin</h2>
        <p>Use the navigation to manage faculty details.</p>
    </main>
</body>
</html>
