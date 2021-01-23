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
session_unset();
session_destroy();
header('location: login.php');

?>