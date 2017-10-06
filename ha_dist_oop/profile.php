<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HA Dist - Profile</title>
</head>
<body>

<?php
/**
 * Created by Chris on 9/29/2014 3:52 PM.
 */

require_once 'core/init.php';
//if user is not set
if(!$username = Input::get('user')) {
    Redirect::to('index.php');
} else {
    //instanitnate User class with user
    $user = new User($username);
    $db = DB::getInstance();

    if(!$user->exists()) {
        Redirect::to(404);
    } else {
        $data = $user->data();
?>
        <?php include_once('header.php');?> 
        <h3>Profile</h3>
        <p><b>User Name:</b> <?php echo escape($data->username); ?></p>
        <p><b>Name:</b> <?php echo escape($data->first_name)." ".escape($data->last_name); ?></p>
        <?php  
            $db->get('roles', array('role_id', '=', $data->role));
            $jobRole = $db->results();
        ?>
        <p><b>Job Role:</b> <?php echo $jobRole[0]->name;  ?></p>
        <ul>
            <li><a href="update.php">Update Name</a></li>
            <li><a href="changepassword.php">Change Password</a></li>            
        </ul> 

<?php    
    }
}?>
</body>
</html>