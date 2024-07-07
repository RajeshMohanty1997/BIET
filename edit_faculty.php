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

$id = $_GET['id'];
$sql = "SELECT * FROM faculty WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serial_number = $_POST['serial_number'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $designation = $_POST['designation'];
    $qualifications = $_POST['qualifications'];
    $appointment_type = $_POST['appointment_type'];
    $course = $_POST['course'];
    $aadhaar_number = $_POST['aadhaar_number'];
    $date_of_joining = $_POST['date_of_joining'];

    $sql = "UPDATE faculty SET serial_number='$serial_number', name='$name', gender='$gender', designation='$designation', qualifications='$qualifications', appointment_type='$appointment_type', course='$course', aadhaar_number='$aadhaar_number', date_of_joining='$date_of_joining' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Use session_write_close() to release the session lock before redirecting
        session_write_close();
        header("Location: view_faculty.php");
        exit();
    } else {
        echo "Error updating faculty: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Faculty - BIET</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
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

        /* Main content styles */
        main {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    ><header>
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
        <h2>Edit Faculty</h2>
        <form method="post">
            <label>Serial Number:</label>
            <input type="text" name="serial_number" value="<?php echo $row['serial_number']; ?>" required>
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
            <label>Gender:</label>
            <input type="text" name="gender" value="<?php echo $row['gender']; ?>" required>
            <label>Designation:</label>
            <input type="text" name="designation" value="<?php echo $row['designation']; ?>" required>
            <label>Qualifications:</label>
            <input type="text" name="qualifications" value="<?php echo $row['qualifications']; ?>" required>
            <label>Appointment Type:</label>
            <input type="text" name="appointment_type" value="<?php echo $row['appointment_type']; ?>" required>
            <label>Course:</label>
            <input type="text" name="course" value="<?php echo $row['course']; ?>" required>
            <label>Aadhaar Number:</label>
            <input type="text" name="aadhaar_number" value="<?php echo $row['aadhaar_number']; ?>" required>
            <label>Date of Joining:</label>
            <input type="date" name="date_of_joining" value="<?php echo $row['date_of_joining']; ?>" required>
            <input type="submit" value="Update Faculty">
        </form>
    </main>
</body>
</html>
