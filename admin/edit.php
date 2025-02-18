<?php
require_once 'connect.php'; // Database connection file

// Check if 'product_id' or 'section' is set in the query string
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;
$section = isset($_GET['section']) ? $_GET['section'] : 'home';

// If a product ID is provided, fetch the product data
$old_data = null;
if ($product_id > 0) {
    $sql = "SELECT * FROM product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $old_data = mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        TIC EATS
        <button class="logout" onclick="logout()">Logout</button>
    </header>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="?section=home">Home</a></li>
                <li><a href="?section=user">User</a></li>
                <li><a href="?section=products">Products</a></li>
                <li><a href="?section=order">Order</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <?php if ($product_id > 0 && $old_data): ?>
                <!-- Edit Product Form -->
                <h1>Edit Product</h1>
                <form action="update.php?product_id=<?php echo $old_data['product_id']; ?>" method="POST" enctype="multipart/form-data">
                    <label for="product_name">Name:</label>
                    <input type="text" name="name" value="<?php echo $old_data['name']; ?>"> <br><br>

                    <label for="product_price">Price:</label>
                    <input type="number" name="price" value="<?php echo $old_data['price']; ?>"> <br><br>

                    <label for="product_image">Image:</label>
                    <input type="file" name="image" accept="image/*"> <br><br>

                    <label for="product_type">Type:</label>
                    <input type="text" name="type" value="<?php echo $old_data['cat_id']; ?>"> <br><br>

                    <input type="submit" value="Update">
                </form>
            <?php elseif ($section === 'user'): ?>
                <!-- User Management Section -->
                <h1>User Management</h1>
                <p>Manage users here...</p>
            <?php elseif ($section === 'products'): ?>
                <!-- Product Management Section -->
                <h1>Product Management</h1>
                <p><a href="?section=products&product_id=1">Edit Product Example (ID 1)</a></p>
                <p>List of products will be displayed here...</p>
            <?php elseif ($section === 'order'): ?>
                <!-- Order Management Section -->
                <h1>Order Management</h1>
                <p>Manage orders here...</p>
            <?php else: ?>
                <!-- Default Home Section -->
                <h1>Welcome to the Admin Dashboard</h1>
                <p>Select a section from the sidebar to get started.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function logout() {
            const userConfirmation = confirm("Are you sure you want to log out?");
            if (userConfirmation) {
                alert('Logging out...');
                window.location.href = '../alogin/adminlogin.php'; // Update path if necessary
            } else {
                alert('Logout canceled.');
            }
        }
    </script>
</body>
</html>
