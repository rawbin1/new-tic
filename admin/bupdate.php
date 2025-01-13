<?php
require_once 'connect.php';

$sql = "UPDATE beverage
        SET
        name = '" . $_POST['name'] . "', 
        price = '" . $_POST['price'] . "', 
        image = '" . $_POST['image'] . "', 
        
        
        WHERE bid = " . $_GET['bid'];

//executing a query in database
$query = mysqli_query($conn, $sql);

if ($query) {
    //success
    header('location: allbeverage.php');
    exit;
} else {
    echo mysqli_error($conn);
}