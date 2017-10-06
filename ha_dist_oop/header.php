<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
    <p>Hello <?php echo escape($user->data()->first_name)." ".escape($user->data()->last_name); ?>
    <a href="profile.php?user=<?php echo escape($user->data()->username);?>">( <?php echo escape($user->data()->username); ?> )</a></p>

    <!--<input type="button" value="Back" onClick="history.back()" />-->
    <a href="./home.php" target="_parent"><button type="button" value="Return">Main page</button></a>
    <a href="logout.php" target="_parent"><button type="button">Logout</button></a>

</body>
</html>
