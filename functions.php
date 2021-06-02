<?php

function abort($code = 1000){
    if($code == 1000) header('location: ' . APP_PATH);
    header('location: '.$code.'.php');
    exit;
}

function redirect($view, $params = []){
    global $context_path;
    $p = [];
    foreach($params as $k=>$v) $p[] = $k . "=" . $v;
    $p = implode('&', $p);
    if(strlen($p) > 0) $p = '?' . $p;
    if(file_exists($context_path.$view.'.php'))
        header('location: '.$context_path.$view.'.php'.$p);
    else abort(404);
}

function dd($data){
    var_dump($data);
    die;
}

function logout(){
    if(isset($_SESSION[APP_SESSION_ID])){
        session_unset(APP_SESSION_ID);
        unset($_SESSION[APP_SESSION_ID]);
        session_destroy();
    }
}

function contains($string, $keyword){
    return preg_match("/\b$keyword\b/", $string);
}

function compareOccurs($a, $b){
    return strcmp($a['occurs'], $b['occurs']) * -1;
}

function mapOccurs($tokens, $string){
    $nb = 0;
    foreach($tokens as $token){
        if($string == "") continue;
        if(contains($string, $token)) $nb++;
    }
    return $nb;
}

function normalize($str){
    global $conn;
    $str = str_replace('\'', ' ', $str);
    $avoid = ['?', '!', '<', '>', '=', ':', ',', ';', '.', '"', '`', '&', '/', '\\', '*', '-', '+', '~', '%', '^', '¨'];
    $tags = $conn->query("SELECT * FROM tags WHERE synonyms IS NOT NULL")->fetch_all(MYSQLI_ASSOC);
    $synonyms = [];
    foreach($tags as $tag){
        $synonyms[$tag['name']] = explode(',', $tag['synonyms']);
    }   

    // reforme sysnonyms
    foreach($synonyms as $origin=>$syn){
        foreach($syn as $s){
            if(contains($str, $s)){
                $str = str_replace($s, $origin, $str);
            }
        }
    }

    foreach($avoid as $a){
        $str = str_replace($a, '', $str);
    }

    // replace french characters
    $replacers = [
        'e' => ['é', 'è', 'ê', 'ë'],
        'a' => ['à', 'â', 'ä', 'à'],
        'i' => ['ï', 'î', 'ì'],
        'o' => ['ö', 'ô', 'ò'],
        'u' => ['û', 'ü', 'ù']
    ];
    foreach($replacers as $origin=>$reps){
        foreach($reps as $rep){
            if(contains($str, $rep)){
                $str = str_replace($rep, $origin, $str);
            }
        }
    }

    return dedup($str);
}

function dedup($str){
    for($i=0;$i<strlen($str)-1;$i++){
        if($str[$i] == $str[$i+1]) $str[$i] = "*";
    }
    return str_replace('*', '', $str);
}