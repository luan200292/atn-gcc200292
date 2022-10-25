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
                                    <label for="" class="col-sm-2 control-label">Old Price:  </label>
                                    <div class="col-sm-10">
                                    <input type="number" id="OldPrice" class="form-control" name="OlđPrice"
                                        placeholder="OldPrice" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-outline form-white mb-2">
                                <div class="input-group">
                                    <label for="" class="col-sm-2 control-label">Description:  </label>
                                    <div class="col-sm-10">
                                    <input type="text" id="DetailDesc" class="form-control" name="DetailDesc"
                                        placeholder="Product Description" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-outline form-white mb-2">
                                <div class="input-group">
                                    <label for="" class="col-sm-2 control-label">Date:  </label>
                                    <div class="col-sm-10">
                                    <input id="ProDate" class="form-control" type="date" name="ProDate" value=""
                                        placeholder="yyyy-mm-dd" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-outline form-white mb-2">
                                <div class="input-group">
                                    <label for="" class="col-sm-2 control-label">Quantity:  </label>
                                    <div class="col-sm-10">
                                    <input type="number" id="Pro_qty" class="form-control" name="Pro_qty"
                                        placeholder="Quantity" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-outline form-white mb-2">
                                <div class="input-group">
                                    <label for="image-vertical" class="col-sm-2 control-label">Image:  </label>
                                    <div class="col-sm-10">
                                    <input type="file" name="Pro_image" id="Pro_image" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-outline form-white mb-2">
                                <div class="input-group">
                                    <label for="" class="col-sm-2 control-label">Category ID:  </label>
                                    <div class="col-sm-10">
                                    <input type="text" id="cat_id" class="form-control" name="Cat_ID"
                                        placeholder="Cat id" value="">
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