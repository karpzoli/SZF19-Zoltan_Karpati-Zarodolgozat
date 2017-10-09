<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css">  
    <link rel="stylesheet" href="./core/mainStyle.css">  
    <title>HA Dist - Logon</title>    
</head>
<body>

<?php
/**
 * Created by Chris on 9/29/2014 3:52 PM.
 */

require_once 'core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validate->passed()) {
            $user = new User();
            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if($login) {
                Redirect::to('home.php'); //index.php
            } else {
                echo '<p>Incorrect username or password</p>';
            }
        } else {
            foreach($validate->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}
?>

<div id="Logon_screen">
<form action="" method="post" class="pure-form pure-form-stacked"> 
    <fieldset> 
        <h3>HA Distribution</h3> 
        <label for='username'>Username</label>
            <input type="text" name="username" id="username">  
        <label for='password'>Password</label>
            <input type="password" name="password" id="password">
        <label for="remember">
            <input type="checkbox" name="remember" id="remember" class="pure-checkbox">Remember me
        </label>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Login" class="pure-button pure-button-primary">
   </fieldset>
</form>
</div>

</body>
</html>