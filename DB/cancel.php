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
$sql = "delete from courses where matrial_id = $id";
$op  = mysqli_query($con,$sql);

if($op) {
    echo "<h1 style='color:blue; margin:auto;'>You have been canceld the course</h1><br>
    <h3>You will be redirected to your courses page</h3>";
    header( "refresh:2;url= player.php" );
    exit;
}
else {
    echo "Error try again";
}


?>