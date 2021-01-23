<?php
require './database.php';
session_start();
if(isset($_SESSION['user'])){
    $session = $_SESSION['user'];
    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='$session'");
    $array = mysqli_fetch_array($query);
    $sessionNumber = intval($array[3])-1;
    mysqli_query($conn, "UPDATE `users` SET `sessions`='$sessionNumber',`lastlogin`='0' WHERE `username`='$session'");
}
if (isset($_POST['send'])){
    $username = $_POST['user'];
    $time = time() + 10;
    $query = "INSERT INTO `users`(`username`,`password`,`sessions`,`lastlogin`) VALUES('$username','1','1','$time')";
    $result = mysqli_query($conn, $query);
    $_SESSION['user']=$username;
    header('location: index.php');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Add User</title>
</head>
<body>
    <form action="./addUser.php" method="post">
    <h1>Add User</h1>
        <input type="text" name="user" id="user" class="user" placeholder="Username" autocomplete="off">
        <input type="submit" value="Add" class="send" id="send" name="send"> 
    </form>
</body>
</html>
</html>