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

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $lD = "";

        if (isset($_GET['odid'])) {
            $OrderDetail_ID = $_GET['odid'];

            $listDetail = "select * from orders_detail where Order_ID='" . $_GET['id'] . "' and OrderDetail_ID = '" . $_GET['odid'] . "'";
            $res1 = mysqli_query($conn, $listDetail);
            $lD = mysqli_fetch_row($res1);
        }


        if (isset($_POST['Insert'])) {

            $Product_ID = mysqli_real_escape_string($conn, $_POST['Product_ID']);
            $Pro_Qty = mysqli_real_escape_string($conn, $_POST['Pro_Qty']);

            $data = mysqli_query($conn, "select Price from product where Product_ID='$Product_ID'");
            $rData = mysqli_fetch_assoc($data);
            $Price = $rData['Price'];
            $total = $Price * $Pro_Qty;

            
            $checkEx = mysqli_query($conn, "SELECT Product_ID FROM orders_detail WHERE `Order_ID`='$id' and `Product_ID` = '$Product_ID'");
                
                if (mysqli_num_rows($checkEx) == 0) {
                $insertQuery = "INSERT INTO `orders_detail`( `Order_ID`, `Product_ID`, `Pro_Qty`, `Price`, `Total`) 
            VALUES ('$id','$Product_ID',$Pro_Qty,$Price,$total)";
            

            } else {
                $insertQuery = "UPDATE orders_detail SET Pro_Qty= Pro_Qty + $Pro_Qty, Total = Total + $total 
            WHERE `Order_ID`='$id' and `Product_ID` = '$Product_ID'";
            }

            if (mysqli_query($conn, $insertQuery)) {
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
        }
        $sumTotalQuery  = mysqli_query($conn, "SELECT sum(total) FROM `orders_detail` WHERE Order_ID='$id'");
        $sumTotal = mysqli_fetch_row($sumTotalQuery);

    ?>
        <!-- div content -->
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div className="page-heading pb-2 mt-4 mb-2 ">
                <h3>Manager</h3>
                <a href="update.php?id=<?= $_GET['id'] ?>&total=<?= $sumTotal[0] ?>"><button type="button" 
                class="btn btn-outline-primary">Save</button></a>

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
                                                <input type="number" id="oid" class="form-control" name="oid" value="<?= $_GET['id'] ?>" disabled>
                                            </div>
                                        </div>
                                        <!-- <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Order Detail ID</label>
                                                <?php
                                                $d = "";
                                                if (isset($_GET['odid'])) {
                                                    $d = "disabled";
                                                }
                                                ?>
                                                <input type="text" id="OrderDetail_ID" class="form-control" name="OrderDetail_ID" 
                                                value="<?= $_GET['odid'] ?? ''; ?>" <?= $d ?>>
                                            </div>
                                        </div> -->
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Address-vertical">Product</label>
                                                <input class="form-control" list="p" name="Product_ID" id="Product_ID" value="<?= $lD[2] ?? '' ?>" required>

                                                <datalist id="p">
                                                    <?php
                                                    $selectProduct = "select * from product";
                                                    $rePro = mysqli_query($conn, $selectProduct);
                                                    while ($rowP = mysqli_fetch_assoc($rePro)) {
                                                    ?>
                                                        <option value="<?= $rowP['Product_ID'] ?>"><?= $rowP['Product_Name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Product Quantity</label>
                                                <input type="number" id="Pro_Qty" class="form-control" name="Pro_Qty" value="<?= $lD[3] ?? '' ?>" required>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-warning me-1 mb-1 rounded-pill" name="Insert">Add</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1 rounded-pill">Reset</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                    <!--card body-->

                </div>
                <!--card content-->
            </div>
            <!--card-->
            <?php

            $listProduct = "select * from orders_detail where Order_ID='" . $_GET['id'] . "'";
            $r = mysqli_query($conn, $listProduct);

            ?>
            <div class="container mb-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Order_ID</th>
                            <th scope="col">OrderDetail_ID</th>
                            <th scope="col">Product_ID</th>
                            <th scope="col">Pro_Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                            <th scope="col" colspan="2">Action
                            <?php

                            echo '<span class="badge bg-info text-dark">Total:' . $sumTotal[0] . '</span>';
                        }
                            ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($resLP = mysqli_fetch_assoc($r)) { ?>
                            <tr>
                                <td><?= $resLP['Order_ID'] ?></td>
                                <td><?= $resLP['OrderDetail_ID'] ?></td>
                                <td><?= $resLP['Product_ID'] ?></td>
                                <td><?= $resLP['Pro_Qty'] ?></td>
                                <td><?= $resLP['Price'] ?></td>
                                <td><?= $resLP['Total'] ?></td>
                                <td><a href="insertDetail.php?id=<?= $resLP['Order_ID'] ?>&odid=<?= $resLP['OrderDetail_ID'] ?>" 
                                class="btn btn-warning rounded-pill">Update</a></td>
                                <td><a href="delete.php?oid=<?= $resLP['Order_ID'] ?>&odid=<?= $resLP['OrderDetail_ID'] ?>" 
                                class="btn btn-warning rounded-pill">Delete</a></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--page content-->
        </div>
        <!--main-->
</body>
<script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/app.js"></script>
<script src="../assets/js/main.js"></script>

</html>