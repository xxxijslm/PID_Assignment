<?php
    require_once("headeruser.php");
    if (!isset($_GET["productId"])) {
        die("id not found.");
    }
    $productId = $_GET["productId"];
    if (! is_numeric ( $productId ))
        die ( "id not a number." );
    $sql = <<<multi
        DELETE FROM cartDetails WHERE userId = $userId AND productId = $productId
    multi;
    // echo $sql;
    require_once("config.php");
    $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    mysqli_query($link, $sql);
    header("location: shoping-cart.php");
?>