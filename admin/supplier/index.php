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
    $sql1 = "SELECT * FROM supplier";
    $re1 = pg_query($connect,$sql1);
    ?>

<div class="example-wrapper">
    <div class="container mb-3">
        <h3>Manager Shop</h3> <a href="insert.php"><button type="button" class="btn btn-outline-success">Insert</button></a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                            while($row=pg_fetch_assoc($re1)){
                            ?>
                <tr>
                    <td><?=$row['supplier_id']?></td>
                    <td><?=$row['supplier_name']?></td>
                    <td><?=$row['supplier_des']?></td>
                    <td><?=$row['supplier_phone']?></td>
                    <td><?=$row['supplier_email']?></td>
                    <td>
                        <a href="update.php?id=<?=$row['supplier_id']?>" class="btn btn-outline-success rounded-pill">
                            Update
                        </a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?=$row['supplier_id']?>" class="btn btn-outline-warning rounded-pill">
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