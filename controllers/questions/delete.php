<?php

require_once 'question.php';

if(isset($_GET['id'])){
    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $rs = $conn->query("DELETE FROM questions_tags WHERE question_id='$id'");
        $res = $conn->query("DELETE FROM questions WHERE id = '$id'");
        if($res) redirect('questions', ['deleted' => 1]);
        else redirect('questions', ['deleted' => 0]);
    }
}
exit;