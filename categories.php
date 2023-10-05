<!-- index.php -->

<?php
include("config/dbconnect.php");
include("includes/header.php");

function getAllDistinctCategories($table)
{
    global $con;
    $query = "SELECT DISTINCT category_name FROM $table WHERE status='0'";
    return mysqli_query($con, $query);
}

// Category-Image Mapping
$categoryImages = array(
    "mobiles" => "uploads/image1.jpg",
    "technology" => "uploads/technology.jpg",
    "Fashion" => "uploads/clothes.jpg",
    "TV" => "uploads/image2.jpg",
    "shoes" => "uploads/shoes.jpg",
    "bodylotion" => "uploads/bodylotion.jpg",
    // Add more category-image mappings here
);
?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">Home/Collections</h6>
    </div>
</div>
<?php
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
if (isset($_SESSION['info'])) {
    $email = $_SESSION['info'];
    // Retrieve the user's cart items from the database
    $query = "SELECT * FROM cart WHERE user_email = '$email'";
    $result = mysqli_query($con, $query);

    // Check if there are items in the cart
    if (mysqli_num_rows($result) > 0) {
        $showViewCartButton = true;
    } else {
        $showViewCartButton = false;
    }
} else {
    // Handle the case when the user is not logged in
    $showViewCartButton = false;
}
?>
<div class="container">
<div class="row m-3">
    <div class="col-md-12 text-right">
        <?php if ($showViewCartButton): ?>
            <a href="cart.php" class="btn btn-danger">
                <i class="fa fa-shopping-cart"></i> View Cart
            </a>
        <?php endif; ?>
    </div>
</div>
</div>
<div class="py-3">
    <div class="container">
    <h2>Hello User , <?= $userName ?></h2>

        <h2 class="btn btn-primary">Our Collections</h2>
        <hr>
        <div class="row">
            <?php
            $categories = getAllDistinctCategories("categories");
            ?>
            <?php
            if (mysqli_num_rows($categories) > 0) {
                while ($item = mysqli_fetch_assoc($categories)) {
                    $categoryName = $item['category_name'];
                    if (isset($categoryImages[$categoryName])) {
                        $imagePath = $categoryImages[$categoryName];
                        ?>
                        <div class="col-md-3 mb-3">
                            <a class="text-decoration-none text-dark" href="product.php?category=<?= urlencode($categoryName); ?>">
                                <div class="card shadow text-center">
                                    <div class="card-body">
                                        <img src="<?= $imagePath; ?>" alt="<?= $categoryName; ?>" width="150px" height="180px">
                                        <h2><?= ucwords($categoryName); ?></h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    } else {
                        // Default image if no specific image found for the category
                        $defaultImagePath = "path/to/default/image.jpg";
                        ?>
                        <img src="<?= $defaultImagePath; ?>" alt="<?= $categoryName; ?>">
                        <?php
                    }
                }
            } else {
                echo "No Data Found";
            }
            ?>
        </div>
    </div>
</div>