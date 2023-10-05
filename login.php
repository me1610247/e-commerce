<?php 
session_start();

include("includes/header.php") ?>
<div class="py-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card-header text-center bg-light text-dark rounded">
                <h3>Login form</h3>
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
                <div class="form-group mb-3">
                    <label><h5>Email</h5></label>
                    <input type="text" name="email"  class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label><h5>Password</h5></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button type="submit" name="login_btn" class="form-control btn bg-dark text-white h2">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<?php include("includes/footer.php") ?>

   