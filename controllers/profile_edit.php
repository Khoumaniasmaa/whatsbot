<?php


require_once 'controller.php';

if(isset($_POST['doeditprofile'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $password2 = md5($_POST['password2']);

    if($username != ""){
        $id = $_SESSION[APP_SESSION_ID];
        $num = (mysqli_num_rows($conn->query("SELECT * FROM users WHERE id='$id' AND password='$password'")));
        if($num <= 0){
            redirect('profile', ['down'=>1]);
            exit;
        }
        $stmt = $conn->prepare("UPDATE users SET username=?, password=? WHERE id=? AND password=?");
        $stmt->bind_param("ssis", $username, $password2, $id, $password);
        if($stmt->execute()){
            redirect('profile', ['edited' => 1]);
        }else redirect('profile', ['edited' => 0]);
    }
}
exit;
