<?php
    require './database.php';
    $returnArray = array();
    $query = mysqli_query($conn, "SELECT * FROM `users`");
    $status = "";
    $sessionNumber = "";
    while($array = mysqli_fetch_array($query)){
        $time = time();
        if ($array[4] > $time || $array[4] == $time){
            $status = 'online';
            $sessionNumber = $array[3];
        }else{
            $status = 'offline';
            mysqli_query($conn, "UPDATE `users` SET `sessions`='0' WHERE `username`='$array[1]'");
            $sessionNumber = $array[3];
        }
        $returnArray[] = array(
            'id'=> md5($array[0]),
            'status'=> $status,
            'sessions'=>$sessionNumber
        );
    }
    echo json_encode($returnArray);

?>


