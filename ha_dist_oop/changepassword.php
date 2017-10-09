<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HA Dist - Psw Change</title>
</head>
<body>
<?php
/**
 * Created by Chris on 9/29/2014 3:53 PM.
 */

require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'current_password' => array(
                'required' => true,
                'min' => 6
            ),
            'new_password' => array(
                'required' => true,
                'min' => 6
            ),
            'new_password_again' => array(
                'required' => true,
                'min' => 6,
                'matches' => 'new_password'
            )
        ));
    }

    if($validate->passed()) {
        if(Hash::make(Input::get('current_password'), $user->data()->salt) !== $user->data()->password) {
            echo 'Your current password is wrong.';
        } else {
            $salt = Hash::salt(32);
            $user->update(array(
                'password' => Hash::make(Input::get('new_password'), $salt),
                'salt' => $salt
            ));

            //Session::flash('home', 'Your password has been changed!');       
            Redirect::to('profile.php?user='.escape($user->data()->username));
        }
    } else {
        foreach($validate->errors() as $error) {
            echo $error, '<br>';
        }
    }
}
?>

<?php include_once('header.php');?> 

<h2>Profile - Change Password</h2>
<form action="" method="post" class="pure-form pure-form-aligned">
    <div class="pure-control-group">
        <label for="current_password">Current Password</label>
        <input type="password" name="current_password" id="current_password">
    </div>

    <div class="pure-control-group">
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="new_password">
    </div>

    <div class="pure-control-group">
        <label for="new_password_again">New Password Again</label>
        <input type="password" name="new_password_again" id="new_password_again">
    </div>

    <input type="hidden" name="token" id="token" value="<?php echo escape(Token::generate()); ?>">
    <input type="submit" value="Change Password" class="button-secondary pure-button">
</form>

</body>
</html>