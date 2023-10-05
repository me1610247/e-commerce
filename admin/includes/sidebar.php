<?php
// to make when once i click on each sidebar it will be active 
$page=substr($_SERVER['SCRIPT_NAME'],strrpos($_SERVER['SCRIPT_NAME'],'/')+1);
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-2 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <span class="font-weight-bold text-white">PHP E-commerce</span>
      </a>
      
    </div>
    
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="index.php"?"active bg-gradient-primary":"" ?>" href="index.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">First page</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="category.php"?"active bg-gradient-primary":"" ?> " href="category.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">category</i>
            </div>
            <span class="nav-link-text ms-1">All Categories</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="add_category.php"?"active bg-gradient-primary":"" ?> " href="add_category.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">category</i>
            </div>
            <span class="nav-link-text ms-1">Add Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="users.php"?"active bg-gradient-primary":"" ?> " href="users.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Show All Users</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="add_users.php"?"active bg-gradient-primary":"" ?> " href="add_users.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Add New User</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="messages.php"?"active bg-gradient-primary":"" ?> " href="messages.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">message</i>
            </div>
            <span class="nav-link-text ms-1">Messages</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="orders.php"?"active bg-gradient-primary":"" ?> " href="orders.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">shopping_cart</i>
            </div>
            <span class="nav-link-text ms-1">Orders</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100"
         href="../logout.php"
          type="button">Log out</a>
      </div>
    </div>
  </aside>