<?php
include("../includes/header.php");
include("../config/dbconnect.php");
$firstname=mysqli_real_escape_string($con,$_POST['firstname']);
$lastname=mysqli_real_escape_string($con,$_POST['lastname']);
$phone=mysqli_real_escape_string($con,$_POST['phone']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$message=mysqli_real_escape_string($con,$_POST['message']);
$error=[];
function requiredVal($input){
    if(empty($input)){
        return false;
    }
    return true;
}
function validMail($input){
    if(filter_var($input,FILTER_VALIDATE_EMAIL)){
        return true;
    }
    return false;
}
function minVal($input,$length){
    if(strlen($input)<$length){
        return false;
    }
    return true;
}
function maxVal($input,$length){
    if(strlen($input)>$length){
        return false;
    }
    return true;
}
if(!requiredVal($firstname)) $error[]="Your First Name is Required !";
elseif(!requiredVal($lastname)) $error[]="Your Last Name is Required !";
elseif(!requiredVal($phone)) $error[]="Your Phone is Required !";
elseif(!requiredVal($email)) $error[]="Your Email is Required !";
elseif(!requiredVal($message)) $error[]="Enter a Message Please";
elseif(!validMail($email)) $error[]="Enter a Valid Email";
elseif(!minVal($phone,10)) $error[]="Enter a Valid Phone Number";
elseif(!maxVal($phone,14)) $error[]="Enter a Valid Phone Number";
elseif(!minVal($message,10)) $error[]="Message Must Be More Than 10 Chars";
elseif(!minVal($firstname,3)) $error[]="Message Must Be More Than 3 Chars";
elseif(!minVal($lastname,3)) $error[]="Name Must Be More Than 3 Chars";

if(!empty($error)){
    $_SESSION['error']=$error;
    header("location:../contact.php");
    die;
}else{
    $_SESSION['success']=['Message Sent Successfully'];
    header("location:../contact.php");
    $message_query="INSERT INTO contactform (firstname,lastname,phone,email,message) VALUES ('$firstname','$lastname','$phone','$email','$message')";
    $message_query_run=mysqli_query($con,$message_query);
}