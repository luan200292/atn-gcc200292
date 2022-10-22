<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <!-- <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<!-- Sidebar -->
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                    <a class="navbar-brand" href="../index.php"><img src="../img/logoTTG.jpg">  HOME</a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item">
                        <a href="../product/" class='sidebar-link'>
                            
                            <span>Product</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a href="../order/" class='sidebar-link'>
                            
                            <span>Order</span>
                        </a>
                    </li>

                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
 <?php
include_once("../connect.php");

if(isset($_GET['id'])){
    $oid = $_GET['id'];
    $sql = "select * from orders where OrderID = '$oid'";
    $re = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($re);
    
}

if(isset($_POST['Update'])){
    $oid = $_GET['id'];
    $Orderdate = mysqli_real_escape_string($conn, $_POST['OrderDate']);
    $Address = mysqli_real_escape_string($conn, $_POST['Address']);
    $Payment = mysqli_real_escape_string($conn, $_POST['Payment']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    if($status == "Delivered"){
        $uSQL = "UPDATE `orders` SET `OrderDate`='$Orderdate', `DeliveryDate` = CURDATE(), `Address`='$Address',
    `Payment`='$Payment', `status`='$status', `username`='$username' WHERE `OrderID`='$oid'";
    }else{
        $uSQL = "UPDATE `orders` SET `OrderDate`='$Orderdate', `Address`='$Address',
    `Payment`='$Payment', `status`='$status', `username`='$username' WHERE `OrderID`='$oid'";
    }
    if (mysqli_query($conn, $uSQL)) {
        echo "<script> window.location = 'index.php?status=Update' </script>";
    } else{
        echo "error". $uSQL. "<br>". mysqli_error($conn);
    }
    
}
 ?>
<!-- div content -->
    <div id="main">
    <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>       
        <div className="page-heading pb-2 mt-4 mb-2 ">
            <h3>Manager</h3> <a href="index.php"><button type="button" class="btn btn-outline-primary">Back to index</button></a>
        </div>
        <div class="page-content mt-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" method="POST" action="#">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Order ID</label>
                                            <input type="text" id="oid" class="form-control"
                                                name="oid"
                                                value ="<?=$row['OrderID']?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Order Date</label>
                                            <input id="OrderDate" class="form-control" type="date" name="OrderDate" 
                                            value ="<?=$row['OrderDate']?>" />
                                            
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Address</label>
                                            <input type="text" id="Address" class="form-control"
                                                name="Address" placeholder="Product Name"
                                                value ="<?=$row['Address']?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Payment</label>
                                            <div class="row">
                                                <?php
                                                    $sql1 = mysqli_query($conn, "SELECT sum(total) FROM `orders_detail` WHERE Order_ID='$oid'");
                                                    $result = mysqli_fetch_row($sql1);
                                                ?>
                                                <div class="col-8">
                                                <input type="number" id="Payment" class="form-control"
                                                name="Payment" value ="<?=$result[0]?>" readonly>
                                                </div>
                                                <div class="col-4">
                                                <a href="insertDetail.php?id=<?=$row['OrderID']?>"><button type="button" 
                                                class="btn btn-warning rounded-pill" name="Detail">Add/Update</button></a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Status</label>
                                            
                                                <div class="form-check">
                                                    <input checked class="form-check-input" type="radio" name="status" id="status1" value="Packing">
                                                    <label class="form-check-label" for="status1">
                                                        Packing
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="status2"  value="Delivered" >
                                                    <label class="form-check-label" for="status2">
                                                        Delivered
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
                                    

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Username</label>
                                            <input type="text" id="username" class="form-control"
                                                name="username" placeholder="Current user" 
                                                value ="<?=$row['username']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-warning me-1 mb-1 rounded-pill" name="Update">Submit</button>
                                        <button type="reset"
                                            class="btn btn-light-secondary me-1 mb-1 rounded-pill">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> <!--card body-->
                
                </div> <!--card content-->
            </div> <!--card-->
        </div><!--page content-->
    </div> <!--main-->
</body>
<script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/app.js"></script>
<script src="../assets/js/main.js"></script>
</html>