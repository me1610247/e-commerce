<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("location:../login.php");
}
include("../config/dbconnect.php");

if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];
    // Execute the delete query
    $delete_query = "DELETE FROM categories WHERE id = $delete_id";
    mysqli_query($con, $delete_query);
    $_SESSION['success_message'] = "Category deleted successfully.";
    header("location: category.php");
} else {
    echo "Invalid request.";
}
?>