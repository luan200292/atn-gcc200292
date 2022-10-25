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
    $sql1 = "select * from product";
    $re1 = mysqli_query($conn,$sql1);
    ?>

<div class="example-wrapper">
    <div class="container mb-3">
        <h3>Manager Product</h3> <a href="insert.php"><button type="button" class="btn btn-outline-success">Insert</button></a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Image</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                            while($row=mysqli_fetch_assoc($re1)){
                            ?>
                <tr>
                    <td><?=$row['Product_ID']?></td>
                    <td><?=$row['Product_Name']?></td>
                    <td><span>&#36;</span><?=$row['Price']?></td>
                    <td><?=$row['DetailDesc']?></td>
                    <td><?=$row['Pro_qty']?></td>
                    <td><img src="../../img/<?=$row['Pro_image']?>" class="card-img-top" alt="<?=$row['Product_Name']?>"
                            style="margin: auto; width: max-content;" height="80px" /></td>
                    <td>
                        <a href="update.php?id=<?=$row['Product_ID']?>" class="btn btn-outline-success rounded-pill">
                            Update
                        </a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?=$row['Product_ID']?>" class="btn btn-outline-warning rounded-pill">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php
                            }
                            ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>