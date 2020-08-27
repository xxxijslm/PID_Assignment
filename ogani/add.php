<?php
    require_once("headeruser.php");
    require_once("config.php");
    $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    if (!isset($_GET["confirm"])) {
        die("id not found.");
    }
    $comfirm = $_GET["confirm"];
    if (! is_numeric ( $comfirm ))
        die ( "id not a number." );

    if(isset($_GET["confirm"])) {
        $sql = <<< multi
            INSERT INTO orders
            (userId, orderDate)
            VALUES
            ($userId, current_timestamp())
        multi;
        $result = mysqli_query($link, $sql);
        $orderSql = <<< os
            SELECT orderId, userId, orderDate
            FROM `orders`
            WHERE userId = $userId
            ORDER BY orderDate DESC LIMIT 1
        os;
        $orderResult = mysqli_query($link, $orderSql);
        $orderRow = mysqli_fetch_assoc($orderResult);
        // var_dump ($orderRow['orderId']);
        $orderId = $orderRow['orderId'];
        $cartSql = <<< cart
            SELECT userId, productId, price, quantity
            FROM `cartDetails`
            WHERE userId = $userId
        cart;
        $cartResult = mysqli_query($link, $cartSql);
        while ($cartRow = mysqli_fetch_assoc($cartResult)) {
            $productId = $cartRow['productId'];
            $quantity = $cartRow['quantity'];
            $price = $cartRow['price'];
            $orderDetailSql = <<<od
                INSERT INTO orderDetails
                (orderId, productId, quantity, price)
                VALUES
                ($orderId, $productId, $quantity, $price)
            od;
            $orderDetailResult = mysqli_query($link, $orderDetailSql);
        }
        $cartDeleteSql = <<<cd
            DELETE FROM `cartDetails` 
            WHERE userId = $userId
        cd;
        $cartDeleteResult = mysqli_query($link, $cartDeleteSql);
        header("Location: order-details.php");
    }
?>