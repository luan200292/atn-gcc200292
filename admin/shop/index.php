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
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Turnover</th>
                    <th scope="col">Cost</th>
                    <th scope="col">Profit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sqlcost = "SELECT p.shop_id, s.shop_name, sum(p.oldprice*p.pro_qty) 
                    as cost, od.total as turnover, od.total-sum(p.oldprice*p.pro_qty) as profit
                    FROM product p 
                    INNER JOIN shop s ON p.shop_id = s.shop_id 
                    INNER JOIN orders_detail od ON p.product_id = od.product_id
                    INNER JOIN orders o ON od.order_id = o.order_id
                    
                    group by p.shop_id, s.shop_name, od.total";
                    $re1 = pg_query($connect,$sqlcost);
                            while($row=pg_fetch_assoc($re1)){
                            ?>
                <tr>
                    <td><?=$row['shop_id']?></td>
                    <td><?=$row['shop_name']?></td>
                    <td><?=$row['turnover']?></td>
                    <td><?=$row['cost']?></td>
                    <td><?=$row['profit']?></td>
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