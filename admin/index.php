<?php
include_once("header.php");
?>
<div class="container mt-3">
  <h2>All Products</h2>
  <div class="row">
    <?php
    include_once("connect.php");
    $sql = "select * from product";
    $re = pg_query($connect, "SELECT * FROM product ORDER BY product_id ASC");
    while( $row = pg_fetch_array($re)){
    ?>
      <div class="col-md-4">
            <div class="card">
                <img
                src="../img/<?=$row['pro_image']?>"
                class="card-img-top"
                alt="<?=$row['product_name']?>" style="margin: auto;
    width: max-content;" height="250px"
                />
                <div class="card-body">
                <a href="detail.php?id=<?=$row['product_id']?>" class="text-decoration-none">
                <h5 class="card-title"><?=$row['product_name']?></h5></a>
                <h6 class="card-subtitle mb-2 text-muted"><span>&#36;</span><?=$row['price']?></h6>
                <a href="cart.php?id=<?=$row['product_id']?>" 
                class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
      </div>
      <?php
    }
      ?>
  </div>
</div>

<?php
include("../footer.php");
?>