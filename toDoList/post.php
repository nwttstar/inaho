<?php
  if (isset($_POST["formComment"])){
    $comment = $_POST["formComment"];
    $formInto = "insert into todo (comment, clear, date, week) value(:comment, false, now(), weekday(now()))";
    $stmt = $pdo->prepare($formInto);
    $params = array(':comment' => $comment);
    $stmt->execute($params);
  }
?>
