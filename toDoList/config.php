<?php
  define('name','todo');
  define('user','root');
  define('password','P@ssw0rd');
  define('host','localhost');
  define('dsn','mysql:dbname=' . name .';host=' . host . '; charset=utf8');
  $pdo = new PDO(dsn, user, password);
?>
