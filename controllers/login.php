<?php
require_once 'controller.php';

if(isset($_POST['dologin'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare('SELECT * FROM users WHERE email=? AND password=?');
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();
    if($res->num_rows > 0){
        $_SESSION[APP_SESSION_ID] = $user['id'];
        redirect('index');
    }else{
        redirect('login', [ 'logged'=>'false' ]);
    }
}