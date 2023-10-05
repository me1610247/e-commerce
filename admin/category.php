<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("location:../login.php");
}
include("../config/dbconnect.php");
include("includes/header.php");

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Retrieve the category details from the database
    $category_query = "SELECT * FROM categories WHERE id = $delete_id";
    $category_result = mysqli_query($con, $category_query);

    if (mysqli_num_rows($category_result) > 0) {
        $category = mysqli_fetch_assoc($category_result);
        // Display the confirmation page with the category details
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Confirm Deletion</h3>
                        </div>
                        <div class="card-body">
                            <h4>Category: <?= $category['name'] ?></h4>
                            <p>Price: <?= $category['price'] ?> EG</p>
                            <img src="../uploads/<?= $category['image'] ?>" width="100px" height="100px" alt="<?= $category['name'] ?>">
                            <p>Status: <?= $category['status'] == '0' ? "Visible" : "Hidden" ?></p>
                            <p>Are you sure you want to delete this category?</p>
                            <a href="deletecategory.php?id=<?= $delete_id ?>" class="btn btn-danger">Delete</a>
                            <a href="category.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "Category not found.";
    }
} else {
    // Display the list of categories
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Categories</h3>
                        <?php if (isset($_SESSION['success_message'])) { ?>
                            <div class="col-md-3 alert alert-success text-white">
                                <?php echo $_SESSION['success_message']; ?>
                            </div>
                        <?php
                        }
                        unset($_SESSION['success_message']);
                        ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $CATEGORY_query = "SELECT * FROM categories";
                                $CATEGORY_query_run = mysqli_query($con, $CATEGORY_query);
                                if (mysqli_num_rows($CATEGORY_query_run) > 0) {
                                    foreach ($CATEGORY_query_run as $key => $item) {
                                        ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $item['name'] ?></td>
                                            <td><?= $item['price'] ?> EG</td>
                                            <td>
                                                <img src="../uploads/<?= $item['image'] ?>" width="100px" height="100px" alt="<?= $item['name'] ?>">
                                            </td>
                                            <td><?= $item['status'] == '0' ? "Visible" : "Hidden" ?></td>
                                            <td>
                                                <a href="editcategory.php?id=<?= $item['id']; ?>" class="btn btn-info">Edit</a>
                                            </td>
                                            <td>
                                                <a href="category.php?delete_id=<?= $item['id']; ?>" class="btn btn-danger">Delete</a>
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
    <?php
}
include("includes/footer.php")
?>