<?php
include_once("header.php");
include_once("connect.php");

if (isset($_GET['id'])) {
  $sql = "select * from product where Product_ID='" . $_GET['id'] . "'";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_row($res);
} else if (isset($_GET['pid']) && isset($_GET['quantity_input'])) {
  echo "<script> 
  window.location = 'cart.php?pid=" . $_GET['pid'] .
    "&qty=" . $_GET['quantity_input'] . "'
        </script>";
} else {
  header("Location: index.php");
  die();
}


?>
<link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<section class="h-100 h-custom" style="background: url(./img/backgr.jpg) repeat;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">

              <div class="col-lg-5 p-5">
                <div class="image_selected ms-3"><img src="img/<?= $row[8] ?>" alt=""></div>
              </div>
              <div class="col-lg-7 p-5">
                <div class="product_description">
                  <div class="product_name"><?= $row[1] ?></div>

                  <div> <span class="product_price"><span>&#36;</span> <?= $row[2] ?></div>

                  <div>
                    <span class="product_info"><?= $row[5] ?><span><br>
                        <span class="product_info">In Stock: <?= $row[7] ?><span>
                  </div>

                  <hr class="singleline">
                  <div class="order_info d-flex flex-row">
                    <form action="#">
                  </div>
                  <div class="row">
                    <form action="cart.php" method="get">
                      <input type="hidden" id="quantity_input" class="form-control" name="pid" value="<?= $row[0] ?>">
                      <div class="col-lg-3 mb-4" style="margin-left: 13px;">
                        <div class="form-group">
                          <label for="qty_label">Quantity:</label>
                          <input type="number" id="quantity_input" class="form-control" name="quantity_input" value="1">
                        </div>
                      </div>
                      <div class="col-lg-9">
                        <a href="cart.php?id=<?= $row[0] ?>" class="btn btn-primary">Add to Cart</a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>

</html>