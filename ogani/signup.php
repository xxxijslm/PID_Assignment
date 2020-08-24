<?php
    // var_dump($link);
    if (isset($_POST["submit"])) {
        $userName = $_POST["userName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordAgain = $_POST["passwordAgain"];  
        // echo($hash);
        if($password == $passwordAgain) {
            $hash = hash('sha256', $password);
            $sql = <<<multi
                INSERT INTO users
                (userName, email, password)
                VALUES
                ('$userName', '$email', '$hash')
            multi;
            // echo($sql);
            require_once("config.php");
            // echo($dbname);
            $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
            mysqli_query($link, $sql);

            header("Location: index.php");
        }
        else {
            $err = "*輸入密碼不一致";
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="scripts/jquery-1.9.1.min.js"></script>
    <title>Sign up form</title>
    <style>
        .container {
            margin-top: 20px;
        }
        span {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="POST" action="">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="userName">姓名：</label>
                <div class="col-8">
                    <input id="userName" name="userName" placeholder="請輸入真實姓名" type="text" value="<?= $userName?>" required="required"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-4 col-form-label">Email：</label>
                <div class="col-8">
                    <input id="email" name="email" placeholder="請填寫有效的Email" type="email" class="form-control" value="<?= $email?>"
                        required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-4 col-form-label">密碼：</label>
                <div class="col-8">
                    <input id="password" name="password" placeholder="請設定6-15位英數字混合密碼，英文需區分大小寫" type="password"
                        required="required" class="form-control" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,30}$">
                </div>
            </div>
            <div class="form-group row">
                <label for="passwordAgain" class="col-4 col-form-label">確認密碼：</label>
                <div class="col-8">
                    <input id="passwordAgain" name="passwordAgain" placeholder="請再輸入一次密碼" type="password"
                        required="required" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-success">立即註冊</button>
                    <span><?= $err?></span>
                </div>
            </div>
        </form>
    </div>
</body>

</html>