<?php
   session_start();
   $_SESSION = array();

   session_destroy();
   print"ログアウトしました";
?>
<!DOCTYPE html>
<html lang="ja">
 <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" charset="utf-8">
     <title>ログアウト</title>
    </head>
    <body>
    <p　id="next_stage">さあ、次はノーマルやランクでチームプレイの経験値を貯めましょう！</p>
    </body>
</html>