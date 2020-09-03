<?php
    session_start();
    $lastPage = $_SESSION["lastPage"];
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
            if ($row['block'] == false) {
                if ($row) {
                    $_SESSION["userName"] = $row["userName"];
                    $_SESSION["userId"] = $row["userId"];
                    header("Location: $lastPage");
                }
                else {
                    $err="帳號未註冊或帳號密碼錯誤！請重新輸入";
                }
            }
            else {
                $err="會員被停用！";
            }
        }
    }
    
    mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/formStyle.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <h3 style="text-align: center">登入</h3>
    <div class="registration-form">
        <form method="POST" action="">
            
            <div class="form-group row">
                <label for="emailTextBox" class="col-4 col-form-label">帳號：</label>
                <div class="col-8">
                    <input id="emailTextBox" name="emailTextBox" placeholder="Email" type="email" class="form-control" value="<?= $email?>" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="passwordTextBox" class="col-4 col-form-label">密碼：</label>
                <div class="col-8">
                    <input id="passwordTextBox" name="passwordTextBox" placeholder="請輸入密碼" type="password" required="required"
                        class="form-control">
                    <input id ="passwordCheckBox" name="passwordCheckBox" type="checkbox" onclick="showPass()">
                    <label for="passwordCheckBox">顯示密碼</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-success">登入</button>
                    <button name="cancel" type="cancel" class="btn btn-danger" onclick="javascript:location.href='index.php'">取消</button>
                    <span><?= $err ?></span>
                </div>
            </div>
        </form>
    </div>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>
<script>
    function showPass() {
        var x = document.getElementById("passwordTextBox");
        if (x.type === "password") {
            x.type = "text";
        } 
        else {
            x.type = "password";
        }
    }
</script>
</html>