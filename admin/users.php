<?php
session_start();
include ("../config/dbconnect.php");
include ("includes/header.php");

// Check if the delete button is clicked
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Execute the delete query
    $delete_query = "DELETE FROM users WHERE id = $delete_id";
    mysqli_query($con, $delete_query);
    $_SESSION['success_message'] = "Record deleted successfully.";

}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">All users</h3>
                    <?php if(isset($_SESSION['success_message'])){
                
                ?>
                <div class="  col-md-3  alert alert-success text-white" >
                     <?php echo $_SESSION['success_message']; ?>
                    </div>
                <?php 
                }
                unset($_SESSION['success_message']);
                ?>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Date</th>
                                <th>Edit</th>
                                <th>Delete</th> <!-- Added delete column header -->
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $users = "SELECT * FROM users ORDER BY role_as DESC";
                        $users_run = mysqli_query($con, $users);
                        if (mysqli_num_rows($users_run) > 0) {
                            foreach ($users_run as $key => $user) {
                                ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td><?= $user['name']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td><?= $user['role_as']=='0'?"User":"Admin" ?></td>
                                    <td><?= $user['created_at']; ?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $user['id']; ?>" class="btn btn-info">Edit</a>
                                    </td>
                                    <td>
                                        <a href="?delete_id=<?= $user['id']; ?>" class="btn btn-danger">Delete</a> <!-- Added delete button -->
                                    </td>
                                </tr>

                                <?php
                            }
                        } else {
                            echo "No Records Found";
                        }
                        ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php") ?>