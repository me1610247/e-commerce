<?php
session_start();
include("../config/dbconnect.php");

// Check if the form is submitted
if (isset($_POST['update_category'])) {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price=$_POST['price'];
    $slug=$_POST['slug'];
    $status=$_POST['status'];
    $description=$_POST['description'];
    // Update the user record

    $update_query = "UPDATE categories SET  name = '$name', description='$description', price='$price',slug='$slug' WHERE id = $id";
    mysqli_query($con, $update_query);

    // Redirect to the user list page

    // Set a success message in the session variable
    $_SESSION['success_message'] = "category updated successfully.";

    // Redirect back to the index.php page
    header("Location: category.php");
    exit();
} else {
    // If the form is not submitted, redirect back to the index.php page
    header("Location: category.php");
    exit();
}
?>