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
    $sql1 = "SELECT p.product_id, p.product_name, p.price, p.oldprice, 
    p.description, p.prodate, p.pro_qty, p.pro_image, 
    cat_name, shop_address, supplier_name 
    FROM product p
    INNER JOIN category cat ON p.cat_id = cat.cat_id
    INNER JOIN shop s ON p.shop_id = s.shop_id
    INNER JOIN supplier su ON p.supplier_id = su.supplier_id ORDER BY product_id ASC";
    $re1 = pg_query($connect,$sql1);
    ?>

<div class="example-wrapper">
    <div class="container mb-3">
        <h3>Manage Product</h3> <a href="insert.php"><button type="button" class="btn btn-outline-success">Insert</button></a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Old Price</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Shop</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                            while($row=pg_fetch_assoc($re1)){
                            ?>
                <tr>
                    <td><?=$row['product_id']?></td>
                    <td><?=$row['product_name']?></td>
                    <td><span>&#36;</span><?=$row['oldprice']?></td>
                    <td><span>&#36;</span><?=$row['price']?></td>
                    <td><?=$row['description']?></td>
                    <td><?=$row['pro_qty']?></td>
                    <td><img src="../../img/<?=$row['pro_image']?>" class="card-img-top" alt="<?=$row['product_name']?>"
                            style="margin: auto; width: max-content;" height="80px" /></td>
                    <td><?=$row['cat_name']?></td>
                    <td><?=$row['shop_address']?></td>
                    <td><?=$row['supplier_name']?></td>
                    <td>
                        <a href="update.php?id=<?=$row['product_id']?>" class="btn btn-outline-success rounded-pill">
                            Update
                        </a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?=$row['product_id']?>" class="btn btn-outline-warning rounded-pill">
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