<?php
  if(isset($_POST["resetButton"])){
    $reset = $pdo->query("truncate table todo");
    $reset->execute();
  }
?>
