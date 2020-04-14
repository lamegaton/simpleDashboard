<?php
/*
This is because these values have been
entered by the user and therefore cannot be trusted, as a hacker
could make a cross-site scripting attempt by adding HTML charac‐
ters and other symbols to the input. htmlspecialchars translates
any such input into harmless HTML entities
*/

session_start();
require_once "config.php";
$user_name = htmlspecialchars($_SESSION['userName']);
if(isset($_POST['caseName'])){
  $caseName = htmlspecialchars(trim( $_POST['caseName']));
}else {
  $caseName = htmlspecialchars($_SESSION['caseName']);
}

$sql="SELECT form, form_status,form_date_modified FROM user_meta WHERE case_id=?
ORDER BY form";
if($stmt = $mysqli->prepare($sql)){
    $stmt->bind_param("s", $caseName); //$stmt->bind_param("s", $_POST["name"]);
    $_SESSION['caseName'] = $caseName;
    if($stmt->execute()){
        $stmt->store_result();
        $stmt -> bind_result($formsName,$formStatus,$formDateModified);
      }
    }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Show all child task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
    <h1>Hello, <?php echo $user_name; ?>! </h1>
    <div class="panel panel-primary">
      <div class="panel-heading"><h3>Case ID: <?php echo $caseName; ?></h3></div>
      <div class="panel-body">
    <table class="table">
      <thead>
        <tr>
          <th><h4><b>Form</b></h4></th>
          <th><h4><b>Form status</b></h4></th>
          <th><h4><b>Form date modified</b></h4></th>
          <th><h4><b>Review</b></h4></th>
        </tr>
      </thead>
      <tbody>
        <?php
        // when user click Edit button, it will redirect to that form
        if($stmt ->num_rows > 0){
          while ($stmt ->fetch()) {
            $url = "http://localhost/simpleDashboard/html-en/".$formsName."_form.php";
            echo '<tr>
            <td><h4><a href=\''.$url.'\' id="'.$formsName.'">'.$formsName.'</h4></td>
            <td><h4>'.$formsName.'</h4></td>
            <td><h4>'.$formStatus.'</h4></td>
            <td><h4>'.$formDateModified.'</h4></td>
            </tr>';
          }
          // <td><button id="'.$formsName.'"onclick="window.location.href =\''.$url.'\'";>Edit</button>
        }
        ?>
      </tbody>
    </table>
    <!-- <a href="../simpleDashboard/php/dummie-form.php"> dummie_form for testing </a> -->
    <a href="index.php">Go back to main Dashboard</a>
        </div>
          </div>
            </div>
  </body>
</html>

<?php
//unset($_SESSION['caseName']);
$mysqli ->close();
 ?>
