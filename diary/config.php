<?php
  define('name','rs-ishigamaya_mydiary');
  define('user','rs-ishigamaya');
  define('password','shihoa1110');
  define('host','mysql745.db.sakura.ne.jp');
  define('dsn','mysql:dbname=' . name .';host=' . host . '; charset=utf8');
  $pdo = new PDO(dsn, user, password);
?>
