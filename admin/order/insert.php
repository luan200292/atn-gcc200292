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

            $orderDate = pg_real_escape_string($connect, $_POST['orderdate']);
            $address = pg_real_escape_string($connect, $_POST['address']);
            $username = pg_real_escape_string($connect, $_POST['username']);

            $insertQ = "INSERT INTO orders (orderdate, address, username) 
                        VALUES ('$orderDate','$address','$username')";

            if(pg_query($connect, $insertQ)){
                echo"<script>
                    window.location = 'index.php?status=insert'
                </script>";
            }
            else{
                echo "error: ". $insertQ. "<br>". pg_errno($connect);
            }
            
        }
    ?>
<!-- div content -->
<div class="example-wrapper">
    <div className="page-heading pb-2 mt-4 mb-2 ">
        <h3>Manager Order</h3> <a href="index.php"><button type="button" class="btn btn-outline-success">Back to
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
                                        <label for="" class="col-sm-2 control-label">Order Date: </label>
                                        <div class="col-sm-10">
                                            <input id="OrderDate" class="form-control" type="date" name="OrderDate"
                                                value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Address: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="Address" class="form-control" name="Address"
                                                placeholder="Address" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Username: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="username" class="form-control" name="username"
                                                placeholder="Current user" value="" list="user">
                                            <datalist id="user">

                                                <?php
                                                $uSql = "select * from customer";
                                                $re2 = pg_query($connect, $uSql);
                                                while($rowU = pg_fetch_assoc($re2)){
                                                ?>
                                                <option value="<?=$rowU['Username']?>">
                                                    <?=$rowU['Username']?>
                                                </option>
                                                <?php
                                                }
                                                ?>
                                            </datalist>
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