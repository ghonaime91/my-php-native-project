<?php
require "../../helpers/db_connection.php";
require "../../helpers/validator.php";
require "../../helpers/checklogin.php";

$id = $_GET['id'];

if(validate($id,'is_int')) {

    $sql = "DELETE FROM contact_us WHERE id = $id";
    $op  = mysqli_query($con,$sql);
    if($op) {
        $message = "message deleted";
    } else {
        $message = "Error try again";
    } 

} else {
    $message = "Invalid id";
}

$_SESSION['message']=[$message];
header("Location: index.php");




?>