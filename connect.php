<?php

// $server = "localhost";
// $username ="root";
// $password = "";
// $db = "shop_200292";

// $conn = mysqli_connect($server,$username,$password,$db);
// if($conn->connect_error){
//     die("Failed ".$conn->connect_error);
// }

$connect = pg_connect("postgres://oakrmkxyxkzrcn:290b4d7f5261f0b87e9ad4092e07849ca3f8a057c48dfb741bd9d5db81a46ad2@ec2-23-21-76-219.compute-1.amazonaws.com:5432/d5p244d1hmimcv");

if(!$connect){
    die("Connect failed!");
}

?>