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
    <meta charset="utf-8">
     <title>対面の館</title>
     <link rel="stylesheet" href="nologin.css">
    </head>
    <body>
        <header>
            <div class="header"></div>
        </header>
        
       <div id="menubar">   
        <div class="box1" id="box"><a href="../taimen.php">対面モード</a></div>
        <div class="box2" id="box"><a href="Winst.php">Win Streak</a></div>
        <div class="box3" id="box"><a href="senseki.php">戦績管理</a></div>
        </div>
    </body>
</html>