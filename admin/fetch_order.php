<?php
require_once 'connect.php';

// Fetch all orders
$sql = "SELECT * FROM orders"; // Fetch orders from the database
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>
            <tr>
                <th>Customer ID</th>
                <th>Order ID</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['sid']}</td>
                <td>{$row['order_id']}</td>
                <td>{$row['total_amount']}</td>
                <td>
                    <select id='status-{$row['order_id']}'>
                        <option value='Pending' " . ($row['status'] === 'Pending' ? 'selected' : '') . ">Pending</option>
                        <option value='Confirmed' " . ($row['status'] === 'Confirmed' ? 'selected' : '') . ">Confirmed</option>
                        <option value='Ready' " . ($row['status'] === 'Ready' ? 'selected' : '') . ">Ready</option>
                    </select>
                </td>
                <td>
                    <button onclick='updateOrderStatus({$row['order_id']})'>Update</button>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No orders found.";
}
?>

<script>
function updateOrderStatus(orderId) {
    // Get the selected status value
    const status = document.getElementById(`status-${orderId}`).value;

    // Send the data to update_order_status.php
    fetch('update_order_status.php', {
        method: 'POST',
        body: `order_id=${orderId}&status=${status}`,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Display the response from the server
    })
    .catch(() => alert('Failed to update order status.'));
}
</script>
