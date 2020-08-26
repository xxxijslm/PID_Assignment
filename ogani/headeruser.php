<?php
    session_start();
    // $userName = "";
    // $userId = "";
    if(isset($_SESSION["userName"])) {
        $userName = $_SESSION["userName"];
        $userId = $_SESSION["userId"];
        // var_dump($userName);
    }
    if(isset($_GET["logout"])) {
        unset($_SESSION["userName"]);
        unset($_SESSION["userId"]);
        header("Location: index.php");
    }
    
?>