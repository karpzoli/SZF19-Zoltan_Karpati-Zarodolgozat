<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css">    
    <link rel="stylesheet" href="./core/mainStyle.css">
    <title></title>
</head>
<body>
 <?php $user = new User(); ?>

<!--    <h3>Hello <?php echo escape($user->data()->first_name)." ".escape($user->data()->last_name); ?> 
    <a href="profile.php?user=<?php echo escape($user->data()->username);?>">( <?php echo escape($user->data()->username); ?> )</a></h3>-->

    <div class="pure-menu pure-menu-horizontal">
    <ul class="pure-menu-list">
        <li class="pure-menu-item pure-menu-selected"><a href="profile.php?user=<?php echo escape($user->data()->username);?>" class="pure-menu-link"><h3>Hello <?php echo escape($user->data()->first_name)." ".escape($user->data()->last_name); ?> </h3></a></li>
        <li class="pure-menu-item pure-menu-has-children pure-menu-allow-hover">
            <a href="#" id="menuLink1" class="pure-menu-link"><?php echo escape($user->data()->username); ?></a>
            <ul class="pure-menu-children">
                <li class="pure-menu-item"><a href="update.php" class="pure-menu-link">Update Name</a></li>
                <li class="pure-menu-item"><a href="changepassword.php" class="pure-menu-link">Change Password</a></li>                
            </ul>
        </li>
    </ul>
</div>

    <!--<input type="button" value="Back" onClick="history.back()" />-->
    <a href="./home.php" target="_parent"><button type="button" value="Return" class="pure-button pure-button-primary">Main page</button></a>
    <a href="logout.php" target="_parent"><button type="button" class="pure-button pure-button-primary">Logout</button></a>

</body>
</html>
