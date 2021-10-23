<?php

if(!isset($_SESSION['user'])) {
    header('Location: http://localhost/myproject/login.php');
    exit;
}


?>