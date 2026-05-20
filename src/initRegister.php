<?php


use src\User;
use src\services\Request;
use src\services\Db;

require 'init.php';

$page = 'register.php';


if($user->isGuest || !$user->isAdmin){
    header('Location: /zakazUslugi.loc/login.php');
}

$newUser = new User($request, $db);

if($request->isPost){
    $newUser->load($request->post());
    try{
        $newUser->validate();
        
        if ($newUser->save()) {
            $successMessage = "Регистрация пройдена";
            $newUser = new User($request, $db);
        } else {
            $error = "Регистрация не пройдена";
        }
        
    }catch(src\exceptions\invalidArgumentException $e){
        $error = $e->getMessage();
    }
}

?>