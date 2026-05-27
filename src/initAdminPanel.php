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

if (isset($_GET['id'])) {
    $appId = (int)$_GET['id'];
    
    if ($appId > 0) {
        $newStatus = null;

        if (isset($_GET['submit'])) {
            $newStatus = 'timereserv';
        } elseif (isset($_GET['complete'])) {
            $newStatus = 'provideo';
        }

        if ($newStatus !== null) {
            $sql = "UPDATE `application` SET `status` = '{$newStatus}' WHERE `id` = {$appId}";
            $db->querySql($sql);
            
            header("Location: admin-panel.php");
            exit();
        }
    }
}

$searchStatus = isset($_GET['status']) ? trim($_GET['status']) : '';
if (!empty($searchStatus)) {
    $userApplications = $applicationModel->findByColumn('status', $searchStatus);
} else {
    $userApplications = $applicationModel->findAll();
}

$userApplications = $applicationModel->findAll();


