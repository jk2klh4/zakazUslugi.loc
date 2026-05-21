<?php
use src\Application;
use src\exceptions\InvalidArgumentException;

require_once __DIR__ . '/src/init.php';

if ($user->isGuest()) {
    header('Location: index.php');
    exit();
}

$appId = $_GET['id'];

if ($appId > 0) {
    $applicationModel = new Application($request, $db);
    
    $applicationModel->delete($appId);
}


header('Location: account.php');
exit();
?>