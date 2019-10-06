<?php
 session_start();
 require('dbconnect.php');
 //include('taimen.php');

 $uri = ".jpg";
 $watashi = $_POST['prefecture'];
 $anata = $_POST['enemy'];
 $urii = "img/".$watashi.$uri;
 $urf = "img/".$anata.$uri;
 

  //未ログインユーザーへのログインＰ遷移処理
  if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
     $_SESSION['time'] = time();
     
     $members = $db->prepare('SELECT * FROM lolmembers WHERE id=?');
     $members->execute(array($_SESSION['id']));
     $member = $members->fetch();
 } else {
     header('Location: ../lolol/join/nologin.php');
     exit();
 }
  //チャンピオンを選択完了していない場合
 /*if(!isset($_SESSION{'use'}) && !isset($_SESSION['plz'])) {
     header('Location: taimen.php');
     exit();
 } */



if (!empty($_POST['sendch'])) {
     
    //$mecham = $_POST['uscham'];
    //$urcham = $_POST['enecham'];
     
     if ($_POST['prefecture'] !== "" && $_POST['enemy'] !== "") { //エラーがなければ選択した対面希望チャンプと自使用チャンプをＤＢにインサート(一時的)
          $statement = $db->prepare('INSERT INTO lol_posts SET name=?, uscham=?, enecham=?, created=NOW()');
       $statement->execute(array(
       $_SESSION['name'], 
       $_POST['prefecture'],
       $_POST['enemy']
         ));
         $enemy = $statement->fetch();//$enemyに対して['uscham']の記述で指定することができる
         
         //$_SESSION['use'] = $_POST['prefecuture'];
         //$_SESSION['plz'] = $_POST['enemy'];
         
         //setcookie('uscham', $_POST['prefecture'], time()+60*60*24*14);
         //setcookie('enecham', $_POST['enemy'], time()+60*60*24*14);    
        
     }
     $stt = $db->prepare('SELECT name FROM lol_posts WHERE ? = enecham LIMIT 1');
         $stt->execute(array(
              $_POST['prefecture']
         ));
    $smt = $stt->fetch();
    $stmt = array_flip($smt);
 }

?>
<!DOCTYPE html>
 <html>
  <head>
      <meta charset="utf-8">
      <title>対面モード</title>
     <link rel="stylesheet" href="taimen.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
     </head>
     <body>
         
         <div>
           <p class="username">
           <?php print(htmlspecialchars($_SESSION['name'], ENT_QUOTES)); ?>
           </p>
         </div>
          
         <!--<img id="mainicon" src="img/".$_SESSION['use'].$uri width="120" height="120"> -->
         
         <?php echo "<img src=\"$urii\" width=\"120\" height=\"120\">";?>
        
         <div id="myselect">
            <form name="making" method="post" action="taimen.php">
               
            <?php echo "<img src=\"$urf\" width=\"120\" height=\"120\">";?>
                <?php if(!empty($stmt)): ?>
                <div id="player_name"><?php  echo implode("",(array_keys($stmt,0))) ?></div>
                
                <?php endif;?>
               
                    
             <div id="aitebutton"><input type="submit" name="xbtn" value="×">
              <p class="making">マッチ待機中</p>
                </div>
             </form>
         </div>
     </body>
</html>