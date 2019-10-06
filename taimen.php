<?php
 session_start();
 require('dbconnect.php');

$_SESSION['use'] = $_POST['prefecuture'];
         $_SESSION['plz'] = $_POST['enemy'];
 


 

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
  //マッチング開始ボタンクリック時の処理
 
 
//xボタンクリック時
 if (!empty($_POST['xbtn'])) {
     $stmt = $db->prepare('DELETE FROM lol_posts WHERE name=? ');
     $stmt->execute(array($_SESSION['name']));
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
         
        
         <div class="username">
           <p>
           <?php print(htmlspecialchars($_SESSION['name'], ENT_QUOTES)); ?>
           </p>
         </div>
          
         <div><img id="mainicon" src="img/0.jpg" width="120" height="120"></div>
         
         
        
         <div id="myselect">
            <form id="make_play" name="making" method="post" action="taimen_taiki.php">
               
              <div id="watashi">
              <label id="mymessage" for="prefecture">あなたが使用するチャンピオンを選択してください</label>
               
                <select name="prefecture" id="prefecture" onchange="getSelected()">
                  <option value="0">アイバーン</option>
                  <option value="1">アカリ</option>
                  <option value="2">アジール</option>
                  <option value="3">アッシュ</option>
                  <option value="4">アニー</option>
                  <option value="5">アニビア</option>
                  <option value="6">アムム</option>
                  <option value="7">アリスター</option>
                  <option value="8">アーゴット</option>
                  <option value="9">アーリ</option>
                  <option value="10">イブリン</option>
                  <option value="11">イラオイ</option>
                  <option value="12">イレリア</option>
                  <option value="13">ウーコン</option>
                  <option value="14">ウディア</option>
                  <option value="15">エイトロックス</option>
                  <option value="16">エコー</option>
                  <option value="17">エズリアル</option>
                  <option value="18">エリス</option>
                  <option value="19">オーン</option>
                  <option value="20">オラフ</option>
                  <option value="21">オリアナ</option>
                  <option value="22">オレリオン・ソル</option>
                  <option value="23">カーサス</option>
                  <option value="24">カ＝ジックス</option>
                  <option value="25">カイサ</option>
                  <option value="26">カサディン</option>
                  <option value="27">カシオペア</option>
                  <option value="28">カタリナ</option>
                  <option value="29">カミール</option>
                  <option value="30">カリスタ</option>
                    
                </select>
                </div>
                    
                
                 <div id="eneimg"><img id="enecon" src="img/0.jpg" width="120" height="120"></div>
                
                
                                
                <div id="aite">
                <label id="enemessage" for="enemy">対面を希望するチャンピオンを選択してください</label>
                
                <select name="enemy" id="enemy" onchange="getSelectenemy()">
                  <option value="0">アイバーン</option>
                  <option value="1">アカリ</option>
                  <option value="2">アジール</option>
                  <option value="3">アッシュ</option>
                  <option value="4">アニー</option>
                  <option value="5">アニビア</option>
                  <option value="6">アムム</option>
                  <option value="7">アリスター</option>
                  <option value="8">アーゴット</option>
                  <option value="9">アーリ</option>
                  <option value="10">イブリン</option>
                  <option value="11">イラオイ</option>
                  <option value="12">イレリア</option>
                  <option value="13">ウーコン</option>
                  <option value="14">ウディア</option>
                  <option value="15">エイトロックス</option>
                  <option value="16">エコー</option>
                  <option value="17">エズリアル</option>
                  <option value="18">エリス</option>
                  <option value="19">オーン</option>
                  <option value="20">オラフ</option>
                  <option value="21">オリアナ</option>
                  <option value="22">オレリオン・ソル</option>
                  <option value="23">カーサス</option>
                  <option value="24">カ＝ジックス</option>
                  <option value="25">カイサ</option>
                  <option value="26">カサディン</option>
                  <option value="27">カシオペア</option>
                  <option value="28">カタリナ</option>
                  <option value="29">カミール</option>
                  <option value="30">カリスタ</option>
                    
                </select>
                </div>
                
             <input id="watabutton" type="submit" name="sendch" value="マッチング開始">             
             
             
             </form>
         </div>
         
        
         <script type="text/javascript">
             document.getElementById("aitebutton").style.visibility = "hidden";
             
              function clearButton() {
                  
                 const ff = document.getElementById("aitebutton");
                  
                  if (ff.style.visibility ="hidden") {
                    
                  document.getElementById("aitebutton").style.visibility = "visible";
                  document.getElementById("watabutton").style.visibility = "hidden";
                  document.getElementById("watashi").style.visibility = "hidden";
                  document.getElementById("aite").style.visibility = "hidden";
                  }else {
                 
                  document.getElementById("aitebutton").style.visibility = "hidden";
                  document.getElementById("watabutton").style.visibility = "visible";
                  document.getElementById("watashi").style.visibility = "visible";
                  document.getElementById("aite").style.visibility = "visible";
                 }
              }
                  
              function getSelected() {
                  var $elementReference = document.getElementById("prefecture");//selectタグを指定
                  var $selectedindex = $elementReference.selectedIndex;//selectタグprefectureの選択されたoptionタグを格納
                  var $value = $elementReference.options[$selectedindex].value;//selectタグのoptionタグを連想配列としindex番号を$selectedindexで指定,
                  　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　//valueで取得
                  
                  $icon = "../lolol/img/" + $value + ".jpg";
                  document.getElementById("mainicon").setAttribute("src", $icon); 
              }
             
             
             function getSelectenemy() {
                  var $elementReference = document.getElementById("enemy");//selectタグを指定
                  var $selectedindex = $elementReference.selectedIndex;//selectタグprefectureの選択されたoptionタグを格納
                  var $value = $elementReference.options[$selectedindex].value;//selectタグのoptionタグを連想配列としindex番号を$selectedindexで指定,
                  　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　//valueで取得
                  
                  $enecon = "../lolol/img/" + $value + ".jpg";
                  document.getElementById("enecon").setAttribute("src", $enecon); 
              }
             
            
          </script>
     </body>
</html>