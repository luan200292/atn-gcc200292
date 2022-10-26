<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../favicon.ico">
    <title>ATNShop</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/app.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

</head>

<body>
    <!-- TOP HEADER -->
    <header>
        <div id="top-header">
            <div class="container">
                <ul class="header-links float-left">
                    <li><a href="#"><i class="bi bi-telephone-fill"></i> 19002002</a></li>
                    <li><a href="#"><i class="bi bi-envelope"></i> atn@gmail.com</a></li>
                    <!-- <li><a href="#"><i class="bi bi-geo-alt-fill"></i> $Product_Address</a></li> -->
                </ul>
                <ul class="header-links float-right">
                    <?php  
                        session_start();
                        if(isset($_SESSION['user'])){
                    ?>
                    <div class="mb-3">
                        Welcome, <?=$_SESSION['user']?>
                        <a href="logout.php" style="text-decoration: none; color: black;"> Logout</a>
                        <?php 
                            if(isset($_SESSION['admin'])){ 
                        ?>
                        <a href=""> || <i class="bi bi-gear-fill">Administration</i></a>
                        <?php } ?>
                    </div>
                    <?php
                        }else{
                    ?>
                    <li><a href="login.php" class="nav-item nav-link"><i class="bi bi-person-fill"></i> Login</a></li>
                    <li><a href="register.php" class="nav-item nav-link"><i class="bi bi-person"></i> Register</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="img/ATN.png" alt="logo" width="80px" height="80px" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="color:black">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" style="color:black">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php" style="color:black">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#aboutus" style="color:black">About us</a>
                    </li>
                </ul>
                <div class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form class="d-flex input-group w-auto" action="search_product.php" method="POST">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                name="Search_product" required>
                            <button class="btn btn-outline-success" type="submit" name="Search_button">Search</button>
                        </form>
                    </li>
                </div>
            </div>
        </div>
    </nav>