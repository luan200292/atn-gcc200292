<?php
include_once("header.php");
include_once("connect.php");

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  if (isset($_GET['id'])) {
    $p_id = $_GET['id'];
    $checkEx = mysqli_query($conn, "SELECT p_id from cart where username ='$user' and p_id='$p_id'");

    if (mysqli_num_rows($checkEx) == 0) {
      $query = "INSERT INTO cart(username, p_id, p_qty, date) VALUES('$user',
    '$p_id',1,CURDATE())"; 
    } else {
      $query = "UPDATE cart SET p_qty = p_qty + 1 where username = '$user' and
    p_id = '$p_id'";
    }

    if (!mysqli_query($conn, $query)) {
      echo "Error " . mysqli_error($conn);
    }
  }

} else {
  echo "<script> location.href = 'login.php'</script>";
}

$sqlSelect = "SELECT * FROM cart c, product p WHERE c.p_id = p.Product_id and username = '$user'";
  $resShow = mysqli_query($conn, $sqlSelect);
  $sum = 0;


?>
<section class="h-100 h-custom" style="background: url(./img/backgr.jpg) repeat;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                    <h6 class="mb-0 text-muted"><?= mysqli_num_rows($resShow) ?> item(s)</h6>
                  </div>
                  <?php
                  while ($row = mysqli_fetch_assoc($resShow)) {
                  ?>
                    <hr class="my-4">

                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                      <div class="col-md-2 col-lg-2 col-xl-2">
                        <img src="./img/<?= $row['Pro_image'] ?>" class="img-fluid rounded-3" alt="">
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-3">
                        <h6 class="text-black mb-0"><?= $row['Product_Name'] ?></h6>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex">

                        <input id="form1" min="0" name="quantity" value="<?= $row['p_qty'] ?>" type="number" class="form-control form-control-sm" />
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h6 class="mb-0"><span>&#36;</span> <?= $row['p_qty'] ?> * <?= $row['Price'] ?></h6>
                      </div>

                      <?php
                      $sum = $sum + $row['p_qty'] * $row['Price'];
                      ?>

                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a href="delete_cart.php?id=<?= $row['record_id'] ?>" class="text-muted text-decoration-none">x</a>
                      </div>
                    </div>
                  <?php
                  }
                  ?>
                  <hr class="my-4">

                  <div class="pt-5">
                    <h6 class="mb-0"><a href="index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Total price</h5>
                    <h5><span>&#36;</span> <?= $sum ?></h5>
                  </div>
                  <form action="" method="POST">
                    <a href="order.php" class="btn btn-dark btn-block btn-lg" 
                    data-mdb-ripple-color="dark">Order</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
include_once("footer.php");
?>