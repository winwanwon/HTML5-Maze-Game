<?php
  mysql_connect('localhost','winwanwoni_maze','CanvasMaze123');
  mysql_select_db('winwanwoni_maze');
  $level = $_POST["level"];
  $hero = $_POST["hero"];
  $theme = $_POST["theme"];
  $query = mysql_query("SELECT * FROM level WHERE id='$level'");
  $result = mysql_fetch_array($query);
  $tileText = $result["grid"];
?>
<!DOCTYPE html>
<html ng-app>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Canvas Maze Game Project.</title>

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes"> <!-- Display full-screen in standalone mode -->
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <link rel="apple-touch-icon" href="apple-touch-icon.png"/>
  <!-- <link rel="author" href="humans.txt" /> -->
  <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" media="all" href="css/reset.css" />
  <link rel="stylesheet" media="all" href="css/main.css" />
  <link rel="stylesheet" media="all" href="css/utilities.css" />
  <link rel="stylesheet" media="screen" href="css/media.css" />
  <link rel="stylesheet" media="print" href="css/print.css" />
  <style>
   body {
     background: #ecf0f1;
   }

   .box {
     padding:30px;
     border: solid 10px #2980b9;
     margin: 60px;
     -webkit-animation: boxanimate 2s linear infinite;
     animation: boxanimate 2s linear infinite;
   }

   @-webkit-keyframes boxanimate {
     0% {border-color: #3498db;}
     50% {border-color: #f1c40f;}
     100% {border-color: #3498db;}
   }

   @keyframes boxanimate {
     0% {border-color: #3498db;}
     50% {border-color: #f1c40f;}
     100% {border-color: #3498db;}
   }

   #star {
     font-size: 62px;
     color:#bdc3c7;
   }

   #first_star {
     font-size: 62px;
     color:#bdc3c7;
     -webkit-animation: 1s staranimate 1s linear infinite;
     animation: 1s staranimate 1s linear infinite;
   }

   #second_star {
     font-size: 62px;
     color:#bdc3c7;
     -webkit-animation: 1s staranimate 2s linear infinite;
     animation: 1s staranimate 2s linear infinite;
   }

   #third_star {
     font-size: 62px;
     color:#bdc3c7;
     -webkit-animation: 1s staranimate 3s linear infinite;
     animation: 1s staranimate 3s linear infinite;
   }

   @-webkit-keyframes staranimate {
     0% {color: #f1c40f;}
     50% {color: #f39c12;}
     100% {color: #f1c40f;}
   }

   @keyframes staranimate {
     0% {color: #f1c40f;}
     50% {color: #f39c12;}
     100% {color: #f1c40f;}
   }

  </style>
</head>
<body>
  <!-- Prompt IE 6/7/8 users to upgrade their browser.
    Earlier IE doesn't have good enough Canvas support.
    Flash libraries that claim to add Canvas support back don't support some of
    the tricks we use like context.transform(). -->
  <!--[if lt IE 9 ]>
    <p class="outdated">
      You are using an <strong>outdated</strong> browser.
      <a href="http://whatbrowser.org/">Upgrade to a different browser</a> to
      experience this site.
    </p>
  <![endif]-->
    <div id="main">
      <div id="content">
        <noscript>You must have JavaScript enabled to use this site.</noscript>
        <canvas id="canvas" width="800" height="600" data-resize="full">
          Your browser does not support the &lt;canvas&gt; element!
        </canvas>
      </div> <!-- /content -->
    </div> <!-- /main -->
    <div id="result" style="display:none; text-align:center;">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="box">
            <h1 style="font-size: 72px; color:#2c3e50; ">STAGE CLEARED</h1>
            <hr>
            <span class="glyphicon glyphicon-star" id="first_star" aria-hidden="true"></span>
            <br>
            <hr>
            <a href="../index.php"><button class="btn btn-default">click here to continue</button></a>
          </div>
        </div>
      </div>
    </div>
  <script>
  <?php
    for($pos=16; $pos <= 16*8 ; $pos+=18){
    $tileText = substr_replace($tileText, "\\n", $pos, 0);
    }
    echo 'var grid = "';
    echo $tileText;
    echo '";';

    if($_POST["game_mode"]=="Hard"){
      echo 'var game_mode = 2;';
    } else {
      echo 'var game_mode = 1;';
    }

    if($hero=="Megaman"){
      echo 'player_image = "images/player.png";';
    } else {
      echo 'player_image = "images/player.png";';
    }

    if($theme=="City"){
      echo 'tile_image = "images/block_brick.png";';
      echo 'background_image ="images/block_dirtplain.png";';
    } else if($theme=="Lava"){
      echo 'tile_image = "images/block_lava.png";';
      echo 'background_image ="images/block_lavadirt.png";';
    }

  ?>
  </script>
  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libraries/jquery-2.0.2.min.js"><\/script>')</script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular.min.js"></script>
  <script src="js/libraries/stats.min.js"></script>
  <script src="js/combined.min.js"></script>
  <script src="js/app/main.js"></script>
  <!-- Google Analytics: change UA-XXXXXXXX-X to be your site's ID. -->
  <script>
    var _gaq=[['_setAccount','UA-XXXXXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
</body>
</html>
