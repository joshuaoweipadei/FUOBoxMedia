<?php

session_start();

if (isset($_SESSION['Id'])) {

  //SESSION VARIABLE DECLARED
  $userID = $_SESSION['Id'];
  $email = $_SESSION['email'];
  $active = $_SESSION['active'];

} else {
  header('location: /FUOBoxMedia/index.php');
}

include '../includes/database.php';

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FUOBoxMedia | Friend Profile</title>

    <link rel="stylesheet" href="../css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="../css/plugins/font-awesome/css/font-awesome.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="../css/custom/main.css">
    <link rel="stylesheet" href="../css/custom/profile.css">

</head>
<body>
  <?php
  if (isset($_GET['id'])) {
    // Escape all $_POST variables to protect against SQL injections
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $unfriend_Id = test_input($_GET['id']);

    if (is_numeric($unfriend_Id)) {
      if ($userID == $unfriend_Id) {
        header('location: /FUOBoxMedia/profile_page.php');
      } else {
        $sql = "SELECT * FROM users_account WHERE Id = '$unfriend_Id'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($query) {
          if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_array($query);
            $unfriend_Id = $row['Id'];
            $unfriend_name = $row['first_name']." ".$row['last_name'];

          } else {
            header('location: /FUOBoxMedia/profile_page.php');
          }
        }
      }
    } else {
      header('location: /FUOBoxMedia/profile_page.php');
    }

  // end of the GET Id
  } else {
    header('location: /FUOBoxMedia/');
  }
 ?>

 <?php
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (isset($_POST['unfriend'])) {

     $unfriend = test_input($_POST['id']);

     $sql = "SELECT * FROM myfriends WHERE (myId = '$userID' AND myfriends = '$unfriend') OR (myId = '$unfriend' AND myfriends = '$userID')";
     $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
     if ($query) {
       if (mysqli_num_rows($query) == 1) {
         $sql2 = "DELETE FROM myfriends WHERE (myId = '$userID' AND myfriends = '$unfriend') OR (myId = '$unfriend' AND myfriends = '$userID')";
         $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
         if ($query2) {
           $result = "You have successfully unfriend";
         }
       } else {
         echo "string";
       }
     }

   }
 }
  ?>

  <!-- main header -->
  <div class="top-header">
    <div class="pull-left">
      <ul class="nav nav-pills">
        <li style="margin-left:10px"><a href="/FUOBoxMedia/index.php"><span class="logo-name"><i class="fa fa-th-large" style="font-size:26px"></i> <span style="color:#fff" >FUO</span><span style="color:rgba(185,0,255,0.9)">BoxMedia</span></span></a></li>
      </ul>
    </div>
    <div class="pull-right">
      <ul class="nav nav-pills">
        <?php
          if (!isset($_SESSION['Id'])) {
            echo "<li><a href='register.php'><i class='fa fa-plus-square'></i> Register</a></li>";
          }
         ?>
         <?php
           if (isset($_SESSION['Id'])) {
             echo "<li><a href='logout.php'><i class='fa fa-sign-out'></i> Log out</a></li>";
           } else {
             echo "<li><a href='login.php'><i class='fa fa-sign-in'></i> Log in</a></li>";
           }
          ?>
      </ul>
    </div>
    <div class="clearfix"></div>
  </div><!-- end of main header -->

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="delete_unfriend">
          <h3>Are you sure you want to unfriend <?php if(isset($unfriend_name)){ echo $unfriend_name; } ?>?</h3>
          <div class="delete_unfriend_btn">
            <form action=" " method="post">
              <a href="javascript:history.back()" class="btn btn-default">Cancel</a>
              <input type="hidden" name="id" value="<?php echo $unfriend_Id ?>">
              <button type="submit" name="unfriend" class="btn btn-primary">yes</button>
            </form>
          </div>
          <br>
          <div class="">
            <span><?php if (isset($result)) { echo $result; } ?> </span>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- bootstrap js -->
  <script src="../js/plugins/bootstrap.min.js"></script>



  </body>
  </html>
