<?php 

use src\Entity;
use src\services\Request;
use src\services\Db;
use src\Application;


require_once __DIR__ . '/init.php';
$page = 'index.php';

$feedbackEntity = new src\Feedback($request, $db);
$reviews = $feedbackEntity->findAll();