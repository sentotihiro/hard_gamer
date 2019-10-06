<?php
 session_start();
 
if (isset($_SESSION['join'])) {
    header('Location: home.php');
    exit();
}

 ?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
     <title>対面の館</title>
     <link rel="stylesheet" href="nologin.css">
    </head>
    <body>
        <header>
            <div class="header">League Of Legend 対面の館</div>
        </header>
        
       <div id="menubar">   
        <div class="box1" id="box"><a href="index.php">新規登録はこちら</a></div>
        <div class="box2" id="box"><a href="explanation.php">対面の館とは？</a></div>
        <div class="box3" id="box"><a href="login.php">ログイン</a></div>
        </div>
    </body>
</html>