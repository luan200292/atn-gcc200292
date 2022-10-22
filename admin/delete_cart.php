<?php
include_once("connect.php");
if (isset($_GET['id'])) {
    $delQuery = "Delete from cart where record_id='" . $_GET['id'] . "'";
    if (mysqli_query($conn, $delQuery)) {
        echo "<script> window.location = 'index.php?status=delete';</script>";
        header("Location: cart.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>