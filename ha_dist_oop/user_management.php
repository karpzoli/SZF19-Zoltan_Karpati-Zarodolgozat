<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>User Management</title>    
</head>
<body>

<?php 
require_once 'core/init.php';
include_once('header.php');
$db = DB::getInstance();

if (Input::exists()) {    
    $button=Input::get('okButton');
    $toBeModified=Input::get('id');
    if ($button=='Delete')
    {        
    	$db->delete('users', array('id', '=', $toBeModified));
    }       
    if ($button=='Change')
    {
        $role = array('role' => Input::get('newRole'));
        //print_r($role);
        $db->update('users', $toBeModified, $role);                
    }    
}
?> 

<h2>User Management</h2>
<!-- Adding New user -->
<a href="register.php" target="_parent"><button type="button" class="pure-button pure-button-primary">Create New User</button></a>

<table width="98%" class="pure-table">
<thead><tr><td>User ID</td><td>Name</td><td>R/W</td><td>Role</td><td>Created</td><td>Last Login</td><td>Change Role To</td><td>Action</td></tr></thead>
<tr>
<?php
$db->get('users', array('username', 'LIKE', '%'));
$users = $db->results();
echo "<h3>List of Users</h3>";
foreach ($users as $user)
{
	echo "<tr><td>{$user->username}</td>";
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
    echo "<td>{$user->joined}</td>";
    echo "<td>{$user->last_login}</td>";
    echo "<form action=\"\" method=\"POST\">";
    echo '<input type="hidden" name="id" value="'.$user->id.'">';
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
    if ($user->id != $_SESSION['user'])
    {
        echo '<input type="submit" name="okButton" value="Change" class="button-secondary pure-button"/>';
    	echo '<input type="submit" name="okButton" value="Delete" class="button-error pure-button" onClick="return confirm(\'Are you sure you want to delete user: '.$user->username.'?\')">';
    }
    else {            
        echo '<input type="submit" name="okButton" value="Change" class="button-secondary pure-button" disabled/>';
        echo '<input type="submit" name="okButton" value="Delete" class="button-error pure-button" disabled/>';
    }
    echo '</td>';    
	echo '</form>';    
}

?>

</body>
</html>

