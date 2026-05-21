<?php

use src\User;
use src\services\Request;
use src\services\Db;
use src\Application;
use src\exceptions\InvalidArgumentException;

require_once __DIR__ . '/init.php';

$page = 'change-password.php';

if ($user->isGuest()) {
    header('Location: index.php');
    exit();
}

if ($request->isPost) {
    try {
        $postData = $request->post();
        
        $old = $postData['oldPassword'];
        $new = $postData['newPassword'];
        $repeat = $postData['repeatPassword'];

        $user->validateChangePassword($old, $new, $repeat);

        $user->update(['password' => $new]);
        $user->load(['password' => $new]);
        
        $success = 'Вы поменяли пароль';

    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}

?>