<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HA Dist - Name Change</title>
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
            'first_name' => array(
                'first_name' => 'First Name',
                'required' => false,
                'min' => 2,
                'max' => 40
            ),
              'last_name' => array(
                'last_name' => 'Last Name',
                'required' => false,
                'min' => 2,
                'max' => 40
            ),  
        ));

        if($validate->passed()) {
            try {
                $user->update(array(
                    'first_name' => Input::get('first_name'),
                    'last_name' => Input::get('last_name')
                ));

                //Session::flash('home', 'Your details have been updated.');
                Redirect::to('profile.php?user='.escape($user->data()->username));

            } catch(Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach($validate->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}
?>

<?php include_once('header.php');?> 

<h2>Profile - Change name</h2>
<form action="" method="post" class="pure-form">
    <legend>Name</legend>        
        <input type="text" name="first_name" placeholder="<?php echo escape($user->data()->first_name); ?>">
        <input type="text" name="last_name" placeholder="<?php echo escape($user->data()->last_name); ?>">

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" value="Update" class="button-secondary pure-button">
    
</form>

</body>
</html>