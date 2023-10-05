<?php
session_start();
if(!isset($_SESSION['auth'])){
  header("location:../login.php");
}
include ("includes/header.php");
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New User</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-8">
                    <?php
                    if(isset($_SESSION['message'])){
                    ?>
                    <div class="alert text-white alert-danger alert-dismissible fade show" role="alert">
                 <?php echo $_SESSION['message']; ?>
                </button>
                </div>
                <?php } 
                unset($_SESSION['message']);
                ?>
                        </div>
                        <form action="user_code.php" method="POST" enctype="multipart/form-data">
                        <div class="col">
                            <div class="col-md-6">
                            <label class="font-weight-bold" for="">Name</label>
                        <input type="text" name="name" placeholder="Enter User Name" class="form-control border rounded ms-auto p-2 font-weight-bold">
                            </div>
                            <div class="col-md-6">
                            <label class="font-weight-bold" for="">Email</label>
                        <input type="text" name="email" placeholder="Enter User Email" class="form-control border rounded ms-auto p-2 font-weight-bold">
                            </div>
                            <div class="col-md-6">
                            <label class="font-weight-bold" for="">Date Of Birth</label>
                        <input type="text" name="date" placeholder="Enter User Date" class="form-control border rounded ms-auto p-2 font-weight-bold">
                            </div>
                            <div class="col-md-6 mb-3">
                            <label class="font-weight-bold" for="">Password</label>
                        <input type="text" name="password" placeholder="Enter User Password" class="mb-3 form-control border rounded ms-auto p-2 font-weight-bold">
                            </div>
                            <label class="font-weight-bold" for="sel1">Please Select a Role for New One</label>
                            <select class="form-control border rounded ms-auto p-2 font-weight-bold mb-3" id="role" name="role_as" required>
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>   
                            <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" name="add_new_user">Add</button>
                        </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php") ?>