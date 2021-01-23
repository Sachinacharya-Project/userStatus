<?php
require './database.php';
session_start();
if(isset($_SESSION['user'])){
    header('location: index.php');
}

if(isset($_POST['send'])){
    $username = $_POST['user'];
    $query = "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    $arrayAssoc = mysqli_fetch_array($result);
    $time = time()+10;
    $sessionNumber = intval($arrayAssoc[3]);
    if ($rows > 0){
        $_SESSION['user'] = $username;
        if ($arrayAssoc[4] > time() || $arrayAssoc[4] == time()){
            $sessionNumber = $sessionNumber + 1;
        }else{
            $sessionNumber = 1;
        }
        mysqli_query($conn, "UPDATE `users` SET `sessions`='$sessionNumber',`lastlogin`='$time' WHERE `username`='$username'");
        header('location: index.php');
    }else{
        echo "<script>alert('Create Account first')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>
    <form action="./login.php" method="post">
    <h1>Login</h1>
        <input type="text" name="user" id="user" class="user" placeholder="Username" autocomplete="off">
        <input type="submit" value="Login" class="send" id="send" name="send"> 
    </form>
</body>
</html>