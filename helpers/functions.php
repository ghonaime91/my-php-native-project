<?php

    function print_messages($txt) {

        if(isset($_SESSION['message'])) {
            foreach($_SESSION['message'] as $K => $v) {
                echo "*".$v."<br>";
            }
            
            unset($_SESSION['message']);

        } else {
            echo $txt;   
        }


        

    }


    function url($url) {

        return "http://".$_SERVER['HTTP_HOST']."/myproject/DB/".$url;
    }



?>