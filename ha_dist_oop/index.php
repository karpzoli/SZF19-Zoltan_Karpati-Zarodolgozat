<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HA Distribution</title>
</head>
<body>

<h2>LOGIN </h2>
      
<form method="POST">
<input type="text" name="user" placeholder="username" required>
<input type="password" name="pw" placeholder="password" required>
<button type="submit" name="loginButton">LOGIN</button>
</form>

<?php


//if($user->is_loggedin()) //$user->is_loggedin()!=""
//    {
//        $user->redirect('home.php');
//    }   


// LOGIN
if(isset($_POST['loginButton'])){ 
	require_once("./pages/connect.php"); 	   
	extract($_POST); 	print_r($_POST);					
	$uname=$user;
    $upass=$pw;var_dump($user);
        if($user->login($uname,$upass))
             {
                 $user->redirect('./pages/home.php');
             }
        else
            {
                $error = "Wrong Details !";
            } 
	}								

?>
</body>
</html>

