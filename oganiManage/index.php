<?php
    require_once("config.php");
    $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $sql = <<<multi
        SELECT productId, productName, p.categoryId, c.categoryName, price, stock, description, productImg
        FROM `products` p, categories c
        WHERE c.categoryId=p.categoryId
    multi;
    $result = mysqli_query($link, $sql);
    mysqli_close($link);
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
            <h3>商品管理</h3>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                <div class="col-md-12">
                    <button type="button" rel="tooltip" class="btn btn-info btn-sm float-right"
                                        data-original-title="" title="" onclick="location.href='add.php'">
                                        新增資料
                    </button>
                    <h4>商品列表</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>商品名稱</th>
                                <th>商品類別</th>
                                <th class="text-right">商品價格</th>
                                <th class="text-right">商品庫存</th>
                                <th class="text-right">商品圖片</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td class="text-center"><?= $row['productId']?></td>
                                    <td><?= $row['productName']?></td>
                                    <td><?= $row['categoryName']?></td>
                                    <td class="text-right"><?= "NTD" . $row['price']?></td>
                                    <td class="text-right"><?= $row['stock']?></td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" onclick="location.href='edit.php?productId=<?= $row['productId']?>'"
                                            data-original-title="" title="">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm"
                                            data-original-title="" title="" onclick="location.href='delete.php?productId=<?= $row['productId']?>'">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
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