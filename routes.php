<?php


function route($name, $params = []){
    // Build params
    $p = [];
    foreach($params as $k=>$v) $p[] = $k . "=" . $v;
    $p = implode('&', $p);
    if(strlen($p) > 0) $p = '?' . $p;
    // Roots
    $ctrl = 'controllers/';
    $tags = $ctrl.'tags/';
    $questions = $ctrl.'questions/';

    switch($name){
        /// Auth routes
        case 'login': return $ctrl.'login.php';
        case 'register': return $ctrl.'register.php';
        case 'logout': return $ctrl.'logout.php';
        case 'profile.edit': return $ctrl.'profile_edit.php';
        /// Tags Manager
        case 'tags.add_edit': return $tags.'add_edit.php';
        case 'tags.delete': return $tags.'delete.php'.$p;
        // Questions Manager
        case 'questions.add_edit': return $questions.'add_edit.php';
        case 'questions.delete': return $questions.'delete.php'.$p;
        /// Not found
        default: return '404';
    }
}