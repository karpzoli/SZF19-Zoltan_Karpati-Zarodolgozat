<?php
/**
 * Created by Chris on 9/29/2014 3:58 PM.
 */

session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'ha_distribution' //test_logon
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 86400
    ),
    'sessions' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

//instead using of 'include' on the file of a particular instantinated class in every file, this makes them available 
spl_autoload_register(function($class) {
    require_once 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('sessions/session_name'))) {
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}

//User Role definitions used on pages
define("ROLE0", "Deactivated user");
define("ROLE1", "Logistics Coordinator");
define("ROLE2", "Demand Planner");
define("ROLE3", "Production Planner");
define("ROLE4", "Master Data Admin");
define("ROLE5", "System Admin");

?>