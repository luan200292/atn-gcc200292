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
            $id = pg_escape_string($connect, $_POST['Shop_id']);
            $ShopName = pg_escape_string($connect, $_POST['Shop_Name']);
            $campus = pg_escape_string($connect, $_POST['campus']);
            $address = pg_escape_string($connect, $_POST['address']);
            $email = pg_escape_string($connect, $_POST['email']);
            

            $checkpid = pg_query($connect, "SELECT product_id from product where product_id = '$id'");
            $rowpid = pg_fetch_row($checkpid);
            if($rowpid[0]!=$id){
            $insertQ = "INSERT INTO public.shop (shop_id, shop_name, shop_campus, shop_address, shop_email) 
                        VALUES ('$id','$ShopName', '$campus', '$address', '$email')";

            if(pg_query($connect, $insertQ)){
                echo"<script>
                    window.location = 'index.php?status=insert'
                </script>";
            }
            // else{
            //     echo "error: ". $insertQ. "<br>". pg_errno($connect);
            // }
            }else{
                echo "<script>alert('The Shop ID has already exists! Please enter another ID!')</script>";
            }
        }
    ?>
<!-- div content -->
<div class="example-wrapper">
    <div className="page-heading pb-2 mt-4 mb-2 ">
        <h3>Manager Shop</h3> <a href="index.php"><button type="button" class="btn btn-outline-success">Back to
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
                                        <label for="" class="col-sm-2 control-label">Shop ID: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="pid" class="form-control" name="Shop_id"
                                                placeholder="Shop ID" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Shop Name: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="pname" class="form-control" name="Shop_Name"
                                                placeholder="Shop Name" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Campus: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="campus" class="form-control" name="campus"
                                                placeholder="Campus" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Address: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="address" class="form-control" name="address"
                                                placeholder="Address" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Email: </label>
                                        <div class="col-sm-10">
                                            <input type="email" id="email" class="form-control" name="email"
                                                placeholder="Email" value="">
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