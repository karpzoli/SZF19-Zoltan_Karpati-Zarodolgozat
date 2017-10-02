<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>

<?php

//log out the user 
if(isset($_POST['logoffButton'])){	
    $user->logout();   
    //require_once("./pages/connect.php");
       
    }


else{  // $status=1	,  one user found in Db - proper login
	$tempArray=mysql_fetch_array($userInfo); 			//get uid and psw into an array
	extract($tempArray);
    ?>		
    <h1>Welcome <?php echo $first_name." ". $last_name ?> ! </h1>
	<?php
	setcookie("ha_dist_id", $uid, time()+3600);			//(name,value,expire) 3600-1 hrs - stores user ID
	setcookie("ha_dist_role", $role, time()+3600);		//user role to define which menu to show
	
	// General menu
	echo '<h2>General menu</h2>';
	echo '<a href="./pages/profil.php"> Profile </a>'; //<a href="?oldal=profil.php"> Profile </a>';
	
	//Logistics Coordinator
	if($role==1 || $role==5){
		echo '<h2>Logistics Coordinator</h2>';
		echo '<a href="#"> PO </a><br />';	
		echo '<a href="#"> Invoices </a><br />';
		echo '<a href="#"> Reports </a>';			
	}	
	
	//Demand Planner
	if($role==2 || $role==5){
		echo '<h2>Demand Planner</h2>';
		echo '<a href="./pages/so_management.php"> SO </a><br />';		
		echo '<a href="#"> Reports </a>';		
	}
	
	//Production Planner
	if($role==3 || $role==5){
		echo '<h2>Production Planner</h2>';
		echo '<a href="./pages/shipment_management.php"> Shipment </a><br />';		
		echo '<a href="#"> Reports </a>';		
	}
	
	//Master Data Admin 
	if($role==4 || $role==5){
		echo '<h2>Master Data Admin </h2>';
		echo '<a href="./pages/material_management.php"> Material Mangement </a><br />';		
		echo '<a href="./pages/storage_management.php"> Storage Location </a><br />';		
		echo '<a href="./pages/customer_management.php"> Customer Management </a><br />';
		echo '<a href="./pages/shipper_management.php"> Shipper Management </a><br />';
		echo '<a href="./pages/user_management.php"> User Management </a>';
	}
	


    echo '<form class="mbr-form" method="POST">';
    echo '<span class="input-group-btn">';
    echo '<button type="submit" class="btn btn-primary btn-form display-4" name="logoffButton">LOGOUT</button>';
    echo '</span>';
    echo '</form>'; 

?>


</body>
</html>
