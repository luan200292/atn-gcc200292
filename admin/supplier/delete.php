<?php
include_once("../connect.php");
if(isset($_GET['id'])){
    $delQuery = "Delete from supplier where supplier_id ='".$_GET['id']."'";
    if(pg_query($connect, $delQuery)){
        echo "<script> window.location = 'index.php?status=delete';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . pg_error($connect);
    }
}
?>
