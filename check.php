<?php
session_start();
require_once("userlogic.php");

$token = filter_input(INPUT_POST,'csrf_token');
//トークンがない、またはトークンが一致しない場合、処理を中止
if(!isset($_SESSION['csrf_token'])||$token !== $_SESSION['csrf_token']){
    exit('不正なリクエストです');
}
$_SESSION['csrf_token_conf']= $token;

$_SESSION['my_name'] = h($_POST['my_name']);
$_SESSION['gender'] = h($_POST['gender']);
$_SESSION['age'] = h($_POST['age']);
$_SESSION['zip'] = h($_POST['zip1'])."-".h($_POST['zip2']);
$_SESSION['email']= h($_POST['email']);
$_SESSION['favorite']= h($_POST['favorite']);

$toppings ="";
if(isset($_POST['topping'])){
	foreach($_POST['topping'] as $topping){
		$toppings = $toppings.h($topping).",";
	}
}else{
		$toppings = "選択なし";
}

$_SESSION['toppings']= $toppings;
$_SESSION['impression']= h($_POST['impression']);
$_SESSION['csrf_token_conf'] = $_SESSION['csrf_token'];
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<title>確認画面</title>
</head>
<body>
	<article class ="survey">
		<fieldset>
			<legend>入力確認</legend>
				<div class="wrapper">
					<p><?php echo h($_POST['my_name']) ?>様</p>
					<p>登録内容は下記でよろしいでしょうか？</p>
					<p>氏名:<span><?php echo h($_POST['my_name']) ?></span></p>
					<p>性別:<span><?php echo h($_POST['gender']) ?></span></p>
					<p>年齢:<span><?php echo h($_POST['age']) ?>歳</span></p>
					<p>郵便番号:<span>〒<?php echo h($_POST['zip1'])?>-<?php echo h($_POST['zip2'])?></span></p>
					<p>Eメールアドレス:<span><?php echo h($_POST['email']) ?></span></p>
					<p>一番好きなラーメン:<span><?php echo h($_POST['favorite']) ?></span></p>
					<p>お好きなトッピング（複数選択可)</p>
						<ul>
							<span>
								<?php if(isset($_POST['topping'])): ?>
								<?php foreach($_POST['topping'] as $topping): ?>
									<li><?php echo h($topping) ?></li>
								<?php endforeach; ?> 
								<?php else: ?>
								<li>選択なし</li>
								<?php endif; ?>
							</span> 
						</ul>
					<p>ご意見・ご感想</p>
						<p><span><?php echo h($_POST['impression']) ?></span></p>
					<p>
						<div class="btn">
							<input type="submit" value="確定" onclick="location.href='finish.php'">
							<input type="button" value="修正" onclick="history.back();">
						</div>
					</p>
				</div>
			</fieldset>
		</form>
	</article>
</body>
</html>

