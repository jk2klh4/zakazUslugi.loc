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

$userApplications = $applicationModel->findAll() ?? [];


