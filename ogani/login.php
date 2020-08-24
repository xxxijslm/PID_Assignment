<?php
    session_start();
    if(isset($_POST["submit"])) {
        $email = $_POST["emailTextBox"];
        $password = $_POST["passwordTextBox"];
        if($email != "" and $password != "") {
            $hash = hash('sha256', $password);
            $sql = <<<multi
                SELECT * FROM `users`
                WHERE email="$email" AND password="$hash"
            multi;
            require_once("config.php");
            $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);
            // var_dump($row["userName"]);
            if ($row) {
                $_SESSION["userName"] = $row["userName"];
                header("Location: index.php");
            }
            else {
                $err="帳號或密碼錯誤！請重新輸入";
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <label for="email" class="col-4 col-form-label">帳號：</label>
                <div class="col-8">
                    <input id="emailTextBox" name="emailTextBox" placeholder="Email" type="email" class="form-control" value="<?= $email?>" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-4 col-form-label">密碼：</label>
                <div class="col-8">
                    <input id="passwordTextBox" name="passwordTextBox" placeholder="請輸入密碼" type="password" required="required"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-success">登入</button>
                    <button name="cancel" type="cancel" class="btn btn-danger">取消</button>
                    <span><?= $err ?></span>
                </div>
            </div>
        </form>
    </div>
    
</body>

</html>