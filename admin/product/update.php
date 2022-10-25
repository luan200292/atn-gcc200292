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
    $sql = "SELECT p.product_id, p.product_name, p.price, p.oldprice, 
    p.description, p.prodate, p.pro_qty, p.pro_image, 
    cat_name, shop_address, supplier_name, cat.cat_id, s.shop_id, su.supplier_id
    FROM product p
    INNER JOIN category cat ON p.cat_id = cat.cat_id
    INNER JOIN shop s ON p.shop_id = s.shop_id
    INNER JOIN supplier su ON p.supplier_id = su.supplier_id where Product_ID = '$pid'";
    $re = pg_query($connect, $sql);
    $row = pg_fetch_assoc($re);
}

if(isset($_POST['Update'])){
    $pid = $_GET['id'];
    $ProductName = pg_escape_string($connect, $_POST['Product_Name']);
    $Price = pg_escape_string($connect, $_POST['Price']);
    $Oldprice = pg_escape_string($connect, $_POST['OldPrice']);
    $DetailDesc = pg_escape_string($connect, $_POST['DetailDesc']);
    $ProductDate = pg_escape_string($connect, $_POST['ProDate']);
    $Quantity = pg_escape_string($connect, $_POST['Pro_qty']);
    $catID = pg_escape_string($connect, $_POST['Cat_ID']);
    $shopID = pg_escape_string($connect, $_POST['Shop_ID']);
    $supID = pg_escape_string($connect, $_POST['Sup_ID']);

    if($_FILES['imgUp']['name']==""){
        $imgUp = $_POST['imgOld'];
    }
    else{
        $imgUp = basename($_FILES['imgUp']['name']);
    }

    $uSQL = "UPDATE product SET product_name ='$ProductName', price = $Price,
    oldprice = $Oldprice, description ='$DetailDesc', prodate = '$ProductDate', 
    pro_qty = $Quantity, pro_image = '$imgUp', cat_id = '$catID', shop_id = '$shopID',
    supplier_id = '$supID' WHERE product_id = '$pid'";

    pg_query($connect,$uSQL);
    
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
                                                placeholder="Product ID" value="<?=$row['product_id']?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Product Name: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="pname" class="form-control" name="Product_Name"
                                                placeholder="Product Name" value="<?=$row['product_name']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Price: </label>
                                        <div class="col-sm-10">
                                            <input type="number" id="Price" class="form-control" name="Price"
                                                placeholder="Price" value="<?=$row['price']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Old Price: </label>
                                        <div class="col-sm-10">
                                            <input type="number" id="OldPrice" class="form-control" name="OldPrice"
                                                placeholder="OldPrice" value="<?=$row['oldprice']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Description: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="DetailDesc" class="form-control" name="DetailDesc"
                                                placeholder="Product Description" value="<?=$row['description']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Date: </label>
                                        <div class="col-sm-10">
                                            <input id="ProDate" class="form-control" type="date" name="ProDate"
                                                value="<?=$row['prodate']?>" 
                                                placeholder="mm/dd/yyyy" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Quantity: </label>
                                        <div class="col-sm-10">
                                            <input type="number" id="Pro_qty" class="form-control" name="Pro_qty"
                                                placeholder="Quantity" value="<?=$row['pro_qty']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="image-vertical" class="col-sm-2 control-label">Image: </label>
                                        <div class="col-sm-10">
                                            <input type="file" name="imgUp" id="imgUp" class="form-control"
                                                value="<?=$row['pro_image']?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input type="hidden" name="imgOld" value="<?=$row['pro_image']?>">
                                            <img src="../../img/<?=$row['pro_image']?>" class="img-thumbnail" alt="oops"
                                                width="100" height="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Category ID: </label>
                                        <div class="col-sm-10">
                                        <select class="custom-select form-control mt-1" name="Cat_ID"
                                                id="Cat_ID" required="required">
                                                <option value="<?=$row['cat_id']?>"><?=$row['cat_name']?></option>
                                                <?php
                        $sqlCategory = "SELECT cat_id, cat_name FROM category";
                        $reCategory = pg_query($connect, $sqlCategory);
                        while($rowCategory = pg_fetch_assoc($reCategory)){
                        ?>
                                                <option value="<?= $rowCategory['cat_id'] ?>">
                                                    <?= $rowCategory['cat_name'] ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Shop ID: </label>
                                        <div class="col-sm-10">
                                            <select class="custom-select form-control mt-1" name="Shop_ID" id="Shop_ID"
                                                required="required">
                                                <option value="<?= $row['shop_id'] ?>"><?= $row['shop_address'] ?></option>
                                                <?php
                        $sqlShop = "SELECT * FROM shop;";
                        $reShop = pg_query($connect, $sqlShop);
                        while ($rowShop = pg_fetch_assoc($reShop)) {
                        ?>
                                                <option value="<?= $rowShop['shop_id'] ?>"><?= $rowShop['shop_address'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Supplier ID: </label>
                                        <div class="col-sm-10">
                                            <select class="custom-select form-control mt-1" name="Sup_ID" id="Sup_ID"
                                                required="required">
                                                <option value="<?= $row['supplier_id'] ?>"><?= $row['supplier_name'] ?></option>
                                                <?php
                        $sqlSuplier = "SELECT * FROM supplier";
                        $reSuplier = pg_query($connect, $sqlSuplier);
                        while ($rowSuplier = pg_fetch_assoc($reSuplier)) {
                        ?>
                                                <option value="<?= $rowSuplier['supplier_id'] ?>"><?= $rowSuplier['supplier_name'] ?>
                                                </option>
                                                <?php } ?>
                                            </select>
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