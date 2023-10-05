<?php
include("config/dbconnect.php");
if(session_status()===PHP_SESSION_NONE)session_start();
if(!isset($_SESSION['info'])&& $_SESSION['info']){
    header("location:login.php");
}
if(isset($_GET['id'])){
    $delete_id=$_GET['id'];
    $delete_query="DELETE FROM cart WHERE id='$delete_id'";
    mysqli_query($con,$delete_query);
    header("location:cart.php");
}else{
    echo "item not found";
}