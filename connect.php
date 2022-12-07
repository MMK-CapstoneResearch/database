<?php 
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "sarreal_db";
    $conn = mysqli_connect($server, $user, $password, $db);

    if(!$conn){
        die("Could not connect to server". mysqli_connect_error());
    }
?>