<?php
require 'init.php';

use src\User;
use src\services\Request;
use src\services\Db;

if(isset($_GET['action']) && $_GET['action'] === 'logout'){
    if($user->logout()){{
        $_SESSION['flash'] = 'Вы вышли из системы';
    }
    header('Location: http://localhost/zakazUslugi.loc/index.php');
    exit();
    
}
}
header('Location: index.php');
exit();
