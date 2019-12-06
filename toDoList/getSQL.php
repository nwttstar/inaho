<?php

$st = $pdo->query("SELECT * FROM todo order by clear asc");
$int = 0;
while ($row = $st->fetch()) {
  $clearCSS = "notCleared";
  $clearedMargin = "cleared";
  $id = $row['id'];
  $clear = $row['clear'];
  $comment = htmlspecialchars($row['comment']);
  $date = $row['date'];
  $week = $row['week'];
  $dateNew = new DateTime($date);
  $datePost = $dateNew->format('Y-m-d H:i');
  switch ($week) {
    case '0': $week = "Mon"; break;
    case '1': $week = "Tue"; break;
    case '2': $week = "Wed"; break;
    case '3': $week = "Thu"; break;
    case '4': $week = "Fri"; break;
    case '5': $week = "Sat"; break;
    case '6': $week = "Sun"; break;
  }
  if ($clear){
    $clearCSS = "cleared";
    if($int == 0){
      echo "<tr class=\"comp\"><td colspan=\"4\" ><br><p>Completed!</p></td></tr>";
      $int++;
    }
  }
  echo
    "<tr>
      <td>
        <p class=\"id\">
          $id
        </p>
      </td>
    <td>
      <form action=\"test.php\" method=\"post\">
          <input type=\"checkbox\" name=\"checkBox[]\" value=\"$id\" id=\"trCheck$id\" class=\"checkBox\">
          <span class=\"checkBoxInput\"></span>
      </from>";
      if(isset($_POST["checkBox"])){
        $changeNum = $_POST["checkBox"];
        foreach($changeNum as $countChangeNum){
          $changeClear = $pdo->prepare("update todo set clear = true where id = $countChangeNum");
          $changeClear->execute();
          header("Location: test.php");
        }
      }
  echo
    "</td>
    <td class=\"comment\">
      <p class=\"$clearCSS\">
        <label for=\"trCheck$id\" class=\"mouse\">$comment</label>
      </p>
    </td>
    <td class=\"date\">
      <p class=\"date\">
        $datePost ($week)
      </p>
    </td>
    <td>
      <form action=\"test.php\" method=\"post\">
        <input type=\"submit\" name=\"del$id\" value=\"Del\" id=\"delButton\">
      </from>";
      if(isset($_POST["del$id"])){
        $del = $pdo->prepare("delete from todo where id = $id");
        $del->execute();
        header("Location: test.php");
      }
  echo
    "</td>
    </tr>";
  unset($clearCSS);
}
?>
