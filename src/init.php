<?php

require 'config.php';
require 'autoload.php';
session_start();
try{
    $request = new src\services\Request();
    $db = new src\services\Db($dbOptions);
    $user = new src\User($request, $db);
    } catch (src\Exceptions\DbException $e){
    echo $e->getMessage();
    exit();
}
?>