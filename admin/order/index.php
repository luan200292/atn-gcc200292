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

td, th, a {
    font-size: 15px
}
</style>

<?php
    include_once("../connect.php");
    $sql1 = "select * from orders";
    $re1 = mysqli_query($conn,$sql1);
    ?>

<div class="example-wrapper">
    <div class="container mb-3">
        <h3>Manage Product</h3> <a href="insert.php"><button type="button" class="btn btn-outline-success">Insert</button></a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">OrderDate</th>
                    <th scope="col">DeliveryDate</th>
                    <th scope="col">Address</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                            while($row = mysqli_fetch_assoc($re1)){
                            ?>
                <tr>
                    <td><?=$row['OrderID']?></td>
                    <td><?=$row['OrderDate']?></td>
                    <td><?=$row['DeliveryDate']?></td>
                    <td><?=$row['Address']?></td>
                    <td><span>&#36;</span>
                        <?php
                                        $id = $row['OrderID'];
                                        $totalpay = mysqli_query($conn, "SELECT * FROM orders where OrderID = '$id'");
                                        $payment = mysqli_fetch_row($totalpay);
                                    ?>
                        <?=$payment[4]?>
                    </td>
                    <td><?=$row['status']?></td>
                    <td>
                        <a href="update.php?id=<?=$row['OrderID']?>" class="btn btn-outline-success rounded-pill">
                            Update
                        </a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?=$row['OrderID']?>" class="btn btn-outline-warning rounded-pill">
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