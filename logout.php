<?php
/* Log out process, unsets and destroys session variables */

session_start();

include 'includes/database.php';


// Check if user is logged in using the session variable
if (!isset($_SESSION['Id'])) {

  header('location: index.php');

}else {
  //SESSION VARIABLE DECLARED
  // Makes it easier to read
  $userID = $_SESSION['Id'];
  $email = $_SESSION['email'];

}

$sql = "UPDATE users_account SET active = 0, last_seen = NOW() WHERE email = '$email' and Id = '$userID'";
mysqli_query($conn, $sql) or die(mysqli_error($conn));

session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="veiwport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="css/flexboxgrid.css">-->
  <title>Reset Your Password</title>
  <style media="screen">
    .container-fluid{ margin:auto; overflow-x:hidden; }
    .major-row{ width:100%; overflow-x:hidden; margin:auto; }
    .header{ margin: 20px 0px 50px 0px; padding: 20px 0px; background:url(images/wallpapers/wallpaper7.jpg); background-repeat:
      no-repeat; background-size: cover; background-position: center; text-align: center; }
    .header h1{ color:#fff; font-weight:700; font-size:200%; }
    .message p{font-size:130%; text-align:center;}
  </style>
</head>

<body>
  <div class="container-fliud">
    <div class="row center-xs center-sm center-md center-lg major-row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="header">
            <h1>Thanks for stopping by</h1>
          </div>
          <div class="message">

            <p><?= 'You have been logged out!'; ?></p>

            <a href="index.php" ><button class="btn btn-primary" style="font-weight:700">Home</button></a>
          </div>
      </div>
    </div>
  </div>
</body>
</html>
