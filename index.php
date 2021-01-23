<?php
    session_start();
    require './database.php';

    if(!isset($_SESSION['user'])){
        header('location: login.php');
    }else{
        $session = $_SESSION['user'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/612f542d54.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Allan&family=Anton&family=Bebas+Neue&family=Courgette&family=Imbue&family=Kaushan+Script&family=Lobster&family=Nova+Square&family=Oswald:wght@300;400&family=PT+Sans+Narrow&family=Pathway+Gothic+One&family=Poppins&family=Potta+One&family=Righteous&family=Roboto:wght@300;400&family=Squada+One&family=Teko:wght@300;400&family=Trade+Winds&family=Yanone+Kaffeesatz:wght@400;500&family=Yellowtail&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="dashboard">
    <h1>User Dashboard
    <p>
    <a class="logout" href="./logout.php">Logout</a> | <a class='logout' href="./addUser.php">Add User</a>
    </p>
    </h1>
    <table>
    <tr class="first">
    <td>ID</td>
    <td>Name</td>
    <td>Sessions</td>
    <td>Status</td>
    </tr>
    <?php
        $query = mysqli_query($conn, "SELECT * FROM `users`");
        while($array = mysqli_fetch_array($query)){
            $time = time();
            $id = md5($array[0]);
            echo "<tr class='$id'>";
            echo "<td>$array[0]</td>";
            if($session == $array[1]){
                echo "<td>$array[1] <strong>(You)</strong></td>";
            }else{
                echo "<td>$array[1]</td>";
            }
            echo "<td class='sessions'>$array[3]</td>";
            if ($array[4] > $time || $array[4] == $time){
                echo "<td class='status online'>Online</td>";
            }else{
                echo "<td class='status offline'>Offline</td>";
            }
            echo "</tr>";
        }
    ?>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script defer src="./js/main.js"></script>
</body>
</html>