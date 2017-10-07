<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HA Dist - Home</title>
</head>
<body>

<?php

require_once 'core/init.php';

if(Session::exists('home')) {
    echo '<p>' . Session::flash('home'). '</p>';
}

$user = new User(); //Current

if($user->isLoggedIn()) {
?>    
    <?php include_once('header.php');?> 
            
            <ul>
                <?php if($user->hasPermission(4) || $user->hasPermission(5)){
                  echo '<li><a href="./material_management.php"> Material Mangement </a></li>';
                  echo '<li><a href="./storage_management.php"> Storage Location </a></li>';
                  echo '<li><a href="./customer_management.php"> Customer Management </a></li>';
                  echo '<li><a href="./shipper_management.php"> Shipper Management </a></li>';
                  echo '<li><a href="./user_management.php"> User Management </a></li>';
                }
                if($user->hasPermission(3) || $user->hasPermission(5) || $user->hasPermission(2) || $user->hasPermission(1)){
                  echo '<li><a href="#"> Reports </a></li>';
                }
                if($user->hasPermission(3) || $user->hasPermission(1) || $user->hasPermission(5)){
                  echo '<li><a href="#"> Purchase Orders </a></li';
                  echo '<li><a href="#"> Invoices </a></li';
                }
                if($user->hasPermission(2) || $user->hasPermission(5)){
                  echo '<li><a href="./so_management.php"> Sales Orders </a></li>';}
                if($user->hasPermission(3) || $user->hasPermission(1) || $user->hasPermission(5)){
                  echo '<li><a href="./shipment_management.php"> Shipment </a></li>';}  
                else {
                  echo "<p>Error with user authorization!</p>";
                }              
                ?> 
            </ul>
<?php
}
else{ 
    echo '<h2>Welcome</h2>';    
    echo '<p> Please login <a href="login.php" target="_parent">here</a>!</a></p>';
}
?>
</body>
</html>