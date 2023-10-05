<?php
include("../config/dbconnect.php");
include("includes/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Orders</h3>
            <?php if(isset($_SESSION['success_message'])) { ?>
            <div class="col-md-3 alert alert-success text-white">
                <?php echo $_SESSION['success_message']; ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
            <?php } ?>
            <?php
            $orders = "SELECT * FROM orders ORDER BY user_id";
            $orders_run = mysqli_query($con, $orders);
            
            if (mysqli_num_rows($orders_run) > 0) {
                $current_user_id = null;
                $totalPrice=0;
                while ($order = mysqli_fetch_assoc($orders_run)) {
                    $itemtotalPrice = $order['total_price'];
                    $cardTotalPrice = 0;
                    $cardTotalPrice+=$itemtotalPrice;                    
                    if ($order['user_id'] !== $current_user_id) {
                        if ($current_user_id !== null) {
                            echo '</div>'; // Close previous card body
                            echo '</div>'; // Close previous card
                        }
                        
                        $current_user_id = $order['user_id'];
                        ?>
                        <div class="card mb-3">
                            <div class="card-header">User ID: <?= $order['user_id'] ?></div>
                            <div class="card-body">
                            <h5 class="text-dark">Total Price of the items: <span class="text-danger"><?= $cardTotalPrice ?></span></h5>';
                                <h5 class="text-dark">User Name: <span class="text-danger"><?= $order['user_name']; ?></span></h5>
                                <h5 class="text-dark">Address: <span class="text-danger"><?= $order['user_address']; ?></span></h5>
                                <h5 class="text-dark">Phone: <span class="text-danger"><?= $order['user_phone']; ?></span></h5>
                                <h5 class="text-dark">Time of the order: <span class="text-danger"><?= $order['created_at']; ?></span></h5>
                                
                    <?php } ?>
                    
                    <!-- Print item details -->
                    <h5 class="text-dark">Name of the item: <span class="text-danger"><?= $order['item_name']; ?></span></h5>
                    <h5 class="text-dark">Quantity: <span class="text-danger"><?= $order['quantity']; ?></span></h5>
                    <h5 class="text-dark">Price: <span class="text-danger"><?= $order['total_price']; ?></span></h5>
                    <?php
                }
                ?>
                <?php
                                    // Reset the card total price for the next use        
                echo '</div>'; // Close last card body
                echo '</div>'; // Close last card
            } else {
                echo "No Records Found";
            }
            ?>
        </div>
    </div>
</div>
</body>
