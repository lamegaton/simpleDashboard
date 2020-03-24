<?php
//son 03/22/2020
  require_once "config.php";
  $user_name = "";
  // now lookup to see if $user_name from html/input is in our Database
  $sql = "SELECT DISTINCT case_id FROM user_meta WHERE name = ?";
  if($stmt = $mysqli->prepare($sql)){
      $stmt->bind_param("s", $user_name); //$stmt->bind_param("s", $_POST["name"]);
      $user_name = trim($_POST['name']);
      if($stmt->execute()){
          $stmt->store_result();
          $stmt -> bind_result($user_email);
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
     <form class="user-input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
       method="post">
       Name: <input type="text" name="name"><br>
     </form>
     <?php
       if($stmt->num_rows > 0){
         while ($stmt->fetch()) {
           echo '<ul> case: '. $user_email .'</ul>';
         }
       }else{
           echo 'The user name is invailid';
         }
     ?>
   </body>
 </html>
