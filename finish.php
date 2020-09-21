<?php
session_start();
require_once("userlogic.php");

$message="";

//トークンがない、またはcheck.phpを経由していない場合、処理を中止
if(!isset($_SESSION['csrf_token_conf'])||$_SESSION['csrf_token_conf'] !== $_SESSION['csrf_token']){
    $_SESSION = array();
    session_destroy();
    exit('不正なリクエストです');
}
try {     
    //DB名、ユーザー名、パスワード
    $dsn = 'mysql:dbname=heroku_cf43bda6038c08b;host=us-cdbr-east-02.cleardb.com;charset=utf8';
    $user = 'bc6d1261e5b941';
    $password = 'faf22e0e';

    $PDO = new PDO($dsn, $user, $password); //MySQLのデータベースに接続
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDOのエラーレポートを表示
    
    //$_SESSIONの値を取得
    $name = $_SESSION['my_name'];
    $gender = $_SESSION['gender'];
    $age = $_SESSION['age'];
    $zip = $_SESSION['zip'];
    $email = $_SESSION['email'];
    $favorite = $_SESSION['favorite'];
    $toppings = $_SESSION['toppings'];
    $impression = $_SESSION['impression'];

    $sql = "INSERT INTO topia_ramen(name,gender,age,zip,email,favorite,toppings,impression)
    VALUES (:name, :gender,:age,:zip,:email,:favorite,:toppings,:impression)"; // INSERT文を変数に格納。:nameはプレースホルダという、値を入れるための単なる空箱
    $stmt = $PDO->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
    $params = array(':name' => $name,':gender' => $gender,':age' => $age,':zip' => $zip,':email'=>$email,
    ':favorite' => $favorite,':toppings' => $toppings,':impression' => $impression,); // 挿入する値を配列に格納する
    $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行

    $message ='ご投稿ありがとうございました'; // 登録完了のメッセージ

    $_SESSION = array();
    session_destroy();

} catch (PDOException $e) {
    $_SESSION = array();
    session_destroy();
  exit('データベースに接続できませんでした。' . $e->getMessage());
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿完了</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
    <article class ="survey">
        <fieldset style="height:500px;">
            <legend>投稿完了</legend>
                <div class="text-container">
                    <div class="text-wrapper">
                        <p><?php echo $message ?></p>
                    </div>
                </div>
        </fieldset>
    </article>
    <div class="btn">
         <input class="btn" type="submit" onclick="location.href='./index.php'" value="戻る">
    </div>
</body>
</html>
