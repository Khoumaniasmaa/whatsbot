<?php

require_once 'question.php';


$message = trim(normalize($_GET['message']));
$tokens = explode(' ', $message);

$fallback_answer = [
    'occurs' => 0,
    'question' => [
        'id' => 0,
        'content' => $message,
        'answer' => "Je comprend pas, essayer de reformuler la question!",
        'related_to' => 0,
        'user_id' => 0
    ]
];
if($message == ""){
    echo json_encode($fallback_answer);
    exit;
}

$questions = $conn->query("SELECT * FROM questions")->fetch_all(MYSQLI_ASSOC);

// Attribute tags to questions
for($i=0;$i<count($questions);$i++){
    $tags = $conn->query("SELECT name FROM tags INNER JOIN questions_tags ON tags.id=questions_tags.tag_id
    WHERE question_id='{$questions[$i]['id']}'")->fetch_all(MYSQLI_ASSOC);
    $tg = [];
    foreach($tags as $tag) $tg[] = $tag['name'];
    $questions[$i]['tags'] = implode(',', $tg);
    // Bind related question
    if($questions[$i]['related_to'] > 0){
        $related = $conn->query("SELECT content, answer FROM questions WHERE id={$questions[$i]['related_to']}")->fetch_assoc();
        $questions[$i]['related_question'] = $related['content'];
        $questions[$i]['related_answer'] = $related['answer'];
    }
}

$resutls = [];
/// Filter level 1
foreach($questions as $question){
    $resutls[] = [
        'occurs' => mapOccurs($tokens, $question['tags']),
        'question' => $question
    ];
}

for($i=0;$i<count($resutls);$i++){
    $resutls[$i]['occurs'] += mapOccurs($tokens, normalize($resutls[$i]['question']['content']));
}

usort($resutls, 'compareOccurs');

if(isset($resutls[0])) $right_answer = $resutls[0];
else $right_answer = null;

if($right_answer != null){
    if($right_answer['occurs'] == 0) $right_answer = $fallback_answer;
}

echo json_encode($right_answer);
exit;