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
    $sql = <<<multi
        SELECT * FROM `users`
    multi;
    $result = mysqli_query($link, $sql);

    $userSql = <<<ps
        SELECT * FROM `users` WHERE userId = $userId
    ps;
    $userResult = mysqli_query($link, $userSql);
    $userRow = mysqli_fetch_assoc($userResult);
    if(isset($_POST["okButton"])) {
        $userName = $_POST["userName"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $updateSql = <<<us
            UPDATE users
            SET userName = '$userName', email = '$email', address = '$address'
            WHERE userId = $userId
        us;
        // echo $updateSql;
        mysqli_query($link, $updateSql);
        header("Location: user.php");
    }
    if(isset($_POST["cancelButton"])) {
        header("Location: user.php");
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
                <label for="userName" class="col-4 col-form-label">會員姓名：</label>
                <div class="col-8">
                    <input id="userName" name="userName" type="text" class="form-control item" value="<?= $userRow['userName']?>" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-4 col-form-label">Email：</label>
                <div class="col-8">
                    <input id="email" name="email" type="email" class="form-control item" value="<?= $userRow['email']?>" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-4 col-form-label">地址：</label>
                <div class="col-8">
                    <input id="address" name="address" type="text" class="form-control item" value="<?= $userRow['address']?>" required="required">
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

