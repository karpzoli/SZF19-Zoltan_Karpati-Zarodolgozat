<h2>Your Profile </h2>
<!--<pre>
<?php
print_r($_COOKIE);
?>
</pre>--> 
<!--Text in a <pre> element is displayed in a fixed-width font (usually Courier), and it preserves both spaces and line breaks.-->


<?php
if(!isset($_COOKIE['ha_dist_id'])) die("Error!");

require_once("./connect.php");
db_connect();
$uid=$_COOKIE['ha_dist_id'];
$searchInDb="SELECT * FROM users WHERE uid='$uid'";
$userInfo=mysql_query($searchInDb);
$uid=mysql_fetch_object($userInfo); 							//returns the current row of a result set, as an object

if(isset($_POST['saved'])){									//submit changes
	$hiba="";
	extract($_POST);	
	if($old_pw != $uid->password) $hiba="Incorrect current password!";	 //authenticating the change
	if($mod_pw1!=$mod_pw2) $hiba.="<br />New passwords must be identical!"; //comparing new passwords
	if($hiba!="") echo $hiba;
	else{	//no password change
		if($mod_pw1=="" && $mod_pw2=="") $newPsw=$uid->password;
		else $newPsw=$mod_pw1; 		
		$searchInDb="UPDATE users SET password='$newPsw' WHERE uid='$uid->uid'";
		mysql_query($searchInDb) or die(mysql_error());
		echo 'Modifications have been saved!';
	}
	echo '<br /><input type="button" value="Return" onClick="history.back()">';
	
} else{ //User form
echo '<form method="POST">';
echo '<table><tr><td>User name:';
echo '<td><input type="text" disabled value="';
echo $uid->uid;
echo '">';
echo '<tr><td colspan="2"><h3>Change password</h3>';
echo '<tr><td>New password: ';
echo '<td><input type="password" name="mod_pw1">';
echo '<tr><td>New password again: ';
echo '<td><input type="password" name="mod_pw2">';
echo '<tr><td>Current password:';
echo '<td><input type="password" name="old_pw">';
echo '<tr><td colspan="2">';
echo '<input type="submit" value="Save" name="saved">';
echo '</table></form>';
echo '<br /><input type="button" value="Return" onClick="history.back()">';
} 
?>

<!--  -> is used in object scope to access methods and properties of an object. It’s meaning is to say that what is on the right of the
 operator is a member of the object instantiated into the variable on the left side of the operator. Instantiated is the key term here.
 
 ?
 The href="../usermanagement/search_user.jsp?pagename=navigation" is a GET Method and will pass a key : pagename with value : navigation via URL.
Whereas href="../usermanagement/search_user.jsp? is a POST method and doesn't pass information about its variables via URL.
 
 -->