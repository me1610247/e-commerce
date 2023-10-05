<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("location:login.php");
}
include("config/dbconnect.php");
include("includes/header.php");
                   if (isset($_SESSION['info'])) {
                    $email = $_SESSION['info'];
                    $query = "SELECT name,id,email,phone,address ,password FROM users WHERE email = '$email'";
                    $result = mysqli_query($con, $query);
                
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $userName = $row['name'];
                        $userEmail = $row['email'];
                        $userPhone = $row['phone'];
                        $userAddress=$row['address'];
                        $userId = $row['id'];
                        $userPassword = $row['password'];
                    } else {
                        // Handle the case when the user is not found in the database
                        $userName = "Unknown";
                        $userEmail = "Unknown";
                        $userDate = "Unknown";
                        $userPassword = "Unknown";
                    }
                } else {
                    // Handle the case when the user is not logged in
                    $userName = "Unknown";
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
 <div class="py-3">
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                <div class="card text-center">
                <?php if(isset($_SESSION['success'])){
                
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <?php echo $_SESSION['success']; ?>
                    </div>
                <?php 
                }
                unset($_SESSION['success']);
                ?>
  <div class="container mb-3">
  <div class="row justify-content-center mb-3">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-header mb-2">
          <h3>Profile <i class="fa fa-user"></i></h3>
        </div>
        <div class="card-body">
          <h5 class="card-title">Profile of The User</h5>
          <form>
            <div class="form-group row">
              <label for="exampleInputEmail1" class="col-md-4 col-form-label">Name</label>
              <div class="col-md-8">
                <input type="text" readonly class="form-control" id="" placeholder="Name" value="<?= ucwords($userName) ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputPassword1" class="col-md-4 col-form-label">Email</label>
              <div class="col-md-8">
                <input type="email" readonly class="form-control" id="" placeholder="Email" value="<?= ucwords($userEmail) ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputPassword1" class="col-md-4 col-form-label">Phone</label>
              <div class="col-md-8">
                <input type="number" readonly class="form-control" id="" placeholder="Phone" value="<?= ucwords($userPhone) ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputPassword1" class="col-md-4 col-form-label">Address</label>
              <div class="col-md-8">
                <input type="text" readonly class="form-control" id="" placeholder="Address" value="<?= ucwords($userAddress) ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputPassword1" class="col-md-4 col-form-label">Password</label>
              <div class="col-md-8">
                <input type="password" readonly class="form-control" id="showPassword" placeholder="Password" value="<?= $userPassword ?>">
              </div>
            </div>
            <div class="form-check mb-3">
              <input type="checkbox" onclick="myFunction()" class="form-check-input" id="">
              <label class="form-check-label" for="exampleCheck1">Show Password</label>
            </div>
            <div class="form-group">
                <a href="edit_profile.php"><input type="text" value="Edit" class="btn btn-primary form-control row col-md-4"></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
                </div>
        </div>
    </div>
</div>
    <script>
        function myFunction() {
  var x = document.getElementById("showPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
    </script>
</body>
</html>