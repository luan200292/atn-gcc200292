<?php
include_once("../connect.php");

if(isset($_GET['oid']) && isset($_GET['odid'])){
    $delQuery = "Delete from orders_detail where OrderDetail_ID='".$_GET['odid']."'";
    if(mysqli_query($conn, $delQuery)){
        echo "<script> window.location = 'insertDetail.php?id=".$_GET['oid']."'
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if(isset($_GET['id'])){
    $delQuery = "Delete from orders where OrderID='".$_GET['id']."'";
    if(mysqli_query($conn, $delQuery)){
        echo "<script> window.location = 'index.php?status=delete';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
