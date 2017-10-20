<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HA Dist - Create User</title>    
</head>
<body>

<?php
/**
 * Created by Chris on 9/29/2014 3:53 PM.
 */

require_once 'core/init.php';
include_once('header.php');

if (Input::exists()) {
    
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'first_name' => array(
                'name' => 'First Name',
                'required' => true,
                'min' => 2,
                'max' => 40
            ),
             'last_name' => array(
                'name' => 'Last Name',
                'required' => true,
                'min' => 2,
                'max' => 40
            ),
            'username' => array(
                'name' => 'Username',
                'required' => true,
                'min' => 2,
                'max' => 8,
                'unique' => 'users'
            ),
            'password' => array(
                'name' => 'Password',
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
             'readWrite' => array(
                'name' => 'readWrite',
                'required' => true,                
            ),
               'role' => array(
                'name' => 'Role',
                'required' => true,                
            ),
        ));

        if ($validate->passed()) {
            $user = new User();
            $salt = Hash::salt(32);

            try {
                $user->create(array(
                    'first_name' => Input::get('first_name'),
                    'last_name' => Input::get('last_name'),
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'rw' => Input::get('readWrite'),
                    'role' => Input::get('role'),
                    'salt' => $salt,
                    'joined' => date('Y-m-d H:i:s'),                    
                ));  
                //TODO find out why the alert is skipped                             
                echo '<script>alert("User '.Input::get('username'). ' has been successfully created!")</script>'; 
                Redirect::to('user_management.php?user='.escape($user->data()->username));            
            } catch(Exception $e) {
                echo $error, '<br>';
            }
        } else {
            foreach ($validate->errors() as $error) {                
                }
                echo '<script>alert("'.$error.'")</script>';
            
        }        
    }
}
?>
<h2>Add New User</h2>
<form action="" method="post" class="pure-form pure-form-aligned">
   <fieldset>
    <div class="pure-control-group">
        <label for="first_name">First Name</label> <!--The for attribute specifies which form element a label is bound to.-->
        <input type="text" name="first_name" value="<?php echo escape(Input::get('first_name')); ?>" id="first_name">    
        <div class="field">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" value="<?php echo escape(Input::get('last_name')); ?>" id="last_name">
    </div>

    <div class="pure-control-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" maxlength="8" value="<?php echo escape(Input::get('username')); ?>">
    </div>

    <div class="pure-control-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="pure-control-group">
        <label for="password_again">Password Again</label>
        <input type="password" name="password_again" id="password_again" value="">
    </div>

    <div class="pure-control-group">
        <label for="readWrite">Access type</label>       
        <select name="readWrite" id="readWrite" value="<?php echo escape(Input::get('readWrite')); ?>">
             <option value="0">Please select one</option>
             <option value="1">Read Only</option>
             <option value="2">Read & Write</option>
        </select>
    </div>

      <div class="pure-control-group">
        <label for="role">User Role</label>       
        <select name="role" id="role" value="<?php echo escape(Input::get('role')); ?>">
            <option value="">Please select one</option>		
	        <option value="0"><?php echo ROLE0 ?></option>
        	<option value="1"><?php echo ROLE1 ?></option>
        	<option value="2"><?php echo ROLE2 ?></option>
        	<option value="3"><?php echo ROLE3 ?></option>
            <option value="4"><?php echo ROLE4 ?></option>
            <option value="5"><?php echo ROLE5 ?></option>
        </select>
     </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Register" class="pure-button pure-button-primary">
    </fieldset>
</form>

</body>
</html>