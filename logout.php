<?php
//header should be put on top
header('Refresh: 1; URL=http://localhost/wordpress/');
  if (!isset($_SESSION)){session_start();}
  session_destroy();
  echo '<h3>Redirecting in 3 secs...</h3>';
  header('Refresh: 1; URL=http://localhost/wordpress/');
  exit;
?>
