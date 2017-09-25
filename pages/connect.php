<?php
function db_connect(){
    $server="localhost";
    $user="root";
    $password="";		//XAMPP
    $database="ha_distribution";

    mysql_connect($server, $user, $password) or die("Database connection has failed!<br>".mysql_error());
    mysql_select_db($database) or die("Unable to connect to .$database. database<br>".mysql_error());
    mysql_query("SET CHARACTER SET UTF8");
}

function db_disconnect(){
 
}
?>