<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>My diary</title>
  <link rel="stylesheet" type="text/css" href="index.css">
  <?php require_once("config.php"); ?>
</head>
<body>
<header>
  <label>
    <img src="img/title.png">
    <form action="index.php" method="post">
      <input type="submit" name="titleButton">
    </form>
  </label>
  <label>
    <img src="img/postOver.png" class="post">
    <form action="index.php" method="get">
      <input type="submit" value="post" name="postButton">
    </form>
  </label>

</header>
<?php
  $postSwitchPost = "none";
  $postSwitchMain = "inline";
  if(isset($_GET["postButton"])):
    unset($_SESSION['where']);
    $postSwitchPost = "inline";
    $postSwitchMain = "none";
  endif;
  if(isset($_POST["titleButton"])):
    unset($_SESSION['where']);
    $postSwitchPost = "none";
    $postSwitchMain = "inline";
  endif;
  require("post.php");
  require("main.php");
?>
<nav>
  <form action="index.php" method="get">
    <label>
      <p class="top">◁</p>
      <input type="submit" name="categoryButton" style="display:none;">
    </label>
    <select name="categorySelect">
      <option value="allCategory">Categories</option>
      <?php require("category.php"); ?>
    </select>
  </form>
  <form action="index.php" method="get">
    <label>
      <p class="bottom">◁</p>
      <input type="submit" name="monthButton" style="display:none;">
    </label>
    <select name="monthSelect">
      <option value="allMonth">Calendar</option>
      <?php require("month.php"); ?>
    </select>
  </form>
  <ul>
    <h2>New articles</h2>
    <?php require("articles.php"); ?>
  </ul>
</nav>
<footer>
  Here is Sii-chan's Secret Diary. No one reads this diary. Go back, please! 　　twitter @nwttstar
</footer>
</body>
</html>


<!--

データベース項目
  主キー
    記事NO
  フィールド
    タイトル 60字
    記事　200000字
    日付　
    カテゴリ　20字

+----------+-------------+------+-----+---------+----------------+
| Field    | Type        | Null | Key | Default | Extra          |
+----------+-------------+------+-----+---------+----------------+
| num      | int(11)     | NO   | PRI | NULL    | auto_increment |
| title    | varchar(60) | YES  |     | NULL    |                |
| article  | longtext    | YES  |     | NULL    |                |
| date     | datetime    | YES  |     | NULL    |                |
| category | varchar(40) | YES  |     | NULL    |                |
| month    | date        | YES  |     | NULL    |                |
+----------+-------------+------+-----+---------+----------------+

-->
