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

    if(!$user->exists()) {
        Redirect::to(404);
    } else {
        $data = $user->data();

  include_once('header.php');
                       
  $jobRole = $user->GetRole($data->role); 
  ?>
          <h3>Profile</h3>        

        <form class="pure-form pure-form-aligned">
    <fieldset>
        <div class="pure-control-group">
            <label for="User Name">Username</label>
            <input id="User Name" type="text" value="<?php echo escape($data->username) ?>"readonly>           
        </div>
        <div class="pure-control-group">
            <label for="Name">Name</label>
            <input id="Name" type="text" value="<?php echo escape($data->first_name)." ".escape($data->last_name) ?>" readonly>
        </div>
       <div class="pure-control-group">
            <label for="Job Role">Job Role</label>
            <input id="Job Role" type="text" value="<?php echo $jobRole[0]->name  ?>" readonly>
        </div>       
    </fieldset>
</form>

<?php    
    }
}?>
</body>
</html>