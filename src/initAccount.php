<?php

use src\User;
use src\services\Request;
use src\services\Db;
use src\Application;

require 'init.php';

$page = 'account.php';


if ($user->isGuest()) {
    header('Location: index.php');
    exit();
}

$applicationModel = new Application($request, $db);

$userApplications = $applicationModel->findByColumn('user_id', $user->id);

    
?>