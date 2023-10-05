<?php
session_start();
if(!isset($_SESSION['auth'])){
  header("location:../login.php");
}
include("../config/dbconnect.php");
include ("includes/header.php");
$users_query = "SELECT COUNT(*) AS total_users FROM users";
$users_result = mysqli_query($con, $users_query);
if ($users_result) {
    $users_row = mysqli_fetch_assoc($users_result);
    $total_users = $users_row['total_users'];
} else {
    $total_users = 0;
}
$order_query = "SELECT COUNT(*) AS total_orders FROM orders";
$orders_result = mysqli_query($con, $order_query);
if ($orders_result) {
    $orders_row = mysqli_fetch_assoc($orders_result);
    $total_orders = $orders_row['total_orders'];
} else {
    $total_orders = 0;
}
$category_query = "SELECT COUNT(*) AS total_items FROM categories";
$category_result = mysqli_query($con, $category_query);
if ($category_result) {
    $category_row = mysqli_fetch_assoc($category_result);
    $total_category = $category_row['total_items'];
} else {
    $total_category = 0;
}
$current_date = date('Y-m-d');
$today_users_query = "SELECT * FROM users WHERE date = '$current_date'";
$today_users_result = mysqli_query($con, $today_users_query);
$today_users_count = mysqli_num_rows($today_users_result);
?>
<div class="container">
  <?php if(isset($_SESSION['info'])){
  $email=$_SESSION['info'];
  $query="SELECT name,id FROM users where email ='$email'";
  $result=mysqli_query($con,$query);
  if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $adminName=$row['name'];
    $adminId=$row['id'];
  }else{
    $adminName="Unkown";
    $adminId="Unkown";
  }
}else{
  $adminName="Unkown";
}
?>
    <div class="row">
            <h2>Hello Admin , <?= $adminName ?></h2>
            <?php if(isset($_SESSION['message'])){
                
                ?>
                <div class="alert alert-sucess alert-dismissible fade show" role="alert">
                     <?php echo $_SESSION['message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <?php 
                }
                unset($_SESSION['message']);
                ?>
        <div class="col-md-12">
            <br>
             <div class="row">
      <div class="col-lg-5 col-sm-5">
        <div class="card  mb-2">
  <div class="card-header p-3 pt-2">
    
    <div class="icon  icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">weekend</i>
    </div>
    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize">Items That Have Been Ordered</p>
      <h4 class="mb-0"><?= $total_orders ?></h4>
    </div>
  </div>

  <hr class="dark horizontal my-0">
  <div class="card-footer p-3">
    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
  </div>
</div>

        <div class="card  mb-2">
  <div class="card-header p-3 pt-2">
    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">leaderboard</i>
    </div>
    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize">Users Register</p>
      <h4 class="mb-0"><?= $total_users ?></h4>
    </div>
  </div>

  <hr class="dark horizontal my-0">
  <div class="card-footer p-3">
    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p>
  </div>
</div>

      </div>
      <div class="col-lg-5 col-sm-5 mt-sm-0 mt-4">
        <div class="card  mb-2">
  <div class="card-header p-3 pt-2 bg-transparent">
    <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">store</i>
    </div>
    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize ">Total Items in Your Market </p>
      <h4 class="mb-0 "><?= $total_category ?></h4>
    </div>
  </div>

  <hr class="horizontal my-0 dark">
  <div class="card-footer p-3">
    <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+1% </span>than yesterday</p>
  </div>
</div>

        <div class="card ">
  <div class="card-header p-3 pt-2 bg-transparent">
    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">person_add</i>
    </div>
    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize ">Today Registeration</p>
      <h4 class="mb-0 "><?= $today_users_count ?></h4>
    </div>
  </div>

  <hr class="horizontal my-0 dark">
  <div class="card-footer p-3">
    <p class="mb-0 ">Just updated</p>
  </div>
</div>

      </div>
    </div>

        </div>
    </div>
</div>
<?php include("includes/footer.php") ?>