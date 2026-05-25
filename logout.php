<?php

require_once 'src/init.php';

$user->logout();

header('Location: index.php');
exit();
