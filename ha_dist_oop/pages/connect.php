<?php
//function db_connect(){
//    $server="localhost";
//    $user="root";
//    $password="";		//XAMPP
//    $database="ha_distribution";

//    mysql_connect($server, $user, $password) or die("Database connection has failed!<br>".mysql_error());
//    mysql_select_db($database) or die("Unable to connect to .$database. database<br>".mysql_error());
//    mysql_query("SET CHARACTER SET UTF8");}

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "ha_distribution";

try {
       $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
       // set the PDO error mode to exception
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       
    }
catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }

require_once("./assets/classes/userClass.php");
$user = new User($conn);

?>