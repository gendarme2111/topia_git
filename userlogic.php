<?php
//XSS対策:エスケープ処理
function h($str){
    return htmlspecialchars($str, ENT_QUOTES , 'UTF-8');
}

//CSRF対策://トークン(ワンタイムID)を生成
function setToken(){
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
return $csrf_token;
}
