<?php
include_once("../connect.php");
if(isset($_GET['id'])){
    $delQuery = "Delete from product where Product_ID='".$_GET['id']."'";
    if(mysqli_query($conn, $delQuery)){
        echo "<script> window.location = 'index.php?status=delete';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
