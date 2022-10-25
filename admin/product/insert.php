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
        if(isset($_POST['Insert'])){
            $id = pg_escape_string($connect, $_POST['product_id']);
            $productName = pg_escape_string($connect, $_POST['Product_Name']);
            $price = pg_escape_string($connect, $_POST['Price']);
            $oldprice = pg_escape_string($connect, $_POST['OldPrice']);
            $detailDesc = pg_escape_string($connect, $_POST['DetailDesc']);
            $productDate = pg_escape_string($connect, $_POST['ProDate']);
            $quantity = pg_escape_string($connect, $_POST['Pro_qty']);
            $image = pg_escape_string($connect, $_POST['Pro_image']);
            $catID = pg_escape_string($connect, $_POST['Cat_ID']);
            $shopID = pg_escape_string($connect, $_POST['Shop_ID']);
            $supID = pg_escape_string($connect, $_POST['Sup_ID']);

            $checkpid = pg_query($connect, "SELECT product_id from product where product_id = '$id'");
            $rowpid = pg_fetch_row($checkpid);
            if($rowpid[0]!=$id){
            $insertQ = "INSERT INTO public.product (product_id, product_name, price, oldprice,
                        description, prodate, pro_qty, pro_image, cat_id, shop_id, supplier_id) 
                        VALUES ('$id','$productName', $price, $oldprice, '$detailDesc', '$productDate',
                        $quantity,'$image','$catID', '$shopID', '$supID')";

            if(pg_query($connect, $insertQ)){
                echo"<script>
                    window.location = 'index.php?status=insert'
                </script>";
            }
            else{
                echo "error: ". $insertQ. "<br>". pg_errno($connect);
            }
            }else{
                echo "<script>alert('The Product ID has already exists! Please enter another ID!')</script>";
            }
        }
    ?>
<!-- div content -->
<div class="example-wrapper">
    <div className="page-heading pb-2 mt-4 mb-2 ">
        <h3>Manager Product</h3> <a href="index.php"><button type="button" class="btn btn-outline-success">Back to
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
                                        <label for="" class="col-sm-2 control-label">Product ID: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="pid" class="form-control" name="product_id"
                                                placeholder="Product ID" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Product Name: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="pname" class="form-control" name="Product_Name"
                                                placeholder="Product Name" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Price: </label>
                                        <div class="col-sm-10">
                                            <input type="number" id="Price" class="form-control" name="Price"
                                                placeholder="Price" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Old Price: </label>
                                        <div class="col-sm-10">
                                            <input type="number" id="OldPrice" class="form-control" name="OldPrice"
                                                placeholder="OldPrice" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Description: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="DetailDesc" class="form-control" name="DetailDesc"
                                                placeholder="Product Description" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Date: </label>
                                        <div class="col-sm-10">
                                            <input id="ProDate" class="form-control" type="date" name="ProDate" value=""
                                                placeholder="yyyy-mm-dd" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Quantity: </label>
                                        <div class="col-sm-10">
                                            <input type="number" id="Pro_qty" class="form-control" name="Pro_qty"
                                                placeholder="Quantity" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="image-vertical" class="col-sm-2 control-label">Image: </label>
                                        <div class="col-sm-10">
                                            <input type="file" name="Pro_image" id="Pro_image" class="form-control"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Category ID: </label>
                                        <div class="col-sm-10">
                                            <select class="custom-select form-control mt-1" name="Cat_ID"
                                                id="Cat_ID" required="required">
                                                <option value="">Choose Category</option>
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
                                                <option value="">Choose Shop</option>
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
                                                <option value="">Choose Suplier</option>
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
                                        name="Insert">Submit</button>
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