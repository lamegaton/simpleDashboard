<?php
session_start();
require_once "config.php";
$user_name = $_SESSION['userName'];
if(isset($_POST['caseName'])){
  $caseName = htmlspecialchars(trim( $_POST['caseName']));
}else {
  $caseName = $_SESSION['caseName'];
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
  </head>
  <body>
    <h1>Hello, <?php echo $user_name; ?> </h1>
    <h2>Case ID:<?php echo $caseName; ?></h2>
    <table>
      <thead>
        <tr>
          <th>Form</th>
          <th>Form status</th>
          <th>Form date modified</th>
          <th>Edit</th>
          <th>Review</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // when user click Edit button, it will redirect to that form
        if($stmt ->num_rows > 0){
          while ($stmt ->fetch()) {
            $url = "http://localhost/simpleDashboard/html-en/".$formsName."_form.php";
            echo '<tr>
            <td>'.$formsName.'</td>
            <td>'.$formStatus.'</td>
            <td>'.$formDateModified.'</td>
            <td><button id="'.$formsName.'"onclick="window.location.href =\''.$url.'\'";>Edit</button>
            </tr>';
          }
        }
        ?>
      </tbody>
    </table>
    <a href="../simpleDashboard/php/dummie-form.php"> dummie_form for testing </a>
    <br>
    <a href="index.php">Go back to main Dashboard</a>
  </body>
</html>

<?php
//unset($_SESSION['caseName']);
echo $_SESSION['caseName'];
echo $_SESSION['userName'];
 ?>
