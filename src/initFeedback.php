<?php 

use src\Feedback;
use src\services\Request;
use src\services\Db;

require 'init.php';

$page = 'feedback.php';

$feedback = new Feedback($request, $db);


if($request->isPost){
    $feedback->loadFromForm($request->post(), $_FILES['image_file']);
    try{
        $feedback->validate();
        $feedback->save();
        header("Location: feedback.php?review_ok=1");
        exit();
    }catch(\src\exceptions\InvalidArgumentException $e){
        $error = $e->getMessage();
    }
}
$feedbacks = $feedback->findAll();




?>