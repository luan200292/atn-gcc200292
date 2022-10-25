<?php
include_once("../connect.php");

if(isset($_GET['oid']) && isset($_GET['odid'])){
    $delQuery = "Delete from orders_detail where orderdetail_id = '".$_GET['odid']."'";
    if(pg_query($connect, $delQuery)){
        echo "<script> window.location = 'insertDetail.php?id=".$_GET['oid']."'
        </script>";
    } else {
        echo "Error: " . $delQuery . "<br>" . pg_error($connect);
    }
}

if(isset($_GET['id'])){
    $delQuery = "Delete from orders where order_id ='".$_GET['id']."'";
    if(pg_query($connect, $delQuery)){
        echo "<script> window.location = 'index.php?status=delete';
        </script>";
    } else {
        echo "Error: " . $delQuery . "<br>" . pg_error($connect);
    }
}
?>
