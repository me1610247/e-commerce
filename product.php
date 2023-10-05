<!-- product.php -->

<?php
include("config/dbconnect.php");
include("includes/header.php");

function getItemsByCategory($table, $category)
{
    global $con;
    $query = "SELECT * FROM $table WHERE category_name = '$category' AND status='0'";
    return mysqli_query($con, $query);
}

?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">Home/Collections/<?= $_GET['category']; ?></h6>
    </div>
</div>
<?php
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
        <h2><?= ucwords($_GET['category']); ?></h2>
        <hr>
        <div class="row">
            <?php
            $category = $_GET['category'];
            $items = getItemsByCategory("categories", $category);
            if (mysqli_num_rows($items) > 0) {
                while ($item = mysqli_fetch_assoc($items)) {
                    $itemId = $item['id'];
                    $itemName = $item['name'];
                    $itemImage = $item['image'];
                    $itemPrice = $item['price'];
                    ?>

                    <div class="col-md-3 mb-3">
                        <div class="card shadow btn-light text-white">
                            <a class="text-decoration-none text-dark" href="details.php?id=<?= $itemId; ?>" class="text-decoration-none">
                                <img width="120px" height="250px" src="uploads/<?= $itemImage; ?>" class="card-img-top" alt="<?= $itemName; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $itemName; ?></h5>
                                    <p class="card-text">Price: $<?= $itemPrice; ?></p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "No Data Found";
            }
            ?>
        </div>
    </div>
</div>