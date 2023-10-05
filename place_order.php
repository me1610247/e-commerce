<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("location:login.php");
    exit(); // Stop further execution
}

if (isset($_POST['submitOrder'])) {
    include("config/dbconnect.php");
    
    if (isset($_SESSION['info'])) {
        $email = $_SESSION['info'];
        $query = "SELECT name,id,phone,address FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userId = $row['id'];
            $userName = $row['name'];
            $userPhone = $row['phone'];
            $userAddress = $row['address'];
            $userId = $row['id'];
        } else {
            // Handle the case when the user is not found in the database
            $userName = "Unknown";
            $userEmail = "Unknown";
            $userPhone = "Unknown";
            $userPassword = "Unknown";
        }
        
        $query = "SELECT * FROM cart WHERE user_email = '$email'";
        $result = mysqli_query($con, $query);
        $totalPrice = $_POST['totalPrice']; // Get the total price from the hidden input
        
        // Loop through the cart items and insert them into the "orders" table
        while ($row = mysqli_fetch_assoc($result)) {
            $itemId = $row['id'];
            $itemName = $row['item_name'];
            $itemPrice = $row['item_price'];
            $itemQuantity = $row['quantity'];
            $itemTotalPrice = $itemPrice * $itemQuantity;
            
            $order_query = "INSERT INTO `orders` (user_id,user_name, user_phone, user_address, item_name,quantity,total_price)
                            VALUES ('$userId','$userName', '$userPhone', '$userAddress', '$itemName','$itemQuantity','$itemTotalPrice')";
            
            if (mysqli_query($con, $order_query)) {
                $_SESSION['order_success'] = "Order is placed";
            } else {
                $_SESSION['order_failed'] = "Something went wrong";
            }
        }
        
        // Clear the cart after placing the order
        $clear_cart_query = "DELETE FROM cart WHERE user_email = '$email'";
        mysqli_query($con, $clear_cart_query);
        
        // Redirect to a thank you page or display a success message
        header("Location: thank_you.php");
        exit(); // Stop further execution
    } else {
        // Handle the case when the user is not logged in
        header("Location: login.php");
        exit(); // Stop further execution
    }
} else {
    // Handle the case when the form is not submitted
    header("Location: index.php");
    exit(); // Stop further execution
}
?>