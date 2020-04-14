<?php
  session_start();
  require_once "config.php";
  $_SESSION['userName_wp'] = isset($_SESSION['userName_wp']) ? $_SESSION['userName_wp'] : include "logout.php";
  $user_name = "";
  $counter=0;
  $case_id_array=array();
  $_SESSION['userName']=isset($_SESSION['userName']) ? $_SESSION['userName'] : '';
  // echo $_SESSION['userName_wp'];
  $sql = "SELECT DISTINCT case_id FROM user_meta WHERE name = ?";
  if($stmt = $mysqli->prepare($sql)){
      $stmt->bind_param("s", $user_name);
      $user_name = $_SESSION['userName_wp'];
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
     <title>Show cases from user</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </head>
   <body>
     <div class="container">
       <?php echo "<h1>Hello, ".$user_name."! </h1>"; ?>
       <div class="panel panel-primary">
         <div class="panel-heading"><h3>Cases that you have inputted: </h3></div>
         <div class="panel-body">
           <table class="table">
             <thead>
               <tr>
                 <th class="col-xs-3"><h4><b>Case</b></h4></th>
                 <th class="col-xs-9"></th>
               </tr>
             </thead>
             <tbody>

             <?php
               if($stmt->num_rows > 0){

                 while ($stmt->fetch()) {
                   $case_id_array[$counter] = $case_id;
                   echo '<tr><td><h4><a href="#" class="addCase" id="'.$case_id.'">'.$case_id.'</h4></td>';
                   echo '<td><button class="btn btn-danger removeCase" id="'.$case_id.'">Remove</button><br><br></td></tr>';
                   $counter +=1;
                 }
                 $counter =0;
               }else{
                   echo '<h3>You don\'t have any cases available.</h3> <br>';
                   // echo 'Redirecting in 3 secs...';
                   // header('Refresh: 3; URL=http://localhost/wordpress/');
                 }
             ?>
         </tbody>
       </table>
        <a class="btn btn-primary" href="addCase.php">Add a new case</a>
        <a class="btn btn-primary" href="logout.php">Log-out</a>
          </div>
        </div>
      </div>
   </body>
   <?php
     echo '<script type="text/javascript">';
     require "js/onclickButton.js";
     echo "</script>";
   ?>
 </html>

<?php
$stmt->close();
$mysqli->close();
 ?>
