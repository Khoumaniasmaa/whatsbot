<?php

require_once 'controller.php';

if(isset($_POST['doregister'])){
    $name = format_username($_POST['username']);
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $name, $email, $password);
    $res = $stmt->execute();
    if($res){
        $_SESSION[APP_SESSION_ID] = $conn->insert_id;
        redirect('index');
    }else{
        redirect('register', [ 'created'=>0 ]);
    }
}

function format_username($name){
    $name = str_replace(' ', '_', $name);
    $name = strtolower($name);
    return $name;
}