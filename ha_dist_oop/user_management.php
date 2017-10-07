<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>User Management</title>    
</head>
<body>

<?php 
require_once 'core/init.php';
?>

<!-- Adding New user -->
<?php include_once('header.php');?> 

<h2>User Management</h2>

<a href="register.php" target="_parent"><button type="button">Create New User</button></a>






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


</body>
</html>

