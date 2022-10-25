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
    $pid = $_GET['id'];
    $sql = "select * from product where Product_ID = '$pid'";
    $re = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($re);
}

if(isset($_POST['Update'])){
    $pid = $_GET['id'];
    $ProductName = mysqli_real_escape_string($conn, $_POST['Product_Name']);
    $Price = mysqli_real_escape_string($conn, $_POST['Price']);
    $SmallDesc = mysqli_real_escape_string($conn, $_POST['SmallDesc']);
    $DetailDesc = mysqli_real_escape_string($conn, $_POST['DetailDesc']);
    $ProductDate = mysqli_real_escape_string($conn, $_POST['ProDate']);
    $Quantity = mysqli_real_escape_string($conn, $_POST['Pro_qty']);
    $CatID = mysqli_real_escape_string($conn, $_POST['Cat_ID']);

    if($_FILES['imgUp']['name']==""){
        $imgUp = $_POST['imgOld'];
    }
    else{
        $imgUp = basename($_FILES['imgUp']['name']);
    }

    $uSQL = "UPDATE `product` SET `Product_Name`='$ProductName', `Price`='$Price',
    `SmallDesc`='$SmallDesc', `DetailDesc`='$DetailDesc', `ProDate`='$ProductDate', 
    `Pro_qty`='$Quantity', `Pro_image`='$imgUp', `Cat_ID`='$CatID'
     WHERE `Product_ID`='$pid'";

    mysqli_query($conn,$uSQL);
    
}
 ?>

<!-- div content -->
<div class="example-wrapper">
    <div className="page-heading pb-2 mt-4 mb-2 ">
        <h3>Manager</h3> <a href="index.php"><button type="button" class="btn btn-outline-success">Back to
                index</button></a>
    </div>
    <div class="page-content mt-4">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" method="POST" action="" enctype="multipart/form-data">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Product ID: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="pid" class="form-control" name="product_id"
                                                placeholder="Product ID" value="<?=$row['Product_ID']?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Product Name: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="pname" class="form-control" name="Product_Name"
                                                placeholder="Product Name" value="<?=$row['Product_Name']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Price: </label>
                                        <div class="col-sm-10">
                                            <input type="number" id="Price" class="form-control" name="Price"
                                                placeholder="Price" value="<?=$row['Price']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Old Price: </label>
                                        <div class="col-sm-10">
                                            <input type="number" id="OldPrice" class="form-control" name="OlđPrice"
                                                placeholder="OldPrice" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Description: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="DetailDesc" class="form-control" name="DetailDesc"
                                                placeholder="Product Description" value="<?=$row['DetailDesc']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Date: </label>
                                        <div class="col-sm-10">
                                            <input id="ProDate" class="form-control" type="date" name="ProDate"
                                                value="<?=$row['ProDate']?>" placeholder="yyyy-mm-dd" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Quantity: </label>
                                        <div class="col-sm-10">
                                            <input type="number" id="Pro_qty" class="form-control" name="Pro_qty"
                                                placeholder="Quantity" value="<?=$row['Pro_qty']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="image-vertical" class="col-sm-2 control-label">Image: </label>
                                        <div class="col-sm-10">
                                            <input type="file" name="Pro_image" id="Pro_image" class="form-control"
                                                value="<?=$row['Pro_image']?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input type="hidden" name="imgOld" value="<?=$row['Pro_image']?>">
                                            <img src="../../img/<?=$row['Pro_image']?>" class="img-thumbnail" alt="oops"
                                                width="100" height="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Category ID: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="cat_id" class="form-control" name="Cat_ID"
                                                placeholder="Cat id" value="<?=$row['Cat_ID']?>">
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