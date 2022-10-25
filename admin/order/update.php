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
<div class="example-wrapper">
    <div className="page-heading pb-2 mt-4 mb-2 ">
        <h3>Manage Order</h3> <a href="index.php"><button type="button" class="btn btn-outline-success">Back to
                index</button></a>
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
                                                value="<?=$row['OrderID']?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Order Date: </label>
                                        <div class="col-sm-10">
                                            <input id="OrderDate" class="form-control" type="date" name="OrderDate"
                                                value="<?=$row['OrderDate']?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Address: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="Address" class="form-control" name="Address"
                                                placeholder="Product Name" value="<?=$row['Address']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Payment: </label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <?php
                                                    $sql1 = mysqli_query($conn, "SELECT sum(total) FROM `orders_detail` WHERE Order_ID='$oid'");
                                                    $result = mysqli_fetch_row($sql1);
                                                ?>
                                                <div class="col-8">
                                                    <input type="number" id="Payment" class="form-control"
                                                        name="Payment" value="<?=$result[0]?>" readonly>
                                                </div>
                                                <div class="col-4">
                                                    <a href="insertDetail.php?id=<?=$row['OrderID']?>"><button
                                                            type="button" class="btn btn-warning rounded-pill"
                                                            name="Detail">Add/Update</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Status: </label>
                                        <div class="col-sm-10">
                                        <div class="form-check col-sm-2">
                                            <input checked class="form-check-input" type="radio" name="status"
                                                id="status1" value="Packing">
                                            <label class="form-check-label" for="status1">
                                                Packing
                                            </label>
                                        </div>
                                        <div class="form-check col-sm-2">
                                            <input class="form-check-input" type="radio" name="status" id="status2"
                                                value="Delivered">
                                            <label class="form-check-label" for="status2">
                                                Delivered
                                            </label>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Username: </label>
                                        <div class="col-sm-10">
                                        <input type="text" id="username" class="form-control" name="username"
                                            placeholder="Current user" value="<?=$row['username']?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-warning me-1 mb-1 rounded-pill"
                                        name="Update">Submit</button>
                                    <button type="reset"
                                        class="btn btn-light-secondary me-1 mb-1 rounded-pill">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>