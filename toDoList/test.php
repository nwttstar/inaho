<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
  <title>toDoList</title>
  <link rel="stylesheet" type="text/css" href="test.css">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Kosugi+Maru" rel="stylesheet">
  <?php require_once("config.php"); ?>
  <?php require("reset.php"); ?>
  <?php require("post.php"); ?>
</head>

<body>
<div class="around">
<div class="main">
  <center>
  <img src="img/title.png">
    <form action="test.php" method="POST">
      <input type="text" name="formComment"  placeholder="Let's post new jobs!" class="textBox" autocomplete="off" required>
      <input type="submit" value="Post" class="post">
    </form>
  <form action="test.php" method="post">
    <p class="doneLeft">These checked jobs are...</p>
    <input type="submit" name="checkButton" value="Done!" class="done">
  </from>
  <table>
    <?php require("getSQL.php"); ?>
  </table>
  <form action="test.php" method="POST">
    　<input type="submit" name="resetButton" value="All Reset" id = "delButton" class="allDel">
  </form><br>
  </center>
  <footer>
    <p>Created by Sii-chan, thanks to Sii-chan!</p>
  </footer>
</div>
</div>
</body>

</html>
