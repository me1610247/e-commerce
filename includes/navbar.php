<?php
?>
<div class=" rounded ">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow ms-auto">
  <a class="navbar-brand px-3" href="#">E-commerce</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse ms-auto" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto">
      <?php
        if(isset($_SESSION['auth']))
        {
          
          ?>
           <li class="nav-item">
        <a class="nav-link " href="categories.php">Collections<span class="sr-only">(current)</span>
      </a>
      </li>
           <li class="nav-item">
        <a class="nav-link " href="profile.php">Profile <span class="sr-only">(current)</span>
      </a>
      </li>
           <li class="nav-item">
        <a class="nav-link " href="contact.php">Contact Us <span>
         
        </span>
      </a>
      </li>
                  <a class="nav-link active" href="logout.php">Logout <span class="sr-only">(current)</span>

                </a>
        <?php
        }
        else
        {
          ?>
          <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
        <?php }?>
      
    </ul>
   
  </div>
</nav>    
</div>
