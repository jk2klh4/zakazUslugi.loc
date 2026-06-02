<?php

use src\Application;
use src\User;

require 'init.php';

$page = 'admin-app.php';

// Проверка прав доступа
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

if (isset($_GET['action']) && $_GET['action'] === 'submit' && $appId > 0) {
    $applicationModel->id = $appId;
    
    $applicationModel->update(['status' => 'timereserv']);
    
    header("Location: admin-app.php?id={$appId}&success_id={$appId}&success_status=timereserv");
    exit();
}

$currentApplication = $applicationModel->getById($appId);

if (empty($currentApplication)) {
    header('Location: 404.php');
    exit();
}

$applicantFio = (new src\User($request, $db))->getById($currentApplication['user_id'])['fio'];

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
        
        header("Location: admin-app.php?id={$appId}&success_id={$appId}&success_status=timechange");
        exit();

    } catch (\src\Exceptions\InvalidArgumentException $e) {
        $error = $e->getMessage();
    }
}
