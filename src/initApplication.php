<?php

use src\User;
use src\services\Request;
use src\services\Db;
use src\Application;

require 'init.php';

$page = 'application.php';

if ($user->isGuest()) {
    header('Location: index.php');
    exit();
}

$appId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$applicationModel = new src\Application($request, $db);
$appData = $applicationModel->findOneByColumn('id', $appId);

if (empty($appData)) {
    header('Location: 404.php');
    exit();
}

$applications = [$appData];