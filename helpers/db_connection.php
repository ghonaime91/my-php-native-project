<?php 
    session_start();
    $db_server = "localhost";
    $db_user   = "root";
    $db_pass   = "";
    $db_name   = "chess_academy"; 
    $con       = mysqli_connect($db_server,$db_user,$db_pass,$db_name);
    if(!$con) {
        die("ERROR".mysqli_connect_error());
    }
?>
