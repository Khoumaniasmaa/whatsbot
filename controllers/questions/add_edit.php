<?php

require_once 'question.php';


$question = $_POST['question'];
$answer = $_POST['answer'];
$user_id = $_SESSION[APP_SESSION_ID];
$tags = $_POST['tags'];
$related_to = $_POST['related_to'];

if(isset($_POST['doaddquestion'])){
    $stmt = $conn->prepare('INSERT INTO questions (content, answer, user_id, related_to) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssii', $question, $answer, $user_id, $related_to);
    if($stmt->execute()){
        $id = $conn->insert_id;
        $rs = $conn->query("DELETE FROM questions_tags WHERE question_id='$id'");
        // Insert Tags
        if(! empty($tags) && isset($tags)){
            foreach($tags as $tag_id){
                $rs = $conn->query("INSERT INTO questions_tags (question_id, tag_id) VALUES ('$id', '$tag_id')");
            }
        }
        redirect('questions', ['added' => 1]);
    }else{
        redirect('questions', ['added' => 0]);
    }
}elseif(isset($_POST['doeditquestion'])){
    $id = $_POST['id'];
    $rs = $conn->query("DELETE FROM questions_tags WHERE question_id='$id'");
    $stmt = $conn->prepare('UPDATE questions SET content=?, answer=?, related_to=? WHERE id = ?');
    $stmt->bind_param('ssii', $question, $answer, $related_to, $id);
    $stmt->execute();
    // Insert Tags
    if(! empty($tags) && isset($tags)){
        foreach($tags as $tag_id){
            $rs = $conn->query("INSERT INTO questions_tags (question_id, tag_id) VALUES ('$id', '$tag_id')");
        }
    }
    redirect('questions');
}

exit;