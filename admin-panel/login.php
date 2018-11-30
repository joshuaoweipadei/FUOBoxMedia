<?php
session_start();

if (isset($_SESSION['Id']) && isset($_SESSION['email'])) {
  header('location: index.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel | Login</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/plugins/custom.min.css" rel="stylesheet">
  </head>

  <?php
  /*TO RELOAD THIS IF THE LOGIN OR REGISTER BUTTON IS CLICKED*/
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //user logging in
      if (isset($_POST['submit_signup'])) {
          require 'includes/signup.php';
  }
      //user registering
      elseif (isset($_POST['submit_login'])) {
          require 'includes/signin.php';
      }
  }
  ?>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <h3 class="text-center"><?php if(isset($_SESSION['logout'])){ echo "You have been logged out."; unset($_GET['loggemedoutminna']); } ?></h3>
          <section class="login_content">
            <form action="login.php" method="post">
              <h1>Login Form</h1>
              <p style="color:red"><?php if(isset($userMsgg)) echo $userMsgg; ?></p>
              <div>
                <input type="email" class="form-control" name="email" placeholder="Email" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" />
              </div>
              <div>
                <button type="submit" name="submit_login" class="btn btn-default submit">LOG IN</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div style="margin-top:10px">
                  <h1> Federal University Otuoke</h1>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form" style="margin:0px">
          <div>
            <h1>E - Progress</h1>
          </div>
          <section class="login_content" style="margin:0px" >
            <form action="" method="POST" enctype="multipart/form-data">
              <h1>Create Account</h1>
              <p style="color:red"><?php if(isset($Msg)){ echo $Msg; } ?></p>
              <p style="color:green"><?php if(isset($Success)){ echo $Success; } ?></p>
              <div>
                <input type="text" class="form-control" name="first_name" placeholder="Firstname" />
              </div>
              <div>
                <input type="text" class="form-control" name="last_name" placeholder="Lastname"  />
              </div>
              <div>
                <input type="text" class="form-control" name="email" placeholder="Email" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password"  />
              </div>
              <div>
                <input type="password" class="form-control" name="verifyPassword" placeholder="Verify Password" />
              </div>
              <div>
                <button type="submit" name="submit_signup" class="btn btn-default submit">Sign up</button>
              </div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>




              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
