<?php
    require_once("config.php");
    $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $sql = <<<multi
        SELECT userId, userName, email, address, block
        FROM `users`
    multi;
    $result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
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
            <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                <div class="col-md-12">
                    <h4>會員管理</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>會員名稱</th>
                                <th>Email</th>
                                <th>地址</th>
                                <th class="text-right block">封鎖</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td class="text-center"><?= $row['userId']?></td>
                                    <td><?= $row['userName']?></td>
                                    <td><?= $row['email']?></td>
                                    <td><?= $row['address']?></td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-secondory btn-round btn-just-icon btn-sm" onclick="location.href='useredit.php?userId=<?= $row['userId']?>'"
                                            data-original-title="" title="">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-round btn-just-icon btn-sm"
                                            data-original-title="" title="" onclick="location.href='order.php?userId=<?= $row['userId']?>'">
                                            <i class="material-icons">reorder</i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn <?=($row['block']) ? "btn-danger": "btn-secondory" ?> btn-round btn-just-icon btn-sm" 
                                        data-original-title="" title="" onclick="location.href='block.php?userId=<?= $row['userId']?>&block=<?= $row['block']?>'">
                                            <i class="material-icons">person</i>
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