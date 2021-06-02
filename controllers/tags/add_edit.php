<?php

require_once 'tag.php';


$name = $_POST['name'];
$description = addslashes($_POST['description']);
$synonyms = implode(',', $_POST['synonyms']);
$level = $_POST['level'];

if(isset($_POST['doaddtag'])){
    $stmt = $conn->prepare('INSERT INTO tags (name, description, level, synonyms) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssis', $name, $description, $level, $synonyms);
    if($stmt->execute()){
        redirect('tags', ['added' => 1]);
    }else{
        redirect('tags', ['added' => 0]);
    }
}elseif(isset($_POST['doedittag'])){
    $id = $_POST['id'];
    $stmt = $conn->prepare('UPDATE tags SET name=?, description=?, level=?, synonyms=? WHERE id = ?');
    $stmt->bind_param('ssisi', $name, $description, $level, $synonyms, $id);
    $stmt->execute();
    redirect('tags');
}
exit;