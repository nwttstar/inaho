<?php
  $stmt = $pdo->query("select * from mydiary order by num desc limit 5");
  while($record = $stmt->fetch()):
    $num = $record['num'];
    $title = $record['title'];
    $time = $record['date'];
    $category = $record['category'];
    $date = New dateTime($time);
    $dateNew = $date->format('Y-m-d');
    ?>
    <label>
      <li>
        <form action="index.php" method="get">
          <input type="hidden" value="<?php echo $num; ?>" name="singleArticle">
          <input type="submit" value="" name="<?php echo $num; ?>" class="articles">
        </form>
        <p class="title"><?php echo $title; ?></p>
        <p class="info"><?php echo $category; ?> - <?php echo $dateNew; ?></p>
      </li>
    </label>
  <?php endwhile; ?>
