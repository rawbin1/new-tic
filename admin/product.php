<?php require_once 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM product";

        $query = mysqli_query($conn, $sql);
        $i = 1;

        if (mysqli_num_rows($query) <= 0) {
            echo "<tr><td colspan='5'>No data found in table.</td></tr>";
        } else {
            while ($row = mysqli_fetch_assoc($query)) {
        ?>
                <tr>
                    <td><?php echo $i++ . "."; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['price']); ?></td>
                    <td>
                        <?php 
                            // Display product type based on numeric value
                            if ($row['cat_id'] == 1) {
                                echo "Snacks";
                            } elseif ($row['cat_id'] == 2) {
                                echo "Beverage";
                            } else {
                                echo "Unknown Type";
                            }
                        ?>
                    </td>
                    <td>
                        <!-- Action buttons -->
                        <a href="edit.php?product_id=<?php echo $row['product_id']; ?>">Edit</a> | 
                        <a href="delete_product.php?product_id=<?php echo $row['product_id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</body>

</html>
