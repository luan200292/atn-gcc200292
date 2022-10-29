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
    $sql1 = "SELECT * FROM shop";
    $re1 = pg_query($connect,$sql1);
    ?>

<div class="example-wrapper">
    <div class="container mb-3">
        <h3>Manager Shop</h3> <a href="insert.php"><button type="button"
                class="btn btn-outline-success">Insert</button></a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Campus</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                            while($row=pg_fetch_assoc($re1)){
                            ?>
                <tr>
                    <td><?=$row['shop_id']?></td>
                    <td><?=$row['shop_name']?></td>
                    <td><?=$row['shop_campus']?></td>
                    <td><?=$row['shop_address']?></td>
                    <td><?=$row['shop_email']?></td>
                    <td>
                        <a href="update.php?id=<?=$row['shop_id']?>" class="btn btn-outline-success rounded-pill">
                            Update
                        </a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?=$row['shop_id']?>" class="btn btn-outline-warning rounded-pill">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php
                            }
                            ?>
            </tbody>
        </table>
        <table class="table table-striped table-hover" style="width: 50%;">
            <thead>
                <tr>
                    <th scope="col">Shop ID</th>
                    <th scope="col">ShopCost</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sqlcost = "SELECT s.shop_id, sum(pro_qty*oldprice)  as cost 
                    from product p 
                    inner join shop s on s.shop_id = p.shop_id
                    group by s.shop_id
                    order by s.shop_id ASC";
                    $re1 = pg_query($connect,$sqlcost);
                            while($row=pg_fetch_assoc($re1)){
                            ?>
                <tr>
                    <td><?=$row['shop_id']?></td>
                    <td><?=$row['cost']?></td>
                </tr>
                <?php
                            }
                            ?>
                
            </tbody>
        </table>
        <table class="table table-striped table-hover" style="width: 50%;">
            <thead>
                <tr>
                    <th scope="col">Shop ID</th>
                    <th scope="col">Revenue</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sqlturnover = "SELECT p.shop_id, sum(od.pro_qty*p.price)  as revenue 
                    from product p 
                    inner join orders_detail od on od.product_id = p.product_id
                    group by p.shop_id
                    order by p.shop_id ASC";
                    $re1 = pg_query($connect,$sqlturnover);
                            while($row=pg_fetch_assoc($re1)){
                            ?>
                <tr>
                    <td><?=$row['shop_id']?></td>
                    <td><?=$row['revenue']?></td>
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