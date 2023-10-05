<?php
session_start();
include("../config/dbconnect.php");
include("includes/header.php");
if (isset($_POST['submit'])) {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price=$_POST['price'];
    $slug=$_POST['slug'];
    $status=$_POST['status'];
    // Update the user record
    $update_query = "UPDATE categories SET name = '$name', price='$price',slug='$slug' WHERE id = $id";
    mysqli_query($con, $update_query);

    // Redirect to the user list page
    header("Location: index.php");
    exit();
}

// Check if the user ID is provided in the query parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the user record from the database
    $category_query = "SELECT * FROM categories WHERE id = $id";
    $category_result = mysqli_query($con, $category_query);
    $category = mysqli_fetch_assoc($category_result);
} else {
    // Redirect to the user list page if the user ID is not provided
    header("Location: index.php");
    exit();
}
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="updatecategory.php" method="POST">
                        <input type="hidden" name="id" value="<?= $category['id']; ?>">
                        <div class="row">
                            <div class="col-md-6">
                            <label class="font-weight-bold" for="">Name</label>
                        <input type="text"  id="name" value="<?= $category['name']; ?>" name="name" placeholder="Enter Category Name" class="form-control border rounded ms-auto p-2 font-weight-bold">
                            </div>
                            <div class="col-md-6">
                            <label class="font-weight-bold" for="">Slug</label>
                        <input type="text" id="slug" value="<?= $category['slug']; ?>" name="slug" placeholder="Slug" class="form-control border rounded ms-auto p-2 font-weight-bold">
                            </div>
                            <div class="col-md-6 mb-3">
                            <label class="font-weight-bold" for="">Description</label>
                        <textarea cols="8" rows="5" type="text" id="slug" value="<?= $category['description']; ?>" name="description" placeholder="Description" class="form-control border rounded ms-auto p-2 font-weight-bold"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                            <label class="font-weight-bold" for="">Price</label>
                        <input type="text" id="price" value="<?= $category['price']; ?>" name="price" placeholder="Price" class="form-control border rounded ms-auto p-2 font-weight-bold">
                            </div>

                            <div class="col-md-12 mb-3">
                            <button type="submit" name="update_category" class="btn btn-info">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php") ?>