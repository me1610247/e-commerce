<?php
session_start();
include("config/dbconnect.php");

function getItemById($table, $itemId)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id = '$itemId' AND status='0'";
    return mysqli_query($con, $query);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the item ID and quantity from the form
    $itemId = $_GET['id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['info'])) {
        $email = $_SESSION['info'];
        $query = "SELECT name,id,email FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userName = $row['name'];
            $userId = $row['id'];
            $userEmail = $row['email'];
        } else {
            // Handle the case when the user is not found in the database
            $userName = "Unknown";
            $userId = "Unknown";
            $userEmail = "Unknown";
        }
    }

    // Get the item details from the database
    $itemResult = getItemById("categories", $itemId);
    if (mysqli_num_rows($itemResult) > 0) {
        $item = mysqli_fetch_assoc($itemResult);
        $itemId = $item['id'];
        $itemName = $item['name'];
        $itemPrice = $item['price'];

        // Calculate the total price
        $totalPrice = $itemPrice * $quantity;

        // Save the item details in the cart table
        $query = "INSERT INTO cart (user_email,user_id,user_name,item_name,item_price, quantity, total_price) VALUES ('$userEmail','$userId','$userName', '$itemName', '$itemPrice', '$quantity', '$totalPrice')";
        mysqli_query($con, $query);

        // Set the cart message in the session
        $_SESSION['cart_message'] = "Item added to cart successfully.";
        header("details.php");
        // Redirect to the "View Cart" page
        exit();
    }
} 
?>