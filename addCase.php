<?php
session_start();
require_once "config.php";
$username = $_SESSION['userName'];
echo "Today's date is :";
$today = date("m/d/Y");
echo $today.'<br><br>';
$case_id = mt_rand(1000000,9999999);
$_SESSION['caseName'] = $case_id;
//check if the case id is dupplicated
/*
we probally don't need to check in the database because
this is linked to each user
*/
// if case_id exits -> query
$sql_form ="INSERT INTO `user_meta`(name,case_id,case_number,form,form_status)
VALUES
('$username','$case_id',1,'parent_survey','incomplete'),
('$username','$case_id',1,'nwr','incomplete'),
('$username','$case_id',1,'picture_naming','incomplete'),
('$username','$case_id',1,'pictureID','incomplete')
/*
ON DUPLICATE KEY UPDATE
name='$username',
case_id='$case_id',
case_number=case_number+1,
UPDATE t1 SET c=c+1 WHERE a=1;
*/
";


/*
ON DUPLICATE KEY UPDATE
name='$username',
case_id='$case_id'
*/
if(isset($_POST['submit'])&&isset($username)){
  if ($mysqli->query($sql_form) === TRUE) {
   header("Location:showCase.php");
  } else {
    echo "Error: " . $sql_form . "<br>" . $mysqli->error;
  }
}

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>New case</title>
   </head>
   <body>
     <form class="addCase" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
       Child's name:
       <input type="text" name="childname" value="popeye"><br>
       <p>*This information will not be stored on our server </p>
       Child's date of birth:
       <input type="date" name="dob"><br>
       Gender: <br>
       <label for="male">Male</label>
       <input type="radio" name="gender" value="male"><br>
       <label for="female">female</label>
       <input type="radio" name="gender" value="female"><br>
       <label for="na">N/A</label>
       <input type="radio" name="gender" value="na"><br><br>
       <input type="submit" name="submit">
     </form>
     <div class="id">
       <a href="index.php">Go back to main Dashboard</a>
     </div>
   </body>
 </html>
