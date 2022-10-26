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
    $sid = $_GET['id'];
    $sql = "SELECT *FROM category where cat_id = '$sid'";
    $re = pg_query($connect, $sql);
    $row = pg_fetch_assoc($re);
}

if(isset($_POST['Update'])){
    $sid = $_GET['id'];
    $catName = pg_escape_string($connect, $_POST['cat_Name']);
    $des = pg_escape_string($connect, $_POST['des']);

    $uSQL = "UPDATE category SET cat_name ='$catName', cat_des = '$des'";

    pg_query($connect,$uSQL);
    
}
 ?>

<!-- div content -->
<div class="example-wrapper">
    <div className="page-heading pb-2 mt-4 mb-2 ">
        <h3>Manager Category</h3> <a href="index.php"><button type="button" class="btn btn-outline-success">Back to
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
                                        <label for="" class="col-sm-2 control-label">Category ID: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="pid" class="form-control" name="cat_id"
                                                placeholder="Category ID" value="<?=$row['cat_id']?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Category Name: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="pname" class="form-control" name="cat_Name"
                                                placeholder="Category Name" value="<?=$row['cat_name']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Description: </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="des" class="form-control" name="des"
                                                placeholder="Description" value="<?=$row['cat_des']?>">
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