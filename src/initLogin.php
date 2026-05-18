<?php 

require 'init.php';

if($request->isPost){
    $user->load($request->post());
    try{
        $user->validateLogin();
        $user->login();
        header("location: index.php");
    }catch(src\exceptions\invalidArgumentException $e){
        $error = $e->getMessage();
    }
}

?>