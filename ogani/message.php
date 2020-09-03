<?php
    require_once("headeruser.php");
    require_once("config.php");
    $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $selectIdSql = <<< si
        SELECT productId
        FROM `cartDetails`
        WHERE userId = $userId
        ORDER BY cartId DESC
    si;
    // var_dump($selectIdSql);
    $selectIdResult = mysqli_query($link,$selectIdSql);
    $i = 0;
    while($selectIdRow = mysqli_fetch_assoc($selectIdResult)) {
        $product[$i] = $selectIdRow['productId'];
        $i++;
    }
    // var_dump($product[1]);
    $j = 0;
    foreach($_POST as $item) {
        foreach($item as $quantity) {
    //         echo($quantity);
            $productId = $product[$j];
            $updateSql = <<<us
                UPDATE cartDetails
                SET quantity = $quantity
                WHERE productId = $productId;
            us;
            $j++;
            // var_dump($updateSql);
            mysqli_query($link,$updateSql);
        }
    }
    $quantitySql = <<< qs
        DELETE FROM `cartDetails`
        WHERE userId = $userId AND quantity = 0
    qs;
    mysqli_query($link,$quantitySql);
?>