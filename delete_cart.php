<?php
include_once("connect.php");
if (isset($_GET['id'])) {
    $delQuery = "Delete from cart where record_id ='" . $_GET['id'] . "'";
    if (pg_query($connect, $delQuery)) {
        echo "<script> window.location = 'index.php?status=delete';</script>";
        echo "<script> location.href = 'cart.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . pg_error($connect);
    }
}
?>