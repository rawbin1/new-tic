<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Change this if your MySQL username is different
$password = ""; // Change this if your MySQL password is set
$dbname = "tic";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminUsername = $_POST['username'];
    $adminPassword = $_POST['password'];

    // Validate login credentials
    $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $adminUsername, $adminPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Redirect to admin/admin.php upon successful login
        header("Location: ../admin/admin.php");
        exit();
    } else {
        // Redirect back to adminlogin.php with an error message
        header("Location: adminlogin.php?error=1");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>

