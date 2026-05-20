<?php

require 'config.php';
require 'autoload.php';
session_start();

try {
    $request = new src\services\Request();
    $db = new src\services\Db($dbOptions);
    $user = new src\User($request, $db);

    $existUser = $user->findOneByColumn('login', 'vrrkzumg'); 
    
    if ($existUser) {
        $user->load($existUser);
        
        $user->refreshAuthToken();
        $user->createTokenCookie();

    }

    $identity = $user->identity();
    if ($identity !== null) {
        $user->load($identity);
    }
    } catch (src\Exceptions\DbException $e) {
    echo $e->getMessage();
    exit();
}

// var_dump($user); 
// die;
?>
