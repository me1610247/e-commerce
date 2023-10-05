<?php
include("config/dbconnect.php");
include("includes/header.php");

// Check if the user is logged in
if (isset($_SESSION['info'])) {
    $email = $_SESSION['info'];
    
    // Retrieve the user's cart items from the database
    $query = "SELECT * FROM cart WHERE user_email = '$email'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        $showViewCartButton = true;
    } else {
        $showViewCartButton = false;
        ?>
        <div class="text-center">
        <div class="alert alert-danger">
            <h4><?php echo "Please Add an item so you can view the cart " ?></h4>
        </div>
        </div>
        <?php
    }


    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $cart_query = "SELECT * FROM cart where  id='$delete_id'";
        $cart_query_run = mysqli_query($con, $cart_query);

        if (mysqli_num_rows($cart_query_run) > 0) {
            $cart = mysqli_fetch_assoc($cart_query_run);
?>
            <div class="confirmation-overlay">
                <div class="confirmation-dialog">
                    <div class="card">
                        <div class="card-header">
                            <h3>Are You Sure You Want To Delete <span><?= $cart['item_name'] ;?> </span> from Cart</h3>
                        </div>
                        <div class="card-body text-center">
                            <a href="deleteItem.php?id=<?= $delete_id ?>" class="btn btn-danger col-md-3">Delete</a>
                            <a href="cart.php" class="btn btn-secondary col-md-3">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }

?>

<style>
    .confirmation-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .confirmation-dialog {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
    }

    /* Add the following CSS for the fixed bar */
    #table-container {
        position: relative;
        margin-bottom: 100px; /* Adjust the height of the fixed bar */
    }

    .fixed-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 30%;
        height: 60px; /* Adjust the height of the fixed bar */
        display: flex;
        justify-content: center;
        align-items: center;
        transform: translateX(120%);
        z-index: 9999;
        color: #f1f1f1;
        border-top: 1px solid #ccc;
        cursor: pointer;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
    }
</style>

<div class="py-3">
    <div class="container text-center">
        <h2>View Cart</h2>
        <div class="row justify-content-center" id="table-container">
            <?php
            $totalPrice = 0;
            // Loop through the cart items and display them in the card
            while ($row = mysqli_fetch_assoc($result)) {
                $itemId = $row['id'];
                $itemName = $row['item_name'];
                $itemPrice = $row['item_price'];
                $itemQuantity = $row['quantity'];
                $itemTotalPrice = $itemPrice * $itemQuantity;
                $totalPrice+=$itemTotalPrice;
                // Get the item details from the database using the item name
                $itemQuery = "SELECT * FROM categories WHERE name = '$itemName'";
                $itemResult = mysqli_query($con, $itemQuery);
                if ($itemResult && mysqli_num_rows($itemResult) > 0) {
                    $item = mysqli_fetch_assoc($itemResult);
                    $itemImage = $item['image'];
                }
            ?>
                <div class="card bordered shadow text-center m-3 col-md-6">
                    <div class="card-body col">
                        <img width="150px" height="200px" src="uploads/<?= $itemImage; ?>" class="img-fluid" alt="<?= $itemName; ?>">
                        <p><strong>Item Name:</strong> <?= $itemName; ?></p>
                        <p><strong>Price:</strong> <?= $itemPrice; ?></p>
                        <div class="input-group mb-3 text-center col-md-4 mx-auto">
                            <div class="input-group-prepend">
                                <button id="decrement" class="btn input-group-text">-</button>
                            </div>
                            <input type="text" id="quantity" class="form-control input-qty text-center bg-white" disabled value="<?= $itemQuantity; ?>">
                            <div class="input-group-append">
                                <button id="increment" class="btn input-group-text">+</button>
                            </div>
                        </div>
                        <p><strong>Total Price:</strong> <?= $itemTotalPrice; ?></p>
                        <a href="cart.php?delete_id=<?= $itemId ?>" class="btn btn-danger col-md-3">Delete</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <!-- Add the fixed bar after the table container -->
        <?php if($showViewCartButton): ?>
        <div class="fixed-bar bg-success">
            <div>
                <a class="text-decoration-none text-white" href="order.php">
                <h4>Order now <?= $totalPrice; ?> <i class="fa fa-arrow-right"></i></h4>
                </a>
                <?php endif; ?>
            </div>
            </div>
            <!-- Add your content for the fixed bar here -->
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Increment button click event
    $(document).on('click', '#increment', function() {
        var quantityInput = $(this).closest('.card-body').find('#quantity');
        var quantity = parseInt(quantityInput.val());
        quantity++;
        quantityInput.val(quantity);

        // Update the database via AJAX request
        var itemName = $(this).closest('.card-body').find('p:first').text().split(':')[1].trim();
        $.ajax({
            url: 'update_quantity.php',
            method: 'POST',
            data: { itemName: itemName, quantity: quantity },
            success: function(response) {
                // Handle the response if needed
                console.log(response);
            }
        });
    });

    // Decrement button click event
<script>


    $(document).on('click', '#decrement', function() {
        var quantityInput = $(this).closest('.card-body').find('#quantity');
        var quantity = parseInt(quantityInput.val());
        if (quantity > 1) {
            quantity--;
            quantityInput.val(quantity);

            // Update the database via AJAX request
            var itemName = $(this).closest('.card-body').find('p:first').text().split(':')[1].trim();
            $.ajax({
                url: 'update_quantity.php',
                method: 'POST',
                data: { itemName: itemName, quantity: quantity },
                success: function(response) {
                    // Handle the response if needed
                    console.log(response);
                }
            });
        }
    });
});
</script>
<?php
} else {
    // Handle the case when the user is not logged in
    echo "Please log in to view your cart.";
}
?>