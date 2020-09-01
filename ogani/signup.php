<?php
    // var_dump($link);
    if (isset($_POST["submit"])) {
        $userName = $_POST["userName"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $passwordAgain = $_POST["passwordAgain"];  
        // echo($hash);
        if($password == $passwordAgain) {
            $hash = hash('sha256', $password);
            $command = <<<lines
                SELECT * FROM `users`
                WHERE email="$email"
            lines;
            require_once("config.php");
            $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
            $result = mysqli_query($link, $command);
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $erracc = "*Email帳號已經註冊";
            }
            else {
                $sql = <<<multi
                    INSERT INTO users
                    (userName, email, password, address)
                    VALUES
                    ('$userName', '$email', '$hash', '$address')
                multi;
                // echo($sql);
                
                // echo($dbname);
                
                mysqli_query($link, $sql);
                header("Location: index.php");
            }
            
        }
        else {
            $err = "*輸入密碼不一致";
        }
    }
    mysqli_close($link);

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
        body {
            background-color: #dee9ff;
        }

        .registration-form {
            padding: 50px 0;
        }

        .registration-form form {
            background-color: #fff;
            max-width: 600px;
            margin: auto;
            padding: 50px 70px;
            border-radius: 30px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
        }
        .registration-form .item{
            border-radius: 20px;
            margin-bottom: 25px;
            padding: 10px 20px;
        }
        .registration-form .create-account{
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            background-color: #5791ff;
            border: none;
            color: white;
            margin-top: 20px;
        }
        span {
            color: red;
        }
    </style>
</head>

<body>
    <div class="registration-form">
        <form method="POST" action="">
            <div class="form-group row">
                <label class="col-4 col-form-label" for="userName">姓名：</label>
                <div class="col-8">
                    <input id="userName" name="userName" placeholder="請輸入真實姓名" type="text" value="<?= $userName?>" required="required"
                        class="form-control item">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-4 col-form-label">Email：</label>
                <div class="col-8">
                    <input id="email" name="email" placeholder="請填寫有效的Email" type="email" class="form-control item" value="<?= $email?>"
                        required="required">
                    <span><?= $erracc?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-4 col-form-label">地址：</label> 
                <div class="col-8">
                    <input id="address" name="address" placeholder="請輸入地址" type="text" class="form-control item" value="<?= $address?>" required="required">
                </div>
            </div> 
            <div class="form-group row">
                <label for="password" class="col-4 col-form-label">密碼：</label>
                <div class="col-8">
                    <input id="password" name="password" placeholder="請設定6-15位英數字含大小寫" type="password"
                        required="required" class="form-control item" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,30}$">
                </div>
            </div>
            <div class="form-group row">
                <label for="passwordAgain" class="col-4 col-form-label">確認密碼：</label>
                <div class="col-8">
                    <input id="passwordAgain" name="passwordAgain" placeholder="請再輸入一次密碼" type="password"
                        required="required" class="form-control item">
                    <span><?= $err?></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-2 col-8">
                    <button name="submit" type="submit" class="btn btn-block create-account">立即註冊</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>