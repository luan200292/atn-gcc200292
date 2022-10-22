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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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

                    <li class="sidebar-item ">
                        <a href="../product/" class='sidebar-link'>
                            
                            <span>Product</span>
                        </a>
                    </li>

                    <li class="sidebar-item active ">
                        <a href="../order/" class='sidebar-link'>
                            
                            <span>Order</span>
                        </a>
                    </li>

                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
<!-- div content -->
    <div id="main">
    <?php
    include_once("../connect.php");
    $sql1 = "select * from orders";
    $re1 = mysqli_query($conn,$sql1);
    ?>
        <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
       
                <div className="page-heading pb-2 mt-4 mb-2 ">
                    <h3>Manager</h3> <a href="insert.php"><button type="button" class="btn btn-outline-primary">Insert</button></a>
                </div>
                <div class="page-content">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
               
                </div>
                <div class="container mb-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">OrderDate</th>
                            <th scope="col">DeliveryDate</th>
                            <th scope="col">Address</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Status</th>
                            <th scope="col" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($row = mysqli_fetch_assoc($re1)){
                            ?>
                                <tr>
                                    <td><?=$row['OrderID']?></td>
                                    <td><?=$row['OrderDate']?></td>
                                    <td><?=$row['DeliveryDate']?></td>
                                    <td><?=$row['Address']?></td>
                                    <td><span>&#36;</span>
                                    <?php
                                        $id = $row['OrderID'];
                                        $totalpay = mysqli_query($conn, "SELECT * FROM orders where OrderID = '$id'");
                                        $payment = mysqli_fetch_row($totalpay);
                                    ?>
                                    <?=$payment[4]?>
                                    </td>
                                    <td><?=$row['status']?></td>
                                    <td>
                                        <a href="update.php?id=<?=$row['OrderID']?>" class="btn btn-warning rounded-pill">
                                            Update
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete.php?id=<?=$row['OrderID']?>" class="btn btn-warning rounded-pill">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                </div>
    </div>
</body>
<script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/main.js"></script>
</html>