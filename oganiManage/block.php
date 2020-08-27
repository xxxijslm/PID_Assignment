<?php
    if ((!isset($_GET["userId"])) and (!isset($_GET["block"] ))) {
        die("userId and block not found.");
    }
    $userId = $_GET["userId"];
    $block = $_GET["block"];
    if ((! is_numeric ( $userId )) && (! is_numeric ( $block )))
        die ( "id not a number." );
    if ($block) {
        $sql = <<<multi
            UPDATE users
            SET block = false
            WHERE userId = $userId
        multi;
    }
    else {
        $sql = <<<multi
            UPDATE users
            SET block = true
            WHERE userId = $userId
        multi;
    }
    // echo $sql;
    require_once("config.php");
    $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    mysqli_query($link, $sql);
    header("location: user.php");
?>