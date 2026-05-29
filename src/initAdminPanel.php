<?php

use src\User;
use src\services\Request;
use src\services\Db;
use src\Application;

require 'init.php';

$page = 'admin-panel.php';

if ($user->isGuest()) {
    header('Location: login.php');
    exit();
}

if (!$user->isAdmin()) {
    header('Location: login.php');
    exit();
}

$applicationModel = new Application($request, $db);

if (isset($_GET['id']) && isset($_GET['status'])) {
    $appId = (int)$_GET['id'];
    $statusParam = trim($_GET['status']);
    
    if ($appId > 0) {
        $newStatus = null;

        if ($statusParam === 'submit') {
            $newStatus = 'timereserv';
        } elseif ($statusParam === 'complete') {
            $newStatus = 'provideo';
        }


        if ($newStatus !== null) {
            $applicationModel->id = $appId;

            $fields = [
                'status' => $newStatus
            ];
            $applicationModel->update($fields);
            
            header("Location: admin-panel.php?success_id={$appId}&success_status={$newStatus}");
            exit();
        }
    }
}

$searchStatus = $_GET['ApplicationSearch']['status_id'] ?? '';
$showAllDays = isset($_GET['ApplicationSearch']['all_days']);

$allApps = array_reverse($applicationModel->findAll());

$userApplications = array_filter($allApps, function($app) use ($searchStatus, $showAllDays) {
    $isToday = $showAllDays || date('Y-m-d') === substr($app['create_at'], 0, 10);
    $matchesStatus = empty($searchStatus) || $app['status'] === $searchStatus;

    return $isToday && $matchesStatus;
});