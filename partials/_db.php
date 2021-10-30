<?php

//Scripting to connect database in php
$servername = "localhost";
$username = "root";
$password = "";
$database = "idiscuss";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Sorry database was not connected due to this issue => " . mysqli_connect_error());
}
else{
    echo "";
}

?>