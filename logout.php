<?php
if (!isset($_SESSION)){session_start();}
session_destroy();
echo '<h3>Redirecting in 3 secs...</h3>';
header('Refresh: 1; URL=http://localhost/wordpress/');
exit;
?>
