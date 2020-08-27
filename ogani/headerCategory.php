<?php
$categorySql = <<< cat
SELECT * FROM `categories`
cat;

$categoryResultHeader = mysqli_query($link, $categorySql);
$countResultHeader = mysqli_fetch_assoc($categoryResultHeader);
?>