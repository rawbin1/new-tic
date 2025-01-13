<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$conn = new mysqli('localhost', 'root', '', 'tic');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("insert into signup(name, phone, email, password) values(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $phone, $email, $hashed_password);
    if ($stmt->execute()) {
        // Display an alert and redirect using JavaScript
        echo "<script>
                alert('Signup Successful!');
                window.location.href = 'user_signup.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Signup Failed. Please try again.');
                window.location.href = 'user_signup.php';
              </script>";
        exit;
    }
    $stmt->close();
    $conn->close();
}
?>
