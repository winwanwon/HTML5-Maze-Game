<?php
mysql_connect('localhost','winwanwoni_maze','CanvasMaze123');
mysql_select_db('winwanwoni_maze');
?>
<!DOCTYPE html>
<html ng-app>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CPE111 Maze Game</title>
  <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular.min.js"></script>
  <link rel="stylesheet" href="create/css/bootstrap.min.css"/>
  <style>
    body {
      width:100%;
      height:100%;
    }

    .container {
      background: url('background_index.png') repeat 5% 5%;
      background-size:cover;
      width: 100%;
      height:100%;
      position:absolute;
    }

    h1 {
      font-size:72px; color:#ecf0f1; text-align:center; margin-top: 60px;
      letter-spacing: 15px;
      font-weight:100;
    }

    h2 {
      font-size:36px; color:#ecf0f1; text-align:center; margin: 10px auto 30px auto;
      letter-spacing: 10px;
      font-weight:100;
    }

    h4 {
      font-size:20px; color:#ecf0f1; text-align:center;
      letter-spacing: 5px;
      font-weight:100;
    }

    h6 {
      font-size:12px; color:#ecf0f1; text-align:center;
      letter-spacing: 2px;
      font-weight:100;
      opacity: 0.9;
    }

    .well {
      margin-top: 60px;
      background: rgba(0, 0, 0, 0.6);
      color: #FFF;
      padding: 80px auto;
    }

  </style>
</head>
<body>
  <div class="container" ng-init="page=1" ng-show="page==1">
    <h1>MAZE GAME</h1>
    <div class="well col-md-6 col-md-offset-3" style="text-align:center;">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <br><br>
          <a href="#" class="btn btn-lg btn-block btn-primary" ng-click="page=2">Play Maze Game</a>
          <a href="create/index.html" class="btn btn-lg btn-block btn-info">Level Creator</a>
        </div>
      </div>
      <div class="row">
        <br><br>
        <h4>powered by <img src="html5_logo.png" height="36"> <img src="angular_logo.png" height="36"></h4>
        <h6>CPE111 Computer Engineering Exploration Project</h6>
      </div>
    </div>
  </div>
  <div class="container" ng-show="page==2">
    <div class="well col-md-8 col-md-offset-2" >
      <h2>Game Options</h2>
      <div class="col-md-6" style="text-align:center;">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">{{game_mode}}</h3>
              </div>
              <div class="panel-body" style="color:#000;">
                <p ng-show="game_mode=='Classic'">Just find the way out.</p>
                <p ng-show="game_mode=='Hard'">Do not TOUCH the wall.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Charactor</h3>
              </div>
              <div class="panel-body">
                <img height="80" src="game/images/megaman_thumb.png" ng-show="hero=='Megaman'">
                <img height="80" src="game/images/kirby_thumb.png" ng-show="hero=='Kirby'">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Maze Theme</h3>
              </div>
              <div class="panel-body">
                <img width="80" height="80" src="game/images/block_brick.png" ng-show="theme=='City'">
                <img width="80" height="80" src="game/images/block_lava.png" ng-show="theme=='Lava'">
                <img width="80" height="80" src="game/images/block_spike.png" ng-show="theme=='Space'">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <form class="form-horizontal" method="POST" action="game/index.php" >
          <div class="form-group">
            <label class="col-sm-4 control-label">Level</label>
            <div class="col-sm-8">
              <select class="form-control" name="level">
                <?php
                $query = mysql_query("SELECT * FROM level");
                while($result = mysql_fetch_array($query)){
                  echo '<option value="'.$result["id"].'">'.$result["name"].'</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Mode</label>
            <div class="col-sm-8">
              <select class="form-control" name="game_mode" ng-model="game_mode" ng-init="game_mode='Classic'">
                <option value="Classic">Classic</option>
                <option value="Hard">Hard</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Character</label>
            <div class="col-sm-8">
              <select class="form-control" name="hero" ng-init="hero='Megaman'" ng-model="hero">
                <option value="Megaman">Megaman</option>
                <option value="Kirby">Kirby</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Theme</label>
            <div class="col-sm-8">
              <select class="form-control" name="theme" ng-init="theme='City'" ng-model="theme">
                <option value="City">City</value>
                <option value="Lava">Lava</value>
                <option value="Space">Space Trap</value>
              </select>
            </div>
          </div>
          <div class="col-md-8 col-md-offset-4">
            <input type="submit" class="btn btn-lg btn-primary" value="Play!">
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
