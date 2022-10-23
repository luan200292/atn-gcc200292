<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATNShop</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
  <!-- My Script -->
  <script src="script.js"></script>


    </head>
    <body >
    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="./img/logoTTG.jpg" width="100px" height="auto"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="cart.php">Cart</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Management
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- <li><a class="dropdown-item" href="account/index.php">Account Management</a></li> -->
                <li><a class="dropdown-item" href="order/index.php">Order Management</a></li>
                <li><a class="dropdown-item" href="product/index.php">Product Management</a></li>
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="AboutUs.php">About us</a>
            </li>
            <li class="nav-item">
                <form class="d-flex" action="search_product.php" method="POST">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" 
                    name="Search_product" required>
                    <button class="btn btn-outline-secondary" name="Search_button" type="submit">Search</button>
                    <!-- <input type="submit" value="Search" class="btn btn-outline-secondary"> -->
                </form>
            </li>
        </ul>
        
        <div class="navbar-nav ms-auto">
            <?php  
                session_start();
                if(isset($_SESSION['user'])){  
            ?>
                <a href="#" class="nav-item nav-link">Welcome, <?=$_SESSION['user']?></a>
                <a href="logout.php" class="nav-item nav-link"> Logout</a>
            <?php
                }else{
            ?>
                <a href="register.php" class="nav-item nav-link"> Register</a>
                <a href="login.php" class="nav-item nav-link"> Login</a>
            <?php } ?>
        </div>
        </div>
    </div>
    </nav>
    