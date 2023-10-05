<?php
session_start();
include("../config/dbconnect.php");
include("includes/header.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Update the user record
    $update_query = "UPDATE users SET name = '$name', email = '$email', password = '$password', role_as = '$role' WHERE id = $id";
    mysqli_query($con, $update_query);

    // Redirect to the user list page
    header("Location: index.php");
    exit();
}

// Check if the user ID is provided in the query parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the user record from the database
    $user_query = "SELECT * FROM users WHERE id = $id";
    $user_result = mysqli_query($con, $user_query);
    $user = mysqli_fetch_assoc($user_result);
} else {
    // Redirect to the user list page if the user ID is not provided
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Edit User</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="update.php">
                        <input type="hidden" name="id" value="<?= $user['id']; ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control p-2 border" id="name" name="name" value="<?= $user['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control p-2 border" id="email" name="email" value="<?= $user['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control p-2 border " id="password" name="password" value="<?= $user['password']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control border p-2" id="role" name="role" required>
                                <option class="rounded border" value="0" <?= $user['role_as'] == '0' ? 'selected' : ''; ?>>User</option>
                                <br>
                                <option value="1" <?= $user['role_as'] == '1' ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>