<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("location:login.php");
}
include("config/dbconnect.php");
include("includes/header.php");
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
                        $userPhone = "Unknown";
                        $userPassword = "Unknown";
                    }
                } else {
                    // Handle the case when the user is not logged in
                    $userName = "Unknown";
                }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
 <div class="py-3">
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                <div class="card text-center">
                <?php if(isset($_SESSION['success'])){
                
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <?php echo $_SESSION['success']; ?>
                    </div>
                <?php 
                }
                unset($_SESSION['success']);
                ?>
  <div class="container mb-3">
  <div class="row justify-content-center mb-3">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-header mb-2">
          <h3>Checkout <i class="fa fa-order"></i></h3>
        </div>
        <div class="card-body">
          <h5 class="card-title mb-3">You Are About To Place an Order !</h5>
          <form>
            <div class="form-group row">
              <label for="exampleInputEmail1" class="col-md-4 col-form-label">Name</label>
              <div class="col-md-8">
                <input type="text" readonly class="form-control" id="" placeholder="Name" value="<?= ucwords($userName) ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputPassword1" class="col-md-4 col-form-label">Email</label>
              <div class="col-md-8">
                <input type="email" readonly class="form-control" id="" placeholder="Email" value="<?= ucwords($userEmail) ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputPassword1" class="col-md-4 col-form-label">Phone</label>
              <div class="col-md-8">
                <input type="number" readonly class="form-control" id="" placeholder="Phone" value="<?= ucwords($userPhone) ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="exampleInputPassword1" class="col-md-4 col-form-label">Address</label>
              <div class="col-md-8">
                <input type="text" readonly class="form-control" id="" placeholder="Address" value="<?= ucwords($userAddress) ?>">
              </div>
            </div>
           
            <div class="form-group">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
                </div>
        </div>
    </div>
    <style>
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
    <?php
    if (isset($_SESSION['info'])) {
    $email = $_SESSION['info'];
    // Retrieve the user's cart items from the database
    $query = "SELECT * FROM cart WHERE user_email = '$email'";
    $result = mysqli_query($con, $query);
    ?>
    <div class="py-3">
    <div class="container text-center">
        <h2>View Cart</h2>
        <div class="row justify-content-center" id="table-container">
            <?php
            $totalPrice=0;
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
        <div class="fixed-bar bg-success text-dark">
    <div>
        <form method="post" action="place_order.php">
            <input type="hidden" name="totalPrice" value="<?= $totalPrice ?>">
            <button type="submit" class="bg-success btn text-white" name="submitOrder">
                <h4>Order now <?= $totalPrice ?></h4>
            </button>
        </form>
    </div>
</div>
            <!-- Add your content for the fixed bar here -->
        </div>
    </div>
    <?php } ?>
</div>
    <script>
        function myFunction() {
  var x = document.getElementById("showPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
    </script>
</body>
</html>