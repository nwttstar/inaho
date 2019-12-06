<?php
  $stmt = $pdo->query("select distinct category from mydiary order by num desc");
  while($record = $stmt->fetch()):
    $category = $record['category'];
    echo "<option>$category</option>";
  endwhile;
?>
