<?php

use src\Application;
use src\exceptions\InvalidArgumentException;

require_once __DIR__ . '/init.php';

$page = 'add-application.php';

if ($user->isGuest()) {
    header('Location: index.php');
    exit();
}

$error = null;
$appModel = new Application($request, $db);

if ($request->isPost) {
    try {
        $appModel->load($request->post() + ['user_id' => $user->id]);

        $appModel->validate();
        $success = 'Вы создали заявку';

        if ($appModel->saveApplication()) {
            header('Location: account.php');
            exit();
        }

    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}

?>
