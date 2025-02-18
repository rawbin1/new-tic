<?php
$con = new mysqli("localhost", "root", "", "tic");

if ($con->connect_error) {
    die("Error in Connection: " . $con->connect_error);
}


    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT Password FROM signup WHERE phone = ?");
    $stmt->bind_param("s", $phone);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['Password'];

        if ($password === $hashed_password) {  
            header("Location: ../Final-TICEats/homepage1.php");
        } else {
            echo "Invalid password.";
        }
    } 


    // Close the statement
    $stmt->close();


// Close connection
$con->close();
?>