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

                    <li class="sidebar-item active ">
                        <a href="../product/" class='sidebar-link'>
                            
                            <span>Product</span>
                        </a>
                    </li>

                    <li class="sidebar-item  ">
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
        <div className="page-heading pb-2 mt-4 mb-2 ">
            <h3>Manager</h3> <a href="index.php"><button type="button" class="btn btn-outline-primary">Back to index</button></a>
        </div>

    <?php
        include_once("../connect.php");
        if(isset($_POST['Insert'])){
            $id = mysqli_real_escape_string($conn, $_POST['product_id']);
            $productName = mysqli_real_escape_string($conn, $_POST['Product_Name']);
            $price = mysqli_real_escape_string($conn, $_POST['Price']);
            $smailDesc = mysqli_real_escape_string($conn, $_POST['SmallDesc']);
            $detailDesc = mysqli_real_escape_string($conn, $_POST['DetailDesc']);
            $productDate = mysqli_real_escape_string($conn, $_POST['ProDate']);
            $quantity = mysqli_real_escape_string($conn, $_POST['Pro_qty']);
            $image = mysqli_real_escape_string($conn, $_POST['Pro_image']);
            $catID = mysqli_real_escape_string($conn, $_POST['Cat_ID']);


            $checkpid = mysqli_query($conn, "SELECT Product_ID from product where `Product_ID`='$id'");
            $rowpid = mysqli_fetch_row($checkpid);
            if(!$rowpid[0]==$id){
            $insertQ = "INSERT INTO `product`(`Product_ID`, `Product_Name`, `Price`, `SmallDesc`,
                        `DetailDesc`, `ProDate`, `Pro_qty`, `Pro_image`, `Cat_ID`) 
                        VALUES ('$id','$productName','$price','$smailDesc','$detailDesc','$productDate',
                        '$quantity','$image','$catID')";

            if(mysqli_query($conn, $insertQ)){
                echo"<script>
                    window.location = 'index.php?status=insert'
                </script>";
            }
            else{
                echo "error: ". $insertQ. "<br>". mysqli_errno($conn);
            }
            }else{
                echo "<script>alert('The Order Detail ID has already exists! Please enter another ID!')</script>";
            }
        }
    ?>

        <div class="page-content mt-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" method="POST" action="#">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Product ID</label>
                                            <input type="text" id="pid" class="form-control"
                                                name="product_id" placeholder="Product ID"
                                                value ="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Product Name</label>
                                            <input type="text" id="pname" class="form-control"
                                                name="Product_Name" placeholder="Product Name"
                                                value ="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Price</label>
                                            <input type="number" id="Price" class="form-control"
                                                name="Price" placeholder="Price" value ="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Product Small Description</label>
                                            <input type="text" id="SmallDesc" class="form-control"
                                                name="SmallDesc" placeholder="Product Small Description"
                                                value ="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Product Description</label>
                                            <input type="text" id="DetailDesc" class="form-control"
                                                name="DetailDesc" placeholder="Product Description"
                                                value ="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Product Date</label>
                                            <input id="ProDate" class="form-control" type="date" name="ProDate" value ="" placeholder="yyyy-mm-dd"/>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Quantity</label>
                                            <input type="number" id="Pro_qty" class="form-control"
                                                name="Pro_qty" placeholder="Quantity" value ="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image-vertical">Image</label>
                                            <input type="file" name="Pro_image" id="Pro_image" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password-vertical">Cat id</label>
                                            <input type="text" id="cat_id" class="form-control"
                                                name="Cat_ID" placeholder="Cat id" value ="">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-warning me-1 mb-1 rounded-pill" name="Insert">Submit</button>
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
<script src="ASM_200292/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="ASM_200292/assets/js/bootstrap.bundle.min.js"></script>
<script src="ASM_200292/assets/js/app.js"></script>

</html>