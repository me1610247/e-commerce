<?php
include("config/dbconnect.php");
include("includes/header.php");

function getItemById($table, $itemId, $userEmail)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id = '$itemId' AND status = '0'";
    
    // Check if the item is already in the user's cart
    $query .= " AND NOT EXISTS (SELECT * FROM cart WHERE item_id = '$itemId' AND user_email = '$userEmail')";
    
    return mysqli_query($con, $query);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the item ID and quantity from the form
    $itemId = $_GET['id'];
    $quantity = $_POST['quantity'];
    if (isset($_SESSION['info'])) {
        $email = $_SESSION['info'];
        $query = "SELECT name,id,email FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);
        

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userName = $row['name'];
            $userId = $row['id'];
            $userEmail = $row['email'];
        } else {
            // Handle the case when the user is not found in the database
            $userName = "Unknown";
            $userId = "Unknown";
            $userEmail = "Unknown";
        }
    }
 
    // Get the item details from the database
    $itemResult = getItemById("categories", $itemId, $userEmail);
    if (mysqli_num_rows($itemResult) > 0) {
        $item = mysqli_fetch_assoc($itemResult);
        $itemId = $item['id'];
        $itemName = $item['name'];
        $itemImage = $item['image'];
        $itemPrice = $item['price'];
        $itemDescription = $item['description'];

        // Calculate the total price
        $totalPrice = $itemPrice * $quantity;

        // Save the item details in the cart table
        $query = "INSERT INTO cart (user_email,user_id,user_name,item_name,item_price, quantity, total_price) VALUES ('$userEmail','$userId','$userName', '$itemName', '$itemPrice', '$quantity', '$totalPrice')";
        if (mysqli_query($con, $query)) {
            // Set the cart message in the session
            $_SESSION['cart_message'] = "Item added to cart successfully.";
        } else {
            // Set an error message indicating that the item is already in the cart
            $_SESSION['cart_message'] = "Item is already in the cart.";
        }
    }
}

?>
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
        <?php
         $query = "SELECT name,id,email FROM users WHERE email = '$email'";
         $result = mysqli_query($con, $query);
         
 
         if ($result && mysqli_num_rows($result) > 0) {
             $row = mysqli_fetch_assoc($result);
             $userEmail = $row['email'];
         }
        $itemId = $_GET['id'];
        $itemResult = getItemById("categories", $itemId,$userEmail);
        if (mysqli_num_rows($itemResult) > 0) {
            $item = mysqli_fetch_assoc($itemResult);
            $itemId = $item['id'];
            $itemName = $item['name'];
            $itemImage = $item['image'];
            $itemPrice = $item['price'];
            $itemDescription = $item['description'];
        ?>

           
            <div class="container product_data text-center">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="card-header">
                            <h4><?= $itemName ?></h4>
                        </div>
                        <div class="card-body">
                            <img width="120px" height="200px" src="uploads/<?= $itemImage; ?>" class="img-fluid" alt="<?= $itemName; ?>">
                        </div>
                        <h2><?= $itemName; ?></h2>
                        <h5>Price: $<?= $itemPrice; ?></h5>
                        <h6>Description: <?= $itemDescription; ?></h6>
                        <div class="col-md-2 mx-auto">
                            <div class="input-group mb-3 text-center">
                                <div class="input-group-prepend text-center">
                                    <button id="decrement" class="btn input-group-text">-</button>
                                </div>
                                <input type="text" id="quantity" class="form-control input-qty text-center bg-white" value="1">
                                <div class="input-group-append">
                                    <button id="increment" class="btn input-group-text">+</button>
                                </div>
                            </div>
                        </div>
                        <form action="add_to_cart.php" method="POST">
                        <div class="btn-group mt-3">
                            <div class="col-md-6">
                                <button type="button" id="addToCart" class="btn addCartBtn btn-primary px-4">Add to Cart</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        } else {
            echo "Item not found.";
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
    $(document).ready(function() {
        // Increment quantity
        $('#increment').click(function() {
            var quantity = parseInt($('#quantity').val());
            $('#quantity').val(quantity + 1);
        });

        // Decrement quantity
        $('#decrement').click(function() {
            var quantity = parseInt($('#quantity').val());
            if (quantity > 1) {
                $('#quantity').val(quantity - 1);
            }
        });

        // Add to cart
        $('#addToCart').click(function() {
            var quantity = parseInt($('#quantity').val());
            var itemId = <?= $itemId ?>;
            alert("Item Addedd To The Cart Successfully")
            $.ajax({
                url: 'add_to_cart.php?id=' + itemId,
                method: 'POST',
                data: {
                    quantity: quantity
                },
                success: function(response) {
                    $('#cartMessage').text(response);
                }
            });
        });
    });
</script>

<?php include("includes/footer.php"); ?>