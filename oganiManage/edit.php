<?php
    if(!isset($_GET["productId"])) {
        die("id not found.");
    }
    $productId = $_GET["productId"];
    if(!is_numeric($productId)) {
        die("id is not a number.");
    }
    require_once("config.php");
    $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $sql = <<<multi
        SELECT * FROM `categories`
    multi;
    $result = mysqli_query($link, $sql);

    $productSql = <<<ps
        SELECT * FROM `products` WHERE productId = $productId
    ps;
    $productResult = mysqli_query($link, $productSql);
    $productRow = mysqli_fetch_assoc($productResult);
    $cidSelect = $productRow["categoryId"];
    // echo($cidSelect);
    // var_dump($productRow);
    if(isset($_POST["okButton"])) {
        $productName = $_POST["productName"];
        $categoryId = $_POST["categoryName"];
        $price = $_POST["price"];
        $stock = $_POST["stock"];
        $productImg = $_POST["productImg"];
        $description = $_POST["description"];
        $updateSql = <<<us
            UPDATE products
            SET productName = '$productName', categoryId = '$categoryId', price = '$price', stock = '$stock', description = '$description', productImg = '$productImg'
            WHERE productId = $productId
        us;
        // echo $updateSql;
        mysqli_query($link, $updateSql);
        header("Location: index.php");
    }
    if(isset($_POST["cancelButton"])) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="formStyle.css">

    <title>Document</title>
</head>

<body>
    <div class="registration-form">
        <form method="POST" action="">
            <div class="form-group row">
                <label for="productName" class="col-4 col-form-label">商品名稱：</label>
                <div class="col-8">
                    <input id="productName" name="productName" type="text" class="form-control item" value="<?= $productRow['productName']?>" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="categoryName" class="col-4 col-form-label">商品類別：</label>
                <div class="col-8">
                    <select id="categoryName" name="categoryName" required="required" class="custom-select option">
                        <?php while($row = mysqli_fetch_assoc($result)) {?>
                            <option value="<?= $row['categoryId']?>" <?= ($row['categoryId']==$cidSelect) ? "selected" : "" ?> ><?= $row['categoryName']?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-4 col-form-label">商品價格：</label>
                <div class="col-8">
                    <input id="price" name="price" type="text" class="form-control item" value="<?= $productRow['price']?>" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="stock" class="col-4 col-form-label">商品庫存：</label>
                <div class="col-8">
                    <input id="stock" name="stock" type="text" class="form-control item" value="<?= $productRow['stock']?>" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="productImg" class="col-4 col-form-label">商品圖片名稱：</label>
                <div class="col-8">
                    <input id="productImg" name="productImg" type="text" class="form-control item" value="<?= $productRow['productImg']?>" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-4 col-form-label">商品描述：</label>
                <div class="col-8">
                    <textarea id="description" name="description" cols="40" rows="5" class="form-control item"><?= $productRow['description']?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="okButton" type="submit" class="btn btn-primary" value="OK">新增</button>
                    <button name="cancelButton" type="cancel" class="btn btn-danger">取消</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>

