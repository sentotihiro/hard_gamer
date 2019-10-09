<?php
 session_start();
 require('../dbconnect.php');

 if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
     $_SESSION['time'] = time();
     
     $members = $db->prepare('SELECT * FROM lolmembers WHERE id=?');
     $members->execute(array($_SESSION['id']));
     $member = $members->fetch();
 } else {
     header('Location: nologin.php');
     exit();
 }
 
 ?>
<!DOCTYPE html>
<html>
 <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" charset="utf-8">
     <title>対面の館</title>
     <link rel="stylesheet" href="nologin.css">
    </head>
    <body>
        <header>
            <div class="header"></div>
        </header>
        
       <div id="menubar">   
        <div class="box1" id="box"><a href="../taimen.php">対面モード</a></div>
        <div class="box2" id="box"><a href="../winst/Winst.php">Win Streak</a></div>
        <div class="box3" id="box"><a href="../join/logout.php">ログアウト</a></div>
        </div>
    </body>
</html>