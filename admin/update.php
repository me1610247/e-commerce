<?php
session_start();
include("../config/dbconnect.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Update the user record
    $update_query = "UPDATE users SET name = '$name', email = '$email', password = '$password', role_as = '$role' WHERE id = $id";
    mysqli_query($con, $update_query);

    // Set a success message in the session variable
    $_SESSION['success_message'] = "User updated successfully.";

    // Redirect back to the index.php page
    header("Location: users.php");
    exit();
} else {
    // If the form is not submitted, redirect back to the index.php page
    header("Location: users.php");
    exit();
}
?>