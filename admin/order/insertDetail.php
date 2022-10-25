<?php
include_once("../headerA.php");
?>
<style>
.example-wrapper {
    margin: 1em auto;
    max-width: 1200px;
    width: 90%;
    font: 18px/1.5 sans-serif;
}

.example-wrapper code {
    background: #F5F5F5;
    padding: 2px 6px;
}

td,
th,
a {
    font-size: 15px
}
</style>
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
<div class="example-wrapper">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div className="page-heading pb-2 mt-4 mb-2 ">
        <h3>Manage Order</h3>
        <a href="update.php?id=<?= $_GET['id'] ?>&total=<?= $sumTotal[0] ?>"><button type="button"
                class="btn btn-outline-success">Save</button></a>

    </div>
    <div class="page-content mt-4">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" method="POST" action="#">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Order ID: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="oid" class="form-control" name="oid"
                                                value="<?= $_GET['id'] ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Product: </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" list="p" name="Product_ID" id="Product_ID"
                                                value="<?= $lD[2] ?? '' ?>" required>

                                            <datalist id="p">
                                                <?php
                                                    $selectProduct = "select * from product";
                                                    $rePro = mysqli_query($conn, $selectProduct);
                                                    while ($rowP = mysqli_fetch_assoc($rePro)) {
                                                    ?>
                                                <option value="<?= $rowP['Product_ID'] ?>"><?= $rowP['Product_Name'] ?>
                                                </option>
                                                <?php
                                                    }
                                                    ?>
                                            </datalist>
                                        </div>
                                        <label for="" class="col-sm-2 control-label">Quantity: </label>
                                        <div class="col-sm-4">
                                            <input type="number" id="Pro_Qty" class="form-control" name="Pro_Qty"
                                                value="<?= $lD[3] ?? '' ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-warning me-1 mb-1 rounded-pill"
                                    name="Insert">Add</button>
                                <button type="reset"
                                    class="btn btn-light-secondary me-1 mb-1 rounded-pill">Reset</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
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
</div>
</div>
</div>