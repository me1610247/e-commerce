<?php
session_start();
if(!isset($_SESSION['role_as'])==1){
    header("location:../index.php");
  }
include ("../config/dbconnect.php");
if(isset($_POST['add_new_user'])){
    $_SESSION['role_as']=true;
    $_SESSION['auth']=true;
    $user_name=mysqli_real_escape_string($con,$_POST['name']);
    $user_email=mysqli_real_escape_string($con,$_POST['email']);
    $user_date=mysqli_real_escape_string($con,$_POST['date']);
    $user_role=$_POST['role_as'];
    $role=mysqli_real_escape_string($con,$_POST['role_as'])?'1':'0';
    $user_password=mysqli_real_escape_string($con,$_POST['password']);
    $check_email_query="SELECT email FROM users where email='$user_email'";
    $check_email_query_run=mysqli_query($con,$check_email_query);
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
    if(mysqli_num_rows($check_email_query_run)>0){
        $_SESSION['message']='Email Already exit !';
        header("location:add_users.php"); 
    }
    if(!requiredVal($user_name)){
        $_SESSION['message']="Please Enter a user Name";
        header("location:add_users.php");
    }
    elseif(!requiredVal($user_date)){
        $_SESSION['message']="Please Enter a user Date";
        header("location:add_users.php");
    }
    elseif(!(validMail($user_email))){
        $_SESSION['message']="Not a Valid Email";
        header("location:add_users.php"); 
      }
    elseif(!requiredVal($user_email)){
        $_SESSION['message']="Email is required";
        header("location:add_users.php"); 
    }
    elseif(!requiredVal($user_password)){
        $_SESSION['message']="Password is required";
        header("location:add_users.php"); 
  }
    elseif(!minVal($user_password,6)){
    $_SESSION['message']="Password is must be at least 6 chars";
    header("location:add_users.php"); 
}
    elseif(!maxVal($user_password,25)){
    $_SESSION['message']="Password is must be at least 25 chars";
    header("location:add_users.php"); 
}
    
elseif(mysqli_num_rows($check_email_query_run)>0){
        $_SESSION['message']="Email Already Exist ! , Please Try Another one";
        header("location:add_users.php"); 
}else{
    $newuser_query="INSERT INTO users (name,email,date,password,role_as) VALUES ('$user_name','$user_email','$user_date','$user_password','$role')";
    $newuser_query_run=mysqli_query($con,$newuser_query);
    $register_query="SELECT * FROM users where email ='$email' AND role_as='$role' AND date='$date' AND password ='$password' AND name='$name'";
    $register_query_run=mysqli_query($con,$register_query);
    $datauser=mysqli_fetch_array($register_query_run);
    if($newuser_query_run){
        $_SESSION['message']="Registeration Successfully";
        header("location:add_users.php");
    }
    else
    {
        $_SESSION['message']="Something Went wrong";
        header("location:add_users.php");
    }
}
}