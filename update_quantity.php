<?php
include("config/dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemName = $_POST['itemName'];
    $quantity = $_POST['quantity'];
    $itemPrice=$_POST['price'];
    $totalPrice=$itemPrice*$quantity;
    // Update the quantity in the database
    $query = "UPDATE cart SET quantity = '$quantity' WHERE item_name = '$itemName'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "Quantity updated successfully.";
    } else {
        echo "Failed to update quantity.";
    }
}
?>