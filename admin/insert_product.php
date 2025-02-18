<?php
require_once 'connect.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productType = $_POST['productType'];

    // Handle file upload
    if (isset($_FILES['productPhoto'])) {
        if ($_FILES['productPhoto']['error'] === UPLOAD_ERR_OK) {
            $image = file_get_contents($_FILES['productPhoto']['tmp_name']); // Get the binary data of the image
        } else {
            echo "File upload error: " . $_FILES['productPhoto']['error'];
            exit();
        }
    } else {
        $image = null; // No image uploaded, set as NULL
    }

    // Debugging: Check if image is not null
    if ($image) {
        echo "Image successfully received.<br>";
    } else {
        echo "No image uploaded.<br>";
    }

    // Insert data into the product table
    $sql = "INSERT INTO product (name, price, image, cat_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement is prepared correctly
    if ($stmt === false) {
        echo "Error preparing the SQL statement: " . $conn->error;
        exit();
    }

    // Binding parameters
    $stmt->bind_param('sibs', $productName, $productPrice, $null, $productType); // Use null as a placeholder for BLOB
    $stmt->send_long_data(2, $image); // Send binary data to column index 2 (for the image)

    // Execute the statement
    if ($stmt->execute()) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
