<?php
/* Log out process, unsets and destroys session variables */

session_start();

include_once 'includes/database.php';


// Check if user is logged in using the session variable
if (!isset($_SESSION['Id'])) {

  header('location: login.php');

}else {
  //SESSION VARIABLE DECLARED
  // Makes it easier to read
  $adminId = $_SESSION['Id'];
  $FirstName = $_SESSION['first_name'];
  $LastName = $_SESSION['last_name'];
  $Email = $_SESSION['email'];
  $Active = $_SESSION['active'];
  $ProImg = $_SESSION['profile_img'];

}

$sql = "UPDATE admin SET active = 0 WHERE email = '$Email' and Id = '$adminId'";
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
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--<link rel="stylesheet" href="css/flexboxgrid.css">-->
  <title>Reset Your Password</title>
</head>

<body>
  <div class="container">
    <div class="row center-xs center-sm center-md center-lg major-row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
          <div class="header">
            <h1>Thanks for stopping by</h1>
          </div>
          <div class="message">

            <p><?= 'You have been logged out!'; ?></p>

            <a href="login.php" ><button class="btn btn-primary" style="font-weight:700">Home</button></a>
          </div>
      </div>
    </div>
  </div>
</body>
</html>
