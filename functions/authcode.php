<?php
session_start();
if(!isset($_SESSION['role_as'])==1){
    header("location:../index.php");
  }
include ("../config/dbconnect.php");
if(isset($_POST['register_btn'])){
    $_SESSION['auth']=true;
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $id=mysqli_real_escape_string($con,$_POST['id']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $phone=mysqli_real_escape_string($con,$_POST['phone']);
    $address=mysqli_real_escape_string($con,$_POST['address']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $confirmpassword=mysqli_real_escape_string($con,$_POST['confirmpassword']);

    $check_email_query="SELECT email FROM users where email='$email'";
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
        $_SESSION['message']="Email Already Exist ! , Try Another one";
        header("location:../register.php"); }  
    if(!requiredVal($name)){
        $_SESSION['message']="Username is required";
        header("location:../register.php");

    }
    elseif(!(validMail($email))){
        $_SESSION['message']="Not a Valid Email";
        header("location:../register.php");
      }
    elseif(!requiredVal($email)){
        $_SESSION['message']="Email is required";
        header("location:../register.php");
    }elseif(!requiredVal($phone)){
        $_SESSION['message']="phone is Required";
        header("location:../register.php");
    }elseif(!requiredVal($address)){
        $_SESSION['message']="Address is Required";
        header("location:../register.php");
    }
    elseif(!requiredVal($password)){
        $_SESSION['message']="Password is required";
       header("location:../register.php");
  }
    elseif(!minVal($password,6)){
    $_SESSION['message']="Password is must be at least 6 chars";
       header("location:../register.php"); 
    }elseif(!minVal($address,8)){
        $_SESSION['message']="Enter a Valid Address";
        header("location:../register.php");
    }
    elseif(!maxVal($password,25)){
    $_SESSION['message']="Password is must be at least 25 chars";
       header("location:../register.php"); 
    }elseif(mysqli_num_rows($check_email_query_run)>0){
        $_SESSION['message']="Email Already Exist ! , Try Another one";
        header("location:../register.php"); }  
    else{
    if($password==$confirmpassword){
        $insert_query="INSERT INTO users(name,email,phone,address,password) VALUES ('$name','$email','$phone','$address','$password')";
        $insert_query_run=mysqli_query($con,$insert_query);
        $register_query="SELECT * FROM users where email ='$email' AND address='$address' AND phone='$phone' AND password ='$password' AND name='$name'";
        $register_query_run=mysqli_query($con,$register_query);
        $datauser=mysqli_fetch_array($register_query_run);
        $user=$datauser['name'];
        $email=$datauser['email'];
        $_SESSION['info']=$email;
        $_SESSION['auth_user']=[
            'name' => $user,
            'email' => $email,
        ];
        if($insert_query_run){
            $_SESSION['message']="Registeration Successfully";
            header("location:../index.php");
        }
        else
        {
            $_SESSION['message']="Something Went wrong";
            header("location:../register.php");
        }
    }
    else
    {
        $_SESSION['message']="password doesn't match";
        header("location:../register.php");
    }
}
}
else if(isset($_POST['login_btn'])){
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $login_query="SELECT * FROM users where email ='$email' AND password ='$password'";
    $login_query_run=mysqli_query($con,$login_query);

    if(mysqli_num_rows($login_query_run)>0){
        $_SESSION['auth']=true;
        $userdata=mysqli_fetch_array($login_query_run);
        $username=$userdata['name'];
        $useremail=$userdata['email'];
        $_SESSION['info'] = $useremail;
        $role_as=$userdata['role_as'];
        $_SESSION['auth_user']=[
            'name' => $username,
            'email' => $useremail,
        ];
        $_SESSION['role_as']=$role_as;
        if($role_as==1){
        $_SESSION['message']="Welcome To Dashboard";
        header("location:../admin/index.php");
    }elseif($role_as==0){
        $_SESSION['message']="Logged In Successfully";
        header("location:../index.php");
    }

    }else
    {
        $_SESSION['message']="Invalid Data";
        header("location:../login.php");
    }
}
if(isset($_POST['add_task'])){
    $error=[];
    function requiredVal($input){
        if(empty($input)){
            return false;
        }
        return true;
    }
    foreach($_POST as $key => $value) $$key=$value;
    if(!requiredVal($name)) $error[]="Please Add a Name ";
    if(!empty($error)){
        $_SESSION['errors']=$error;
        header("location:../note.php");
    }else{
        $NAME=mysqli_real_escape_string($con,$_POST['name']);
        $EMAIL=mysqli_real_escape_string($con,$_POST['email']);
        $PASSWORD=mysqli_real_escape_string($con,$_POST['password']);
        $note_query="SELECT * FROM users where email ='$EMAIL' AND password ='$PASSWORD' AND name ='$NAME'";
        $note_query_run=mysqli_query($con,$note_query);
        if(mysqli_num_rows($note_query_run)>0){
        $users=json_decode(file_get_contents("../data/user.json"),true);
        $_SESSION['authorized']=$users;
        $userID=isset($users) && !empty($users) ? end($users)['id'] : 0;
        $newUserID=$userID +1;
        $newUser=[
           'id'=>$newUserID,
           'name'=>$NAME,
           'email'=>$EMAIL,
           'password'=>$PASSWORD,
        ];
        $users[]=$newUser;
        file_put_contents("../data/user.json",json_encode($users,JSON_PRETTY_PRINT));
        header("location:../note.php");
        $tasks=json_decode(file_get_contents("../data/task.json"),true);
        $lastId=isset($tasks)&&!empty($tasks) ? end($tasks)['id']:0;
        $newID=$lastId+1;
        $newTask=[
            'id'=>$newID,
            'name'=>$name,
            'user_id'=>$_SESSION['authorized']['id'],
        ];
        $tasks[]=$newTask;
        file_put_contents("../data/task.json",json_encode($tasks,JSON_PRETTY_PRINT));
        header("location:../note.php");
    }
}
}
?>