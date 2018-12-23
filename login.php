<?php

session_start();

if (isset($_SESSION['Id'])) {
  header('location: index.php');
}

include ('database.php');

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login | Home of FUO</title>
  <meta name="description" content="particles.js is a lightweight JavaScript library for creating particles.">
  <meta name="author" content="Vincent Garreau" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" media="screen" href="css/particles/css/style.css">
  <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">


  <link rel="stylesheet" href="css/plugins/bootstrap.min.css">
  <!-- EOF CSS INCLUDE -->

</head>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //if the sign in button is clicked
    if (isset($_POST['login'])) {
      require 'includes/signin.php';

    }
  }
 ?>
<body>
<div class="container">
  <div class="row">
    <div class="col-sm-12">

      <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 col-sm-offset-2 col-md-offset-3 col-lg-offset-3">
        <div class="login-box">

          <div class="col-sm-12">
            <div class="logo">
              <div class="text-center">
                <a href="profile-page.php" style="color:#2f4f4f">
                  <img src="images/advert/logo.png" class="logo-img" alt="logo" width="150" height="107">
                  <br>
                  <h3 class="logo-name"><span class="a">FUO</span><span class="b">BoxMedia</span></h3>
                </a>
              </div>
            </div>
          </div>

          <div class="">
            <div class="login-title"><strong>Welcome</strong>, Please login</div>
              <form action="" class="form-horizontal" method="post">
                <div class="col-xs-12">
                  <div class="form-group">
                    <input type="text" name="email_username" class="form-control ooo" placeholder="Email or Username"/>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group">
                    <input type="password" name="password" class="form-control ooo" placeholder="Password"/>
                  </div>
                </div>

                <div class="">
                  <button type="submit" name="login" class="btn btn-info btn-block">Log In</button>
                </div>

                <br>

                <div class="">
                  <a href="#" class="btn-link btn-block">Forgot your password?</a>
                </div>
                <br>
                <div class="">
                  <!--ERROR MESSAGES-->
                  <?php if(isset($userMsgg)) {
                    echo "<div style='color:red'>$userMsgg</div>" ;
                  } ?>
                  <!--END OF ERROR MESSAGES-->
                </div>
              </form>
          </div>

          <div class="login-footer">
            <div class="pull-left foot-side1">
                &copy; 2019 BoxMedia
            </div>
            <div class="pull-right foot-side2">
              <a href="index.php">Home</a> |
              <a href="#">About</a> |
              <!-- <a href="#">Privacy</a> | -->
              <a href="register.php">Sign Up</a>
            </div>
          </div>

      </div>
    </div>


    </div>
  </div>
</div>





</body>
</html>
