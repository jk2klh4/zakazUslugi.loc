<?php

use src\User;
use src\exceptions\invalidArgumentException;

require_once 'init.php';

$page = 'register.php';
$error = null;
$successMessage = null;

if (!$user->isAdmin()) {
    header('Location: index.php');
    exit();
}

$newUser = new User($request, $db);

if ($request->isPost) {
    $newUser->load($request->post());
    try {
        $newUser->validate();
        
        if ($newUser->save()) {
            $successMessage = "Регистрация успешно пройдена";
        }
        
    } catch (invalidArgumentException $e) {
        $error = $e->getMessage();
    }
}
