<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'testing');

/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

function mysql_fix_string($string){
  if (get_magic_quotes_gpc()) $string = stripslashes($string);
  return $mysqli->real_escape_string($string);
}

function mysql_entities_fix_string( $string)
{
  return htmlentities(mysql_fix_string($mysqli, $string));
}

?>
