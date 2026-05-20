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

$appId = $_GET['id'];
$applicationModel = new src\Application($request, $db);
$appData = $applicationModel->findOneByColumn('id', $appId);

$applications = [$appData];