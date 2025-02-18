<?php
require_once 'connect.php';

// Prepare the SQL query
$sql = "UPDATE orders 
        SET status = '" . $_POST['status'] . "' 
        WHERE order_id = " . intval($_POST['order_id']);

// Execute the query
$query = mysqli_query($conn, $sql);

if ($query) {
    // Success
    echo "Order status updated successfully.";
} else {
    // Error
    echo "Error updating order status: " . mysqli_error($conn);
}

$conn->close();
?>
