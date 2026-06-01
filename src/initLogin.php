<?php 

require 'init.php';

$page = 'login.php';


if($request->isPost){
    $user->load($request->post());
    try{
        $user->validateLogin();
        $user->login();
        header("location: index.php");
    }catch(src\exceptions\InvalidArgumentException $e){
        $error = $e->getMessage();
    }
}

?>