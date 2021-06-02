<?php

require_once 'tag.php';

if(isset($_GET['id'])){
    if(is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $res = $conn->query("DELETE FROM tags WHERE id = '$id'");
        if($res) redirect('tags', ['deleted' => 1]);
        else redirect('tags', ['deleted' => 0]);
    }
}
exit;