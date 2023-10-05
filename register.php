<?php 
session_start();
include("includes/header.php") ?>
<div class="py-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card-header text-center bg-light text-dark rounded">
                <h3>Registeration form</h3>
            </div>
            <br>
            <?php if(isset($_SESSION['message'])){
                
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <?php echo $_SESSION['message']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <?php 
            }
            unset($_SESSION['message']);
            ?>
            <div class="card-body">
            <form method="POST" action="functions/authcode.php">
                <input type="hidden" name="id">
                <div class="form-group mb-3">
                    <label><h5>Username</h5></label>
                    <input type="text" name="name"  class="form-control" id="exampleInputEmail1"  >
                </div>
                <div class="form-group mb-3">
                    <label><h5>Email</h5></label>
                    <input type="text" name="email"  class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label><h5>Phone</h5></label>
                    <input type="number" name="phone"  class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label><h5>Address</h5></label>
                    <input type="text" name="address"  class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label><h5>Password</h5></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label><h5>Confirm Password</h5></label>
                    <input type="password" name="confirmpassword" class="form-control">
                </div>
                <button type="submit" name="register_btn" class="form-control btn bg-dark text-white h2">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<?php include("includes/footer.php") ?>

   