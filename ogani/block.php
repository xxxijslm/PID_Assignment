<?php
    $blockSql = <<< bs
        SELECT block 
        FROM `users`
        WHERE userId = $userId
    bs;
    $blockResult = mysqli_query($link, $blockSql);
    $blockRow = mysqli_fetch_assoc($blockResult);
    $block = $blockRow['block'];
    if ($block == 1) {
        unset($_SESSION["userName"]);
        unset($_SESSION["userId"]);
        echo "<script>alert('警告：會員被停用'); location.href = 'index.php';</script>";
    }
?>