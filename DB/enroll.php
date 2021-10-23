<?php

require "../helpers/db_connection.php";
require "../helpers/validator.php";
require "../helpers/checklogin.php";
#course id validation
$id = $_GET['id'];
if(!validate($id,"is_int")) {
    echo "Wrong id you will redirect to our courses page!";
    header( "refresh:2;url= courses.php" );
    exit;
}

$player_id = $_SESSION['user']['id'];
#fetch data first
$sql1  = "select * from courses where player_id = $player_id and matrial_id = $id";
$op1   = mysqli_query($con,$sql1);

#in case the player try to enroll twice
if(mysqli_num_rows($op1) > 0) {
    echo "<h1 style='color:red; margin:auto;'>You alredy enrolled in this course</h1><br>
    <h3>You will be redirected to our courses page</h3>";
    header( "refresh:2;url= courses.php" );
    exit;
}

# player enrollment
$sql = "insert into courses (player_id,matrial_id) values ($player_id,$id)";
$op  = mysqli_query($con,$sql);
if($op) {
    echo "<h1 style='color:green; margin:auto;'>You have been successfully enrolled for the course</h1><br>
    <h3>You will be redirected to your courses page</h3>";
    header( "refresh:3;url= player.php" );
} else {
    echo "Error try again";
}




?>