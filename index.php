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
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular.min.js"></script>
  <link rel="stylesheet" href="create/css/bootstrap.min.css"/>
</head>
<body>
  <br>
  <div class="container" ng-init="page=1" ng-show="page==1">
    <div class="page-header" style="text-align:center;">
      <h1>Canvas Maze Game</h1>
    </div>
    <div class="well col-md-8 col-md-offset-2" style="text-align:center;">
      <a href="#" class="btn btn-lg btn-primary" ng-click="page=2">Play Maze Game</a>
      <a href="create/index.html" class="btn btn-lg btn-info">Level Creator</a>
    </div>
  </div>
  <div class="container" ng-show="page==2">
    <div class="page-header" style="text-align:center;">
      <h1>Canvas Maze Game</h1>
    </div>
    <div class="well col-md-8 col-md-offset-2">
      <h2>Game Options</h2><hr>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">{{game_mode}}</h3>
              </div>
              <div class="panel-body" >
                <p ng-show="game_mode=='Classic'">Just find the way out.</p>
                <p ng-show="game_mode=='Hard'">Beware your step! Maze wall cause of death.</p>
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
                <img width="60" height="60" src="game/images/megaman_thumb.png" ng-show="hero=='megaman'">
                <img width="60" height="60" src="game/images/kirby_thumb.png" ng-show="hero=='kirby'">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Maze Theme</h3>
              </div>
              <div class="panel-body">

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <form class="form-horizontal" method="POST" action="game/index.php" >
          <div class="form-group">
            <label class="col-sm-4 control-label">Level</label>
            <div class="col-sm-6">
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
              <select class="form-control" name="hero" ng-init="hero='megaman'" ng-model="hero">
                <option value="megaman">Megaman</option>
                <option value="kirby">Kirby</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Theme</label>
            <div class="col-sm-8">
              <select class="form-control" name="theme">
                <option>Forest</option>
                <option>Lava</option>
              </select>
            </div>
          </div>
          <input type="submit" class="btn btn-lg btn-primary" value="submit">
        </form>
      </div>
    </div>
  </div>
</body>
</html>
