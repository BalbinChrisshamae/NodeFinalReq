<?php

$host = "localhost";
$username = "root";
$pass = "";
$db = "forumdb";

$con = new mysqli($host,$username,$pass,$db);

if($con->connect_error){
    die("Connection failed: " .$con->connect_error);
}
else{
   //echo 'Connected Successfully';
}

?>