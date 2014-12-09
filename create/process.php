<?php
  mysql_connect('localhost','winwanwoni_maze','CanvasMaze123');
  mysql_select_db('winwanwoni_maze');
  $tileText = $_POST["tileText"];
  $name = $_POST["level_name"];
  mysql_query("INSERT INTO level (name,grid) VALUES ('$name','$tileText')");
  header( "location: ../index.php" );
?>
