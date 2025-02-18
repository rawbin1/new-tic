<?php
require_once 'connect.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $sid = $_POST['sid']; // User ID (foreign key from signup table)
    $total_amount = $_POST['total_amount']; // Total amount for the order
    $status = 'pending'; // Default status
    $created_at = date('Y-m-d H:i:s'); // Current date and time
    
    // Insert into the `orders` table
    $sql_order = "INSERT INTO orders (sid, total_amount, status, created_at) 
                  VALUES ('$sid', '$total_amount', '$status', '$created_at')";
    if (mysqli_query($con, $sql_order)) {
        // Get the last inserted `order_id`
        $order_id = mysqli_insert_id($con);

        // Insert into `order_items` table
        foreach ($_POST['products'] as $product) {
            $product_id = $product['product_id'];
            $quantity = $product['quantity'];

            $sql_item = "INSERT INTO order_items (order_id, product_id, quantity) 
                         VALUES ('$order_id', '$product_id', '$quantity')";
            mysqli_query($con, $sql_item);
        }

        echo "Order placed successfully!";
    } else {
        echo "Error placing order: " . mysqli_error($con);
    }
}
?>
