<?php

$server = "localhost";
$username ="root";
$password = "";
$db = "shop_200292";

$conn = mysqli_connect($server,$username,$password,$db);
if($conn->connect_error){
    die("Failed ".$conn->connect_error);
}

// $connect = pg_connect("postgres://aplgbbvfsxcumt:96be0b6f5c7fdc3d0c1db96f23be41a36b8c8705d44f842d1ac1de8f7cd96559@ec2-52-70-45-163.compute-1.amazonaws.com:5432/ddcas6v5knkt8l");

// if(!$connect){
//     die("Connect failed!");
// }

?>