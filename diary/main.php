
<main  style="display:<?php echo $postSwitchMain?>";>
  <div class="mainContainer">
    <?php
      if(isset($_GET["categoryButton"])){
        $_SESSION['where'] = $_GET["categorySelect"];
        $_SESSION['column'] = "category";
      }
      if(isset($_GET["monthButton"])){
        $_SESSION['where'] = $_GET["monthSelect"];
        $_SESSION['column'] = "month";
      }else{
        $setWhere = null;
      }
      if(isset($_SESSION['where'])){
        if($_SESSION['where'] == "allCategory"){
          $setWhere = null;
        }elseif($_SESSION['where'] == "allMonth"){
          $setWhere = null;
        }else{
          $whereSQL = $_SESSION['where'];
          $columnSQL = $_SESSION['column'];
          $setWhere = "where $columnSQL = \"$whereSQL\"";
        }
      }else{
        $setWhere = null;
      }
      $stmtIndex = $pdo->query("select count(*) from mydiary $setWhere");
      $index = $stmtIndex->fetch();
      $maxPage = $index[0];
      $pageDiv = ceil($maxPage/5);
      $maxPageDiv = $pageDiv;
      $pageFirst = 0;
      $pageDivFirst = 0;
      if(empty($_GET['singleArticle'])):?>
        <div class="indexContainer">
          <ul style="order:3;">
            <?php while($pageDiv > 0):
              if(isset($_GET["num$pageDiv"])){
                $pageFirst = $pageDiv * 5 - 5;
                if($pageDiv == ceil($pageFirst/5) + 1){
                   $liStyle = "selectedIndex";
                }
                $pageDivFirst++;
              } elseif($pageDiv == 1 && $pageDivFirst == 0){
                $liStyle = "selectedIndex";
              } else{
                $liStyle = "unSelectedIndex";
              }
            ?>
            <li>
              <a href="index.php?num<?php echo $pageDiv ?>" style="order:1;" class="<?php echo $liStyle ?>">
                <?php echo $pageDiv; ?>
              </a>
            </li>
            <?php
              $pageDiv-- ;
              endwhile;
              $pageNext = $pageFirst / 5;
              $pageback = $pageFirst / 5 + 2;
            ?>
          </ul>
          <?php if($pageback <= $maxPageDiv): ?>
            <a href="index.php?num<?php echo $pageback ?>" style="order:1;">←</a>
          <?php endif; ?>
          <?php if($pageNext > 0): ?>
            <a href="index.php?num<?php echo $pageNext ?>" style="order:3;">→</a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    <div>
      <?php
        if(isset($_GET['singleArticle'])){
          $singleArticle = $_GET['singleArticle'];
          $setSQL = "select * from mydiary where num = $singleArticle";
        }
        else{
          $setSQL = "select * from mydiary $setWhere order by num desc limit $pageFirst, 5";
        }
        $stmt = $pdo->query($setSQL);
        while($record = $stmt->fetch()):
          $num = $record['num'];
          $title = $record['title'];
          $article = $record['article'];
          $date = $record['date'];
          $category = $record['category'];
          if(!empty($_GET["del$num"])){
            $delSQL = "delete from mydiary where num = $num";
            $del = $pdo->prepare($delSQL);
            $del->execute();
            header("Location: index.php");
            exit;
          }
      ?>
      <article>
        <form action="index.php" method="get">
          <input type="submit" name="del<?php echo $num; ?>" value="×">
        </from>

        <label>
          <form action="index.php" method="get">
            <input type="hidden" value="<?php echo $num; ?> " name="singleArticle">
            <input type="submit" value="" name="<?php echo $num; ?>" class="articles">
          </form>
          <h1 class="color<?php echo rand(1, 3); ?>"><?php echo $title; ?></h1>
        </label>
        <span>
          <time><?php echo $date; ?></time>
          Category:<?php echo $category; ?>
        </span>
        <p><?php echo $article; ?></p>
      </article>
      <?php endwhile; ?>
    </div>
  </div>
</main>
