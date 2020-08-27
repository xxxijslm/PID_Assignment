<?php
    if(!isset($_GET["userId"])) {
        die("id not found.");
    }
    $userId = $_GET["userId"];
    if(!is_numeric($userId)) {
        die("id is not a number.");
    }
    require_once("config.php");
    $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $sql = <<< multi
    SELECT o.userId, u.userName, u.email, od.orderId, od.productId, p.productName, quantity, od.price, o.orderDate, o.shippedDate, o.orderStatusId, os.orderStatusName, od.quantity*od.price AS total
    FROM (((orderDetails od JOIN orders o ON o.orderId = od.orderId)
    JOIN products p ON p.productId = od.productId)
    JOIN orderStatus os ON os.orderStatusId = o.orderStatusId)
    JOIN users u ON u.userId = o.userId
    WHERE o.userId = $userId
    ORDER BY o.orderDate DESC
    multi;
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    // var_dump($row);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="title">
            <h3><a href="index.php" class="active" >商品管理</a>
            ｜<a href="user.php">會員管理</a></h3>
        </div>
        <div class="row">
            <div class="col-lg-10 col-md-10 ml-auto mr-auto">
                <div class="col-md-12">
                    <h4>訂單列表</h4>
                    <h4><?= $row['userName'] . " " . $row['email']?><h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>產品編號</th>
                                <th>產品名稱</th>
                                <th class="text-right">數量</th>
                                <th class="text-right">總額</th>
                                <th class="text-right">訂單日期</th>
                                <th class="text-right">出貨日期</th>
                                <th class="text-right">狀態</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td class="text-center"><?= $row['orderId']?></td>
                                    <td class="text-center"><?= $row['productId']?></td>
                                    <td><?= $row['productName']?></td>
                                    <td class="text-right"><?= $row['quantity']?></td>
                                    <td class="text-right"><?= "NTD" . $row['total']?></td>
                                    <td class="text-right"><?= $row['orderDate']?></td>
                                    <td class="text-right"><?= $row['shippedDate']?></td>
                                    <td class="text-right"><?= $row['orderStatusName']?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>