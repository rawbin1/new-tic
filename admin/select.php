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
            <th>Contact Number</th>
            <th>Email</th>
        </tr>
        <?php
        $sql = "SELECT * FROM signup";

        $query = mysqli_query($conn, $sql);
        $i = 1;

        if (mysqli_num_rows($query) <= 0) {
            echo "No data found in table.";
        } else {
            while ($row = mysqli_fetch_assoc($query)) {
              

        ?>
                <tr>
                    <td><?php echo $i++ . "."; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Phone']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</body>

</html>