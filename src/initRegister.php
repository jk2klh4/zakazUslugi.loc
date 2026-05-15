<?php


use src\User;
use src\services\Request;
use src\services\Db;

require 'init.php';

$user = new User($request, $db);

if($request->isPost){
    $user->load($request->post());
    try{
        $user->validate();
        
        if ($user->save()) {
            $successMessage = "Регистрация пройдена";
            $user = new User($request, $db);
        } else {
            $error = "Регистрация не пройдена";
        }
        
    }catch(src\exceptions\invalidArgumentException $e){
        $error = $e->getMessage();
    }
}

?>