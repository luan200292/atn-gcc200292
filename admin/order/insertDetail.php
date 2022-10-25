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

            $listDetail = "select * from orders_detail where order_id ='" . $_GET['id'] . "' and orderdeatil_id = '" . $_GET['odid'] . "'";
            $res1 = pg_query($connect, $listDetail);
            $lD = pg_fetch_row($res1);
        }


        if (isset($_POST['Insert'])) {

            $Product_ID = pg_escape_string($connect, $_POST['Product_ID']);
            $Pro_Qty = pg_escape_string($connect, $_POST['Pro_Qty']);

            $data = pg_query($connect, "select rice from public.product where product_id = '$Product_ID'");
            $rData = pg_fetch_assoc($data);
            $Price = $rData['price'];
            $total = $Price * $Pro_Qty;

            
            $checkEx = pg_query($connect, "SELECT product_id FROM orders_detail WHERE order_id = '$id' and product_id = '$Product_ID'");
                
                if (pg_num_rows($checkEx) == 0) {
                $insertQuery = "INSERT INTO public.orders_detail( order_id, product_id, pro_qty, price, total) 
            VALUES ('$id','$Product_ID',$Pro_Qty,$Price,$total)";
            

            } else {
                $insertQuery = "UPDATE orders_detail SET pro_qty = pro_qty + $Pro_Qty, total = total + $total 
            WHERE order_id = '$id' and product_id = '$Product_ID'";
            }

            if (pg_query($connect, $insertQuery)) {
            } else {
                echo "Error: " . $sql . "<br>" . pg_error($connect);
            }
            
        }
        $sumTotalQuery  = pg_query($connect, "SELECT sum(total) FROM public.orders_detail WHERE order_id = '$id'");
        $sumTotal = pg_fetch_row($sumTotalQuery);

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
                                                    $rePro = pg_query($connect, $selectProduct);
                                                    while ($rowP = pg_fetch_assoc($rePro)) {
                                                    ?>
                                                <option value="<?= $rowP['product_id'] ?>"><?= $rowP['product_name'] ?>
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

            $listProduct = "select * from public.orders_detail where order_id ='" . $_GET['id'] . "'";
            $r = pg_query($connect, $listProduct);

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
                <?php while ($resLP = pg_fetch_assoc($r)) { ?>
                <tr>
                    <td><?= $resLP['order_id'] ?></td>
                    <td><?= $resLP['oderdetail_id'] ?></td>
                    <td><?= $resLP['product_id'] ?></td>
                    <td><?= $resLP['pro_qty'] ?></td>
                    <td><?= $resLP['price'] ?></td>
                    <td><?= $resLP['total'] ?></td>
                    <td><a href="insertDetail.php?id=<?= $resLP['order_id'] ?>&odid=<?= $resLP['oderdetail_id'] ?>"
                            class="btn btn-warning rounded-pill">Update</a></td>
                    <td><a href="delete.php?oid=<?= $resLP['order_id'] ?>&odid=<?= $resLP['oderdetail_id'] ?>"
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