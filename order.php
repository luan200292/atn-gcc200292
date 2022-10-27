<?php
include_once("connect.php");
    
    session_start();

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        
        $sql = "select * from cart where username = '$user'";
        $re = pg_query($connect, $sql);

        if (pg_num_rows($re) > 0) {

        // Insert Order table

        $sql1 = "SELECT * from public.user where username = '$user'";
        $re1 = pg_query($connect, $sql1);
        $row1 = pg_fetch_assoc($re1);
        $add = $row1['address'];

        $sql2 = "SELECT SUM(c.p_qty*p.price) as sum, c.p_qty, p.price from product p, cart c 
        WHERE p.product_id = c.p_id and username = '$user' group by c.p_qty, p.price";
        $re2 = pg_query($connect, $sql2);
        $row2 = pg_fetch_assoc($re2);
        $pay = $row2['sum'];
        
        $sql3 = "INSERT INTO public.orders (orderdate, address, payment, username) VALUES (CURRENT_DATE ,'$add', $pay ,'$user')";
        pg_query($connect, $sql3);

        // Insert Order Detail

        //Get ID of order
        $oid = "SELECT MAX(order_id) as orderid FROM orders where username = '$user'";
        $re3 = pg_query($connect, $oid);
        $row3 = pg_fetch_assoc($re3);
        $orderid = $row3['orderid'];
        
        //Insert into order detail
        $sql4 = "SELECT * FROM cart c, product p WHERE c.p_id = p.product_id and username = '$user'";
        $re4 = pg_query($connect, $sql4);
        while($row = pg_fetch_assoc($re4)){
            $pro_id = $row['p_id'];
            $pro_qty = $row['p_qty'];
            $price = $row['price'];
            $total = $row['p_qty'] * $row['price'];

            $sql5 = "INSERT INTO orders_detail (order_id, product_id, pro_qty, price, total) 
            VALUES ($orderid, '$pro_id', $pro_qty, $price, $total)";
            pg_query($connect, $sql5);
        }

        // Result

        $delete = "delete from cart where username = '$user'";
        pg_query($connect, $delete);

        //Check admin
        
        echo "<script>alert('Order successfully')</script>";
        $checkadm = pg_query($connect, "SELECT * FROM public.user WHERE username = '$user'");
        $rowadm = pg_fetch_assoc($checkadm);
        $_SESSION['role'] = $rowadm['role'];
        if($rowadm['role'] == "admin"){
            echo"<script>window.location = 'admin/index.php'</script>";
        }else{
            echo"<script>window.location = 'index.php'</script>";
        }
    }
    else {
        echo "<script>alert('Please add product to order')</script>";
        $checkadm = pg_query($connect, "SELECT * FROM public.user WHERE username = '$user'");
        $rowadm = pg_fetch_assoc($checkadm);
        $_SESSION['role'] = $rowadm['role'];
        if($rowadm['role'] == "admin"){
            echo"<script>window.location = 'admin/index.php'</script>";
        }else{
            echo"<script>window.location = 'index.php'</script>";
        }
    }      
        
    }
