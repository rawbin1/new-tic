<?php
require_once 'connect.php';
if (isset($_GET['bid']) && !empty($_GET['bid'])) {
    //access granted
    $id = (int)$_GET['bid']; //data type casting

    if ($id <= 0) {
        //cross checking if invalid id passed from url query e.g. id=asdjdas
        header('location: allbeverage.php');
        exit;
    }

    //old records from database tables are retrieved in order to display in the form
    $sql_1 = "SELECT * FROM beverage WHERE bid = " . $id;
    $query_1 = mysqli_query($conn, $sql_1);

    //validates if there is data in a table or not.
    if (mysqli_num_rows($query_1) <= 0) {
        header('location: allbeverage.php');
        exit;
    }

    //Retrieving a single row of existing data from a database table
    $old_data = mysqli_fetch_assoc($query_1);
} else {
    header('location: allbeverage.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<form action="bupdate.php?bid=<?php echo $old_data['bid']; ?>" method="POST" enctype="multipart/form-data" name="form">
    Name: <input type="text" name="name" value="<?php echo htmlspecialchars($old_data['name']); ?>" required> <br><br>
    Price: <input type="number" name="price" value="<?php echo htmlspecialchars($old_data['price']); ?>" required> <br><br>
    Image: <input type="file" name="image"> <br><br>
    <input type="submit" value="Update">
</form>

</body>

</html>