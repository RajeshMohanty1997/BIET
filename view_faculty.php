<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$servername = "db";
$username = "user";
$password = "userpassword";
$dbname = "college_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM faculty WHERE id=$id";
    $conn->query($sql);
    header("Location: view_faculty.php");
}

$sql = "SELECT * FROM faculty";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Faculty - BIET</title>
    <link rel="stylesheet" href="styles.css">
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
        <h2>Faculty List</h2>
        <table>
            <tr>
                <th>Serial Number</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Designation</th>
                <th>Qualifications</th>
                <th>Appointment Type</th>
                <th>Course</th>
                <th>Aadhaar Number</th>
                <th>Date of Joining</th>
                <th>photo</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['serial_number']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['designation']; ?></td>
                <td><?php echo $row['qualifications']; ?></td>
                <td><?php echo $row['appointment_type']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['aadhaar_number']; ?></td>
                <td><?php echo $row['date_of_joining']; ?></td>
                <td>
                    <?php 
                    if (!empty($row['photo'])) {
                        echo '<img src="' . $row['photo'] . '" alt="' . $row['name'] . ' Photo" style="max-width: 100px; height: auto;">';
                    } else {
                        echo 'No Photo Available';
                    }
                    ?>
                </td>
                <td>
                    <a href="edit_faculty.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="view_faculty.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>
