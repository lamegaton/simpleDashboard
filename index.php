<?php
  session_start();
  require_once "config.php";
  $user_name = "";
  $counter=0;
  $case_id_array=array();
  $_SESSION['userName']=isset($_SESSION['userName']) ? $_SESSION['userName'] : '';

  $sql = "SELECT DISTINCT case_id FROM user_meta WHERE name = ?";
  if($stmt = $mysqli->prepare($sql)){
      $stmt->bind_param("s", $user_name); //$stmt->bind_param("s", $_POST["name"]);
      // $user_name = trim($_POST['name']);
      $user_name = "sona";
      $_SESSION['userName']=$user_name;
      if($stmt->execute()){
          $stmt->store_result();
          $stmt -> bind_result($case_id);
        }
  }
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Show cases from user</title>
   </head>
   <body>
     <!-- <form class="user-input" action="<?php// echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
       method="post"> -->
       <!-- Name: <input type="text" name="name"> -->
       <?php echo "<h1>Hello, ".$user_name."</h1>";
             echo "<h3>This is all the cases that you have: <br></h3>";
        ?>
     <!-- </form> -->
     <?php
       if($stmt->num_rows > 0){
         while ($stmt->fetch()) {
           $case_id_array[$counter] = $case_id;
           echo '<form method="post" action="showCase.php" id="chooseCase">';
           echo '<input type="hidden" name="caseName" value="'.$case_id.'"></button>';
           echo 'Case: <input type="submit" value="'.$case_id.'"> ';
           echo '</form>';
           echo '<form method="post">';
           echo '<input type="submit" name="'.$case_id.'" value="Remove">';
           echo '</form><br>';
           $counter +=1;
         }
         $counter =0;
       }else{
           echo 'The user name is invailid <br>';
         }
     ?>
     <a href="addCase.php">Add a new case</a>
     <a href="removeCase.php">Remove a case</a>

   </body>
 </html>

<?php
$counter = 0;
while ($counter < sizeof($case_id_array) && !isset($_POST[$case_id_array[$counter]])) {
$counter += 1;
}
$case_id = $case_id_array[$counter];
echo "<br>this is your choice: ".$case_id." your name is: ".$user_name;

$sql_remove = "DELETE FROM user_meta WHERE case_id='$case_id' AND name='$user_name'";
if (isset($_POST[$case_id_array[$counter]]) && $mysqli->query($sql_remove) === TRUE) {
  echo "<br>removed!";
  header("Refresh:0");
}

$mysqli->close()
 ?>
