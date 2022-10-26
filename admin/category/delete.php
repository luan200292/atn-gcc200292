<?php
include_once("../connect.php");
if(isset($_GET['id'])){
    $delQuery = "Delete from category where cat_id ='".$_GET['id']."'";
    if(pg_query($connect, $delQuery)){
        echo "<script> window.location = 'index.php?status=delete';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . pg_error($connect);
    }
}
?>
