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


