<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("location:login.php");
}
include("config/dbconnect.php");
include("includes/header.php");

if (isset($_SESSION['info'])) {
    $email = $_SESSION['info'];
    $query = "SELECT name, id, email,phone,address, password FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0)
     { 
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];
        $userName = $row['name'];
        $userEmail = $row['email'];
        $userPhone = $row['phone'];
        $userAddress=$row['address'];
        $userPassword = $row['password'];
    } else {
        // Handle the case when the user is not found in the database
        $userName = "Unknown";
    }
} else {
    // Handle the case when the user is not logged in
    $userName = "Unknown";
}

// Handle form submission for updating the user's information
if (isset($_POST['update'])) {
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];
    $newPhone = $_POST['phone'];
    $newAddress=$_POST['address'];
    $newPassword = $_POST['password'];
    
    // Perform validation and sanitization of the input data as needed
    // Update the user's information in the database
    $updateQuery = "UPDATE users SET name = '$newName',address='$newAddress', phone='$newPhone', email = '$newEmail', password = '$newPassword' WHERE id = '$userId'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Update successful
        $_SESSION['success'] = "Profile updated successfully.";
        // Redirect to the profile page or display a success message
        header("Location: profile.php");
        exit();
    } else {
        // Update failed
        $_SESSION['error'] = "Profile update failed. Please try again.";
        header("location:edit_profile.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
<div class="container mb-3">
  <div class="row justify-content-center mb-3">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-header mb-2">
          <h3>Edit Profile</h3>
        </div>
        <div class="card-body">
          <h5 class="card-title">Edit Profile of The User</h5>
          <form action="" method="POST">
            <div class="form-group row">
              <label for="exampleInputEmail1" class="col-md-4 col-form-label">Name</label>
              <div class="col-md-8">
                <input type="text" name="name" class="form-control" id="" placeholder="Name" value="<?= ucwords($userName) ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputPassword1" class="col-md-4 col-form-label">Email</label>
              <div class="col-md-8">
                <input type="email" name="email" class="form-control" id="" placeholder="Email" value="<?= ucwords($userEmail) ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputPassword1" class="col-md-4 col-form-label">Phone</label>
              <div class="col-md-8">
                <input type="number" name="phone"  class="form-control" id="" placeholder="phone" value="<?= ucwords($userDate) ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputPassword1" class="col-md-4 col-form-label">Address</label>
              <div class="col-md-8">
                <input type="text" name="address"  class="form-control" id="" placeholder="Address" value="<?= ucwords($userAddress) ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputPassword1" class="col-md-4 col-form-label">Password</label>
              <div class="col-md-8">
                <input type="text" name="password" class="form-control" id="showPassword" placeholder="Password" value="<?= $userPassword ?>">
              </div>
            </div>
            <div class="form-group">
                <a href="profile.php"><input type="submit" name="update" value="Update" class="btn btn-primary form-control row col-md-4"></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>