<?php require_once 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>ID.</th>
            <th>Name</th>
            <th>Price</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM beverage";

        $query = mysqli_query($conn, $sql);
        $i = 1;

        if (mysqli_num_rows($query) <= 0) {
            echo "No data found in table.";
        } else {
            while ($row = mysqli_fetch_assoc($query)) {
        ?>
                <tr>
                    <td><?php echo $i++ . "."; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><a href="edit_beverage.php?bid=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a href="delete_beverage.php?bid=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this beverage?')">Delete</a></td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</body>

</html>
