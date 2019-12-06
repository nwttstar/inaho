<main  style="display:<?php echo $postSwitchPost?>";>
  <div class="mainContainer">
    <form action="index.php" method="post">
      <h3>TITLE</h3>
        <input type="text" name="titlePost" size="30%" maxlength="20" autocomplete="off" required>
      <h3>ARTICLE</h3>
        <textarea name="articlePost" cols="60%" rows="20" maxlength="20000" required></textarea>
      <h3>CATEGORY</h3>
        <input type="text" name="categoryPost" size="10%" maxlength="10" required>
      <input type="submit" name="allPost" value="POST!" class="postButton">
      <a href="index.php">戻る</a>
    </form>
  </div>
</main>

<?php
if (!empty($_POST["allPost"])){
  unset($_SESSION['where']);
  unset($_SESSION['column']);
  $titlePost = $_POST["titlePost"];
  $articlePost = $_POST["articlePost"];
  $categoryPost = $_POST["categoryPost"];
  $order = "insert into mydiary (title, article, date, category, month) value('$titlePost', '$articlePost', now(), '$categoryPost', current_date)";
  $postStmt = $pdo->prepare($order);
  $postStmt->execute();
}
?>
