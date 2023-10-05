<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("location:login.php");
}
include("config/dbconnect.php");
include("includes/header.php");

// Handle search form submission
if (isset($_POST['search'])) {
    $searchKeyword = $_POST['searchKeyword'];
    $CATEGORY_query = "SELECT * FROM categories WHERE name LIKE '%$searchKeyword%'";
    $_SESSION['searchKeyword'] = $searchKeyword;
} elseif (isset($_SESSION['searchKeyword'])) {
    $searchKeyword = $_SESSION['searchKeyword'];
} else {
    $searchKeyword = '';
    $CATEGORY_query = "SELECT * FROM categories";
}

// Handle unset session action
if (isset($_GET['unset']) && $_GET['unset'] === 'searchKeyword') {
    unset($_SESSION['searchKeyword']);
    header("Location: index.php");
    exit;
}

$CATEGORY_query = "SELECT * FROM categories";
if (!empty($searchKeyword)) {
    $CATEGORY_query .= " WHERE name LIKE '%$searchKeyword%'";
}

echo '<br>';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Categories</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="searchKeyword" placeholder="Search..." value="<?= $searchKeyword ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="search">Search</button>
                            </div>
                        </div>
                    </form>
                    <?php if (!empty($searchKeyword)) : ?>
                        <h5>
                            Search results for: 
                              <?= $searchKeyword ?>
                              <br>
                              <br>
                            <a class="btn btn-primary" href="index.php?unset=searchKeyword">Clear search</a>
                            </h5>
                            <hr>
                    <?php endif; ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Item no.</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Image</th>
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
                                            <img src="uploads/<?= $item['image'] ?>" width="100px" height="100px" alt="<?= $item['name'] ?>">
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