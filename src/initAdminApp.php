<?php

use src\Application;

require 'init.php';

$page = 'admin-app.php';

if ($user->isGuest()) {
    header('Location: login.php');
    exit();
}

if (!$user->isAdmin()) {
    header('Location: login.php');
    exit();
}

$appId = isset($_GET['id']) ? (int)$_GET['id'] : 0;


$applicationModel = new Application($request, $db);

$currentApplication = $applicationModel->getById($appId);


if ($request->isPost) {
    try {
        $applicationModel->load($currentApplication);
        $applicationModel->id = $appId;

        $applicationModel->load([
            'date' => $request->post('date'),
            'time' => $request->post('time')
        ]);

        $applicationModel->validateAdminTime();

        $fields = [
            'date'   => $applicationModel->date,
            'time'   => $applicationModel->time,
            'status' => 'timechange'
        ];
        $applicationModel->update($fields);
        header("Location: admin-panel.php?success_id={$appId}&msg=");
        exit();

    } catch (\src\Exceptions\InvalidArgumentException $e) {
        $error = $e->getMessage();
}
}