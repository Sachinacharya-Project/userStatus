<?php
require './database.php';
session_start();
$returnArray = array();
if(isset($_SESSION['user'])){
    $session = $_SESSION['user'];
}
$time = time()+10;
mysqli_query($conn, "UPDATE `users` SET `lastlogin`='$time' WHERE `username`='$session'");
?>