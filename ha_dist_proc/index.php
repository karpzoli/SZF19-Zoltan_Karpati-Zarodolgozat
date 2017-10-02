<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HA Distribution</title>
</head>
<body>

<?php
$status=2; //set a non occurring value in the process

//log out the user 
if(isset($_POST['logoffButton'])){	
    setcookie("ha_dist_id", "", time()-3600);
    unset($_COOKIE['ha_dist_id']);
	
    setcookie("ha_dist_role", "", time()-3600);
    unset($_COOKIE['ha_dist_role']);

    require_once("./pages/connect.php");
    db_disconnect();
    }

//get user info of logged in user
if(isset($_COOKIE['ha_dist_id'])){
	$searchInDb="SELECT * FROM users WHERE uid='{$_COOKIE['ha_dist_id']}'";
	require_once("./pages/connect.php");
	db_connect();
	$userInfo=mysql_query($searchInDb);
	$status=mysql_num_rows($userInfo);
	}

// LOGIN
if(isset($_POST['loginButton'])){ 
	require_once("./pages/connect.php"); 			
	db_connect();
	extract($_POST); 						
	$searchInDb="SELECT * FROM users WHERE uid='$user' AND password='$pw'"; //AND role > 0 => deactivated user
	$userInfo=mysql_query($searchInDb) or die(mysql_error()); 
	$status=mysql_num_rows($userInfo); 				
	}								// status=0 => there's no such user in db
									// status=1 => logged in

if($status==0) echo '<script>alert("There is no such user in the Database!")</script>';

if($status!=1){	// != 1 doesn't rule out the option that it's a second try giving both the error and the login screen
    
echo "<h2>LOGIN </h2>";
      
echo '<form method="POST">';
echo '<input type="text" name="user" placeholder="username" required>';
echo '<input type="password" class="form-control"  name="pw" placeholder="password" required>';
echo '<button type="submit" name="loginButton">LOGIN</button>';
echo '</form>';
} 
else{  // $status=1	,  one user found in Db - proper login
	$tempArray=mysql_fetch_array($userInfo); 			//get uid and psw into an array
	extract($tempArray);
    ?>		
    <h1>Welcome <?php echo $first_name." ". $last_name ?> ! </h1>
	<?php
	setcookie("ha_dist_id", $uid, time()+3600);			
	setcookie("ha_dist_role", $role, time()+3600);		
	
	// General menu
	echo '<h2>General menu</h2>';
	echo '<a href="./pages/profil.php"> Profile </a>'; 
	
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
	
	$lastlogin=date("Y.m.d", time());
	$searchInDb="UPDATE users SET last_login='$lastlogin' WHERE uid='$uid'";
	mysql_query($searchInDb) or die(mysql_error());

    echo '<form  method="POST">';
    echo '<button type="submit" class="btn btn-primary btn-form display-4" name="logoffButton">LOGOUT</button>';
    echo '</form>';    
}
?>
</body>
</html>

