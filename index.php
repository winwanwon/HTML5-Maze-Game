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
    <div class="well col-md-8 col-md-offset-2" style="text-align:center;">
      <h2>Game Options</h2><hr>
      <div class="col-md-2"></div>
      <div class="col-md-10">
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
            <div class="col-sm-6">
              <select class="form-control" name="game_mode">
                <option value="classic">Classic</option>
                <option value="hard">Hard</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Character</label>
            <div class="col-sm-6">
              <select class="form-control" name="hero">
                <option>Megaman</option>
                <option>Other Playable Character</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Theme</label>
            <div class="col-sm-6">
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
