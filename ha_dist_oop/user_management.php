<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>User Management</title>    
</head>
<body>
<h1>User Management</h1>

<?php 
if(@$_COOKIE['ha_dist_role']!=4) die("No authorization to this page"); 
if(!isset($_COOKIE['ha_dist_id'])) die("Error with user!"); 
require_once("./connect.php");
db_connect();

//get role names from Db for the forms
define("ROLE0", "Deactivated user");
define("ROLE1", "Logistics Coordinator");
define("ROLE2", "Demand Planner");
define("ROLE3", "Production Planner");
define("ROLE4", "Master Data Admin");
define("ROLE5", "System Admin");
?>

<input type="button" value="Back" onClick="history.back()"/>
<button type="button" value="Return"><a href="/ha_dist/index.php">Main page</a></button>

<!-- Adding New user -->
<div name="NewUserForm">
<h3>Add New User</h3>
<table width="50%" border="1">
<tr><td>ID</td><td>First Name</td><td>Last Name</td><td>Access</td><td>Role</td><td>Password</tr>
<form name="CreateNewUser" method="POST">
<tr>
<td><input type="text" name="new_id" size="6" onInput="UserNameCheck()" required></td>
<td><input type="text" name="new_first_name" size="10" required></td>
<td><input type="text" name="new_last_name" size="10" required></td>
<td><select name="new_rw" size="1" value="0">
    <option value="0">Read Only</option>
    <option value="1">Read & Write</option>
</select></td>
<td><select name="new_role">		
	<option value="0"><?php echo ROLE0 ?></option>
	<option value="1"><?php echo ROLE1 ?></option>
	<option value="2"><?php echo ROLE2 ?></option>
	<option value="3"><?php echo ROLE3 ?></option>
    <option value="4"><?php echo ROLE4 ?></option>
    <option value="5"><?php echo ROLE5 ?></option>
</select></td>
<td><input type="text" name="new_psw" size="10"></td>
<td><input type="submit" name="createNewUserButton" value="Create"></td>
</form> 

</div>
<?php 
if(isset($_POST['createNewUserButton'])){	
    extract($_POST);  
 	$search="INSERT INTO users (uid, first_name, last_name, role, rw, password) 
    VALUES ('$new_id', '$new_first_name','$new_last_name', '$new_role','$new_rw','$new_psw')";
    mysql_query($search) or die(mysql_error());}
?>

<table width="50%" border="1">
<!--Table header -->
<tr><td>ID</td><td>Name</td><td>R/W</td><td>Role</td><td>Change Role To</tr>
<form method="POST">
<tr>
<!-- Selector fields for filter-->
<?php $selected_id=""; $selected_name=""; $selected_rw=""; $selected_role="";?>
<td><input type="text" name="selected_id" size="6" value="<?php echo @$_POST['selected_id']; ?>"></td>
<td><input type="text" name="selected_name" size="10" value="<?php echo @$_POST['selected_name']; ?>"></td>
<td><input type="text" name="selected_rw" size="1" value="<?php echo @$_POST['selected_rw']; ?>"></td>
<td><select name="selected_role">
	<?php echo strlen($_POST['selected_role'])."<br>"; ?> <!--strlen Return the length of the string-->
	<option value="" >Everyone</option>
	<option value="0"><?php echo ROLE0 ?></option>
	<option value="1"><?php echo ROLE1 ?></option>
	<option value="2"><?php echo ROLE2 ?></option>
	<option value="3"><?php echo ROLE3 ?></option>
	<option value="4"><?php echo ROLE4 ?></option>
	<option value="5"><?php echo ROLE5 ?></option>
</select></td>
<td></td>
<td><input type="submit" value="Filter">
<input type="submit" value="Clear" onClick="FormClear()"></td>
</form>
<!--Hits from the Database -->
<tr>
<?php
require_once("./connect.php");
db_connect();
extract($_POST);

//++++++CHANGE USER+++++++++
if(@$okButton=="Change"){
$search="UPDATE users SET role='$newRole' WHERE uid='$userid'";
mysql_query($search) or die(mysql_error());}

if(@$okButton=="Delete"){
	$search="DELETE FROM users WHERE uid='$userid'";
	mysql_query($search) or die(mysql_error());}
//++++++++++++++++++

$filter="TRUE";
extract($_POST);
if ($selected_id!="") $filter.=" AND uid LIKE '%$selected_id%'";
if ($selected_name!="") $filter.=" AND first_name LIKE '%$selected_name%' OR last_name LIKE '%$selected_name%'";
if ($selected_rw!="") $filter.=" AND rw='$selected_rw'";
if ($selected_role!="") $filter.=" AND role='$selected_role'";
echo "<div id=\"GetUsersFromDb\">";
$search="SELECT * FROM users WHERE $filter";
$result=mysql_query($search) or die(mysql_error());
echo "</div>";
//creating the list with users
echo "<h3>List of Users</h3>";
while($user=mysql_fetch_object($result)){
	echo "<tr><td>{$user->uid}</td>";
	echo "<td>{$user->last_name} {$user->first_name}</td>";
	echo "<td>{$user->rw}</td>";
    switch ($user->role)
    {    
        case '0':{echo "<td>"; echo ROLE0; echo "</td>";break;}
        case '1':{echo "<td>"; echo ROLE1; echo "</td>";break;}
        case '2':{echo "<td>"; echo ROLE2; echo "</td>";break;}
        case '3':{echo "<td>"; echo ROLE3; echo "</td>";break;}
        case '4':{echo "<td>"; echo ROLE4; echo "</td>";break;} 
	  case '5':{echo "<td>"; echo ROLE5; echo "</td>";break;} 	  
    }        
	
    echo "<form method=\"POST\">";
    echo '<input type="hidden" name="userid" value="'.$user->uid.'">';
    echo "<td><select name=\"newRole\">";	
    if($user->role!=0) {echo '<option value="0">'; echo ROLE0; echo "</option>"; }  
    if($user->role!=1) {echo '<option value="1">'; echo ROLE1; echo "</option>"; } 
    if($user->role!=2) {echo '<option value="2">'; echo ROLE2; echo "</option>"; } 
    if($user->role!=3) {echo '<option value="3">'; echo ROLE3; echo "</option>"; } 
    if($user->role!=4) {echo '<option value="4">'; echo ROLE4; echo "</option>"; } 
    if($user->role!=5) {echo '<option value="5">'; echo ROLE5; echo "</option>"; } 
    echo '</td>';
    echo '</select>';		
	//Buttons at the end of each record
     echo '<td>';  	
    if ($user->uid!=$_COOKIE['ha_dist_id'])
    {
        echo '<input type="submit" name="okButton" value="Change"/>';
    	echo '<input type="submit" name="okButton" value="Delete" onClick="return confirm(\'Are you sure?\')">';
    }else {            
        echo '<input type="submit" name="okButton" value="Change" disabled/>';
        echo '<input type="submit" name="okButton" value="Delete" disabled/>';}
    echo '</td>';
	echo '</form>';
}

?>
</table>

</body>
</html>

