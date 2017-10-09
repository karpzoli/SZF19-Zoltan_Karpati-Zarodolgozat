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
         <div class="pure-menu custom-restricted-width"> 
            <span class="pure-menu-heading">Menu</span>  
            <ul class="pure-menu-list">
                <?php if($user->hasPermission(4) || $user->hasPermission(5)){ ?>
                  <li class="pure-menu-item"><a href="./material_management.php" class="pure-menu-link"> Material Mangement </a></li>
                  <li class="pure-menu-item"><a href="./storage_management.php" class="pure-menu-link"> Storage Location </a></li>
                  <li class="pure-menu-item"><a href="./customer_management.php" class="pure-menu-link"> Customer Management </a></li>
                  <li class="pure-menu-item"><a href="./shipper_management.php"  class="pure-menu-link"> Shipper Management </a></li>
                  <li class="pure-menu-item"><a href="./user_management.php"  class="pure-menu-link"> User Management </a></li>
                <?php }
                if($user->hasPermission(3) || $user->hasPermission(5) || $user->hasPermission(2) || $user->hasPermission(1)){?>
                   <li class="pure-menu-item"><a href="#" class="pure-menu-link"> Reports </a></li> 
                <?php }
                if($user->hasPermission(3) || $user->hasPermission(1) || $user->hasPermission(5)){ ?>
                  <li class="pure-menu-item"><a href="#" class="pure-menu-link"> Purchase Orders </a></li>
                  <li class="pure-menu-item"><a href="#" class="pure-menu-link"> Invoices </a></li>
                <?php }
                if($user->hasPermission(2) || $user->hasPermission(5)){ ?>
                  <li class="pure-menu-item"><a href="./so_management.php" class="pure-menu-link"> Sales Orders </a></li>
                <?php }
                if($user->hasPermission(3) || $user->hasPermission(1) || $user->hasPermission(5)) { ?>
                  <li class="pure-menu-item"><a href="./shipment_management.php" class="pure-menu-link"> Shipment </a></li>  
                <?php } ?>                               
            </ul>
</div>        
<?php
}
else{ 
    echo '<h2>Welcome</h2>';    
    echo '<p> Please login <a href="login.php" target="_parent">here</a>!</a></p>';
}
?>

<!--<iframe src="./user_management.php"></iframe>-->

</body>
</html>