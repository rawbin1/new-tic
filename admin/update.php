<?php
require_once 'connect.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $product_id = $_GET['product_id'];
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $productType = $_POST['type'];
    $image = null;

    // Check if image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Get the binary data of the image
        $image = file_get_contents($_FILES['image']['tmp_name']);
    }

    // Update SQL query
    $sql = "UPDATE product 
            SET name = ?, price = ?, image = ?, cat_id = ? 
            WHERE product_id = ?";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error preparing the SQL statement: " . $conn->error;
        exit();
    }

    // Bind parameters (use 'b' for binary data in the bind_param)
    $stmt->bind_param('sbsbi', $productName, $productPrice, $image, $productType, $product_id);

    // Execute query
    if ($stmt->execute()) {
        // Success, redirect to products page
        header('Location: product.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

?>
