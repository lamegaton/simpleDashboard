<?php
  require_once "config.php";
  session_start();
  $case_id = $_POST['choice'];
  $user_name  = $_SESSION['userName'];

  $sql_remove = "DELETE FROM user_meta WHERE case_id='$case_id' AND name='$user_name'";

  if (isset($_POST['choice']) && $mysqli->query($sql_remove) === TRUE) {
    $mysqli->close();
  }
?>
