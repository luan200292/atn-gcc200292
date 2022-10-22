<?php
include_once("connect.php");
    
    session_start();

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        
        $sql = "select * from cart where username = '$user'";
        $re = mysqli_query($conn, $sql);

        if (mysqli_num_rows($re) > 0) {

        // Insert Order table

        $sql1 = "select Address from customer where Username = '$user'";
        $re1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($re1);
        $add = $row1['Address'];

        $sql2 = "SELECT SUM(p_qty*Price), p_qty, Price from product p, cart c WHERE p.Product_ID = c.p_id and username = '$user'";
        $re2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($re2);
        $pay = $row2['SUM(p_qty*Price)'];
        
        $sql3 = "INSERT INTO `orders`(`OrderDate`, `Address`,`Payment`, `username`) VALUES (NOW(),'$add',' $pay' ,'$user')";
        mysqli_query($conn, $sql3);

        // Insert Order Detail

        //Get ID of order
        $oid = "SELECT MAX(OrderID) FROM orders";
        $re3 = mysqli_query($conn, $oid);
        $row3 = mysqli_fetch_assoc($re3);
        $orderid = $row3['MAX(OrderID)'];
        
        //Insert into order detail
        $sql4 = "SELECT * FROM cart c, product p WHERE c.p_id = p.Product_ID and username = '$user'";
        $re4 = mysqli_query($conn, $sql4);
        while($row = mysqli_fetch_assoc($re4)){
            $pro_id = $row['p_id'];
            $pro_qty = $row['p_qty'];
            $price = $row['Price'];
            $total = $row['p_qty'] * $row['Price'];

            $sql5 = "INSERT INTO `orders_detail`(`Order_ID`, `Product_ID`, `Pro_Qty`, `Price`, `Total`) 
            VALUES ($orderid, '$pro_id', $pro_qty, $price, $total)";
            mysqli_query($conn, $sql5);
        }

        // Result

        $delete = "delete from cart where username = '$user'";
        mysqli_query($conn, $delete);

        //Check admin
        
        echo "<script>alert('Order successfully')</script>";
        $checkadm = mysqli_query($conn, "SELECT * FROM customer WHERE Username = '$user'");
        $rowadm = mysqli_fetch_assoc($checkadm);
        $_SESSION['user'] = $rowadm['Username'];
        if($rowadm['Username'] == "admin"){
            echo"<script>window.location = 'admin/index.php'</script>";
        }else{
            echo"<script>window.location = 'index.php'</script>";
        }
    }
    else {
        echo "<script>alert('Please add product to order')</script>";
        $checkadm = mysqli_query($conn, "SELECT * FROM customer WHERE Username = '$user'");
        $rowadm = mysqli_fetch_assoc($checkadm);
        $_SESSION['user'] = $rowadm['Username'];
        if($rowadm['Username'] == "admin"){
            echo"<script>window.location = 'admin/index.php'</script>";
        }else{
            echo"<script>window.location = 'index.php'</script>";
        }
    }      
        
    }
