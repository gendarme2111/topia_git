<?php
session_start();
require_once("userlogic.php");
$_SESSION['csrf_token'] = setToken();
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>ラーメン店アンケート</title>
<link rel="stylesheet" type="text/css" href="./stylesheet.css">
</head>
<body>
	<article class ="survey">
		<form action="./check.php" method="post">
			<fieldset>
				<legend>ラーメン店アンケート</legend>
					<div class="wrapper">
						<p><span class="comment">※</span>は必須項目です</p>
						<p>氏名<span class="comment">※</span>
							<input type="text" name="my_name" size="18" maxlength="20" placeholder="全角20文字まで" required>
						</p>
						<p>性別
							<label><input type="radio" name="gender" value="男" checked>男性</label>
							<label><input type="radio" name="gender" value="女" >女性</label>
						</p>					
						<p>年齢
							<select name="age">
								<?php for($i=5;$i<=80;$i++): ?>
								<option value="<?php echo $i ?>"><?php echo $i ?></option>
								<?php endfor; ?>
							</select>歳
						</p>
						<p>郵便番号
							〒<input type="number" class="zip1" name="zip1" min="0" max="999" placeholder="3桁">
							-<input type="number" class="zip2" name="zip2" min="0" max="9999" placeholder="4桁">
						</p>
						<p>Eメールアドレス<span class="comment">※</span><br>
							<input type="email" name="email" size="42" maxlength="255" placeholder="半角で入力してください" required>
						</p>
						<p>一番好きなラーメン
							<select name="favorite">
								<?php $ramens =array("醤油ラーメン","塩ラーメン","豚骨ラーメン","味噌ラーメン","煮干しラーメン") ?>
								<?php foreach($ramens as $ramen): ?>
									<option value="<?php echo $ramen ?>"><?php echo $ramen ?></option>
								<?php endforeach; ?>
							</select>
						</p>
						<p>お好きなトッピング（複数選択可）<br>
							<?php $toppings = array("メンマ","チャーシュー","のり","煮卵");
							$i =0;?>
							<?php foreach($toppings as $topping): ?>
							<label><input type="checkbox" id="'topping_'.<?php echo $i ?>" name="topping[]" value="<?php echo $topping ?>" ><?php echo $topping ?></label>
							<?php endforeach; ?>
						</p>
						<p>ご意見・ご感想<br>
							<textarea name="impression" rows="5" cols="45" placeholder="ご自由にお書きください"></textarea>
						</p>
						<p>	
							<div class="btn">
								<input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
								<input type="submit" value="送信">
								<input type="reset" value="取消">
							</div>
						</p>
					</div>
			</fieldset>
		</form>
	</article>
</body>
</html>

