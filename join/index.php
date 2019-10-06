<?php
session_start();

if(!empty($_POST)) {

 if ($_POST['name'] === '') {
     $error['name'] = 'blank'; 
 }

if ($_POST['email'] === '') {
     $error['email'] = 'blank'; 
 }

if (strlen($_POST['password']) < 4) {
     $error['password'] = 'length'; 
 }


if ($_POST['password'] === '') {
     $error['password'] = 'blank'; 
 }
 
if(empty($error)) { //エラーがなければ 
    $_SESSION['join'] = $_POST;//同ページ上のPOST送信データをセッションに与える
    header('Location: check.php'); //確認ページに飛ぶ
    exit;
}

}


if ( $_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])) {
    $_POST = $_SESSION['join'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>新規登録</title>

	<link rel="stylesheet" href="style.css" />
</head>
<body>
<div id="wrap">
<div id="head">
<h1>新規登録</h1>
</div>

<div id="content">
<p>次のフォームに必要事項をご記入ください。</p>
<form action="" method="post" enctype="multipart/form-data">
	<dl>
		<dt>名前<span class="required">必須</span></dt>
		<dd>
        	<input type="text" name="name" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>" />
            <?php if ($error['name'] === 'blank'): ?>
            <p class="error">* 名前を入力してください</p>
            <?php endif; ?>
            </dd>
		<dt>メールアドレス<span class="required">必須</span></dt>
		<dd>
        	<input type="text" name="email" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>" />
            <?php if ($error['email'] === 'blank'): ?>
            <p class="error">* メールアドレスを入力してください</p>
            <?php endif; ?>
		<dt>パスワード<span class="required">必須</span></dt>
		<dd>
        	<input type="password" name="password" size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>"/>
            
             <?php if ($error['password'] === 'length'): ?>
          <p class="error">* パスワードは4文字以上で入力してください</p>
            <?php endif; ?>
            
            <?php if ($error['password'] === 'blank'): ?>
          <p class="error">* パスワードを入力してください</p>
            <?php endif; ?>
        </dd>
		
	</dl>
	<div><input type="submit" value="入力内容を確認する" /></div>
</form>
</div>
    </div>
</body>
</html>
