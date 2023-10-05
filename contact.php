<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("location:login.php");
}
include("config/dbconnect.php");
include("includes/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact form</title>
</head>
<body style="height:100vh">
<h2 class="text-center mb-3 p-3">Contact Form</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
            if(isset($_SESSION['error'])){
                ?>
                <ul>
                <div class="alert alert-danger ">
                    <div class="container">
                    <?php
                        foreach($_SESSION['error'] as $error){
                            echo "<li>$error</li>";
                        }
                    ?>
                    </div>
                </div>
                </ul>
                <?php
            }
            unset($_SESSION['error']);
        ?>
            <?php
            if(isset($_SESSION['success'])){
                ?>
                <ul>
                <div class="alert alert-success ">
                    <div class="container">
                    <?php
                        foreach($_SESSION['success'] as $success){
                            echo "<li>$success</li>";
                        }
                    ?>
                    </div>
                </div>
                </ul>
                <?php
            }
            unset($_SESSION['success']);
        ?>
            <form method="POST" action="functions/message.php">
  <div class="row mb-4">
    <div class="col">
        <label for="firstname">First Name</label>
      <input type="text" name="firstname" class="form-control" placeholder="Please Enter YourFirst name">
    </div>
    <div class="col">
    <label for="lastname">Last Name</label>
      <input type="text" name="lastname" class="form-control" placeholder="Please Enter Your Last name">
    </div>
  </div>
  <div class="row mb-4">
    <div class="col">
    <label for="phone">Phone Number</label>
      <input type="text" name="phone" class="form-control" placeholder="Please Enter Phone Number">
    </div>
    <div class="col">
    <label for="email">Email</label>
      <input type="text" name="email" class="form-control" placeholder="Please Enter Your Email">
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-md-6">
    <label for="message">Message</label>
    <textarea class="form-control" name="message" placeholder="Please Enter The Message You Want to Send" rows="5"></textarea>
    </div>
  </div>
  <button type="submit" class="btn btn-success">Send</button>
            </form>

            </div>
        </div>
    </div>
</body>
</html>