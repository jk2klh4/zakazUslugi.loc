<?php

require 'config.php';
require 'autoload.php';

try{
    $request = new src\services\Request();
    $db = new src\services\Db($dbOptions);
} catch (src\Exceptions\DbException $e){
    echo $e->getMessage();
    exit();
}
?>