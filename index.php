<?php
include_once("header.php");
?>
<div class="container mt-3">
  <h2>All Products</h2>
  <div class="row">
    <?php
    include_once("connect.php");
    $sql = "select * from product";
    $re = pg_query($connect, "SELECT * FROM product");
    while( $row = pg_fetch_array($re)){
    ?>
      <div class="col-md-4">
            <div class="card">
                <img
                src="img/<?=$row['Pro_image']?>"
                class="card-img-top"
                alt="<?=$row['Product_Name']?>" style="margin: auto;
    width: max-content;" height="250px"
                />
                <div class="card-body">
                <a href="detail.php?id=<?=$row['Product_ID']?>" class="text-decoration-none">
                <h5 class="card-title"><?=$row['Product_Name']?></h5></a>
                <h6 class="card-subtitle mb-2 text-muted"><span>&#36;</span><?=$row['Price']?></h6>
                <a href="cart.php?id=<?=$row['Product_ID']?>" 
                class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
      </div>
      <?php
    }
      ?>
  </div>
</div>

</body>
<script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>

</html>