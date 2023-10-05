<?php

include("../config/dbconnect.php");
include("includes/header.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-15">
            <div class="card col-md-15">
                <div class="card-header">
                    <h3 class="text-center">Messages</h3>
                    <?php if(isset($_SESSION['success_message'])){
                
                ?>
                <div class="  col-md-3  alert alert-success text-white" >
                     <?php echo $_SESSION['success_message']; ?>
                    </div>
                <?php 
                }
                unset($_SESSION['success_message']);
                ?>
                </div>
                <div class="card-body col-md-15">
                   

                        <?php
                        $messages = "SELECT * FROM contactform ";
                        $messages_run = mysqli_query($con, $messages);
                        if (mysqli_num_rows($messages_run) > 0) {
                            foreach ($messages_run as $key => $message) {
                                ?>
                                 <table class="table table-bordered table-hover ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $message['firstname']; ?></td>
                                    <td><?= $message['lastname']; ?></td>
                                    <td><?= $message['email']; ?></td>
                                    <td><?= $message['phone']; ?></td>
                                    <td><?= $message['created_at']; ?></td>                                    
                                </tr>
                                        <th class="text-info">Message <?= $key +1 ?></th>
                                    <td class="text-dark"><?= $message['message']; ?></td>                                    
 
                                <?php
                            }
                        } else {
                            echo "No Records Found";
                        }?>
                        </tbody>
                        </table>
                        <?php
                        ?> 
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php include("includes/footer.php") ?>
