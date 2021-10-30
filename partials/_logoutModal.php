<?php

if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
    include '_db.php';

    session_start();
    session_unset();
    session_destroy();

    header("Location: /idiscuss forum project/");
}





?>