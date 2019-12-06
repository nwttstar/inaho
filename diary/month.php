<?php
  $stmt = $pdo->query("select distinct month from mydiary order by num desc");
  while($record = $stmt->fetch()):
    $month = $record['month'];
    echo "<option>$month</option>";
  endwhile;
?>
