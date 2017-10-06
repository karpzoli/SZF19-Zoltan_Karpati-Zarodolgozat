<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Shipment Management</title>      
</head>
<body>
<h1>Shipment Management</h1>

<?php 
if(@$_COOKIE['ha_dist_role']!=4) die("No authorization to this page"); 
if(!isset($_COOKIE['ha_dist_id'])) die("Error with user!"); 
require_once("./connect.php");
db_connect();
?>

<input type="button" value="Back" onClick="history.back()"/>
<button type="button" value="Return"><a href="/ha_dist/index.php">Main page</a></button>

<!-- Adding New shipper -->

<h3>Create new shimpent</h3>
<table width="50%" border="1">
<tr><td>Name</td><td>Country Code</td><td>ZIP Code</td><td>City</td><td>Adress</td><td>VAT Number</tr>
<form name="CreateNewShipper" method="POST">
<tr>
<td><input type="text" name="new_name" size="6" required></td>
<td><input type="text" name="new_CountryCode" size="10" required></td>
<td><input type="text" name="new_ZIP" size="10" required></td>
<td><input type="text" name="new_City" size="10" required></td>
<td><input type="text" name="new_Adress" size="10" required></td>
<td><input type="text" name="new_VAT" size="10" required></td>
<td><input type="submit" name="createNewShipperButton" value="Create"></td>
</tr>
</form> 

<?php 
if(isset($_POST['createNewShipperButton'])){	
    extract($_POST);  
 	$search="INSERT INTO shipping_company (name, country_code, ZIP, city, address, VAT_number) 
    VALUES ('$new_name', '$new_CountryCode','$new_ZIP', '$new_City','$new_Adress','$new_VAT')";
    mysql_query($search) or die(mysql_error());}
?>

<table width="50%" border="1">
<!--Table header -->
<tr><td>ID</td><td>Name</td><td>Country Code</td><td>ZIP Code</td><td>City</td><td>Adress</td><td>VAT Number</tr>
<form method="POST">
<tr>
<!-- Selector fields for filter-->
<?php $selected_name=""; $selected_cc=""; $selected_zip=""; $selected_city=""; $selected_address=""; $selected_vat="";?>
<td></td>
<td><input type="text" name="selected_name" size="6" value="<?php echo @$_POST['selected_name']; ?>"></td>
<td><input type="text" name="selected_cc" size="10" value="<?php echo @$_POST['selected_cc']; ?>"></td>
<td><input type="text" name="selected_zip" size="1" value="<?php echo @$_POST['selected_zip']; ?>"></td>
<td><input type="text" name="selected_city" size="1" value="<?php echo @$_POST['selected_city']; ?>"></td>
<td><input type="text" name="selected_address" size="1" value="<?php echo @$_POST['selected_address']; ?>"></td>
<td><input type="text" name="selected_vat" size="1" value="<?php echo @$_POST['selected_vat']; ?>"></td>
<td colspan="2"><input type="submit" value="Filter">
</form>
<!--Hits from the Database -->
<tr>
<?php
require_once("./connect.php");
db_connect();
extract($_POST);

//Delete Shipper
if(@$okButton=="Delete"){
	$search="DELETE FROM shipping_company WHERE shipper_id='$userid'";
	mysql_query($search) or die(mysql_error());}

//Change Shipper
if(@$okButton=="Change"){
//$search="UPDATE users SET role='$newRole' WHERE uid='$userid'";
//mysql_query($search) or die(mysql_error());
}


$filter="TRUE";
extract($_POST);
if ($selected_name!="") $filter.=" AND name LIKE '%$selected_name%'";
if ($selected_cc!="") $filter.=" AND country_code='$selected_cc'";
if ($selected_zip!="") $filter.=" AND ZIP='$selected_zip'";
if ($selected_city!="") $filter.=" AND city LIKE '%$selected_city%'";
if ($selected_address!="") $filter.=" AND address LIKE '%$selected_address%'";
if ($selected_vat!="") $filter.=" AND VAT_number LIKE '%$selected_vat%'";

$search="SELECT * FROM shipping_company WHERE $filter";
$result=mysql_query($search) or die(mysql_error());

//creating the list with users
echo "<h3>List of Shippers</h3>";
while($user=mysql_fetch_object($result)){
	echo "<tr><td>{$user->shipper_id}</td>";
	echo "<td>{$user->name}</td>";
	echo "<td>{$user->country_code}</td>";
    echo "<td>{$user->ZIP}</td>";
    echo "<td>{$user->city}</td>";  
    echo "<td>{$user->address}</td>";
    echo "<td>{$user->VAT_number}</td>";	
    echo "<form method=\"POST\">";
    echo '<input type="hidden" name="userid" value="'.$user->shipper_id.'">';
    echo '</td>';
	//Buttons at the end of each record
    echo '<td>';  	
    echo '<input type="submit" name="okButton" value="Change"/>';
    echo '<input type="submit" name="okButton" value="Delete" onClick="return confirm(\'Are you sure?\')">';
    echo '</td>';
	echo '</form>';
}

?>
</table>

</body>
</html>

