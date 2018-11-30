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
  <title>particles.js</title>
  <meta name="description" content="particles.js is a lightweight JavaScript library for creating particles.">
  <meta name="author" content="Vincent Garreau" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" media="screen" href="css/particles/css/style.css">
  <link rel="stylesheet" href="css/custom/main.css">
  <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">
  <!-- <link href="css/plugins/bootstrap.min.css" rel="stylesheet"> -->

  <!-- NProgress -->
  <!-- <link href="admin-panel/vendors/nprogress/nprogress.css" rel="stylesheet"> -->
  <!-- iCheck -->
  <!-- <link href="admin-panel/vendors/iCheck/skins/flat/green.css" rel="stylesheet"> -->

  <!-- CSS INCLUDE -->
  <!-- <link rel="stylesheet" type="text/css" id="theme" href="css/plugins/theme-default.css"/> -->
  <link rel="stylesheet" href="css/plugins/bootstrap.min.css">
  <!-- EOF CSS INCLUDE -->

  <!-- jQuery -->
  <script src="admin-panel/vendors/jquery/dist/jquery.min.js"></script>
  <script src="js/plugins/parsleyJS/parsley.min.js"></script>

</head>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //if the sign in button is clicked
    if (isset($_POST['login'])) {
      require 'includes/signin.php';

    }
  }
 ?>
<body style="overflow-x:hidden">

<!-- count particles -->
<!-- <div class="count-particles">
  <span class="js-count-particles"></span> particles
</div> -->

<!-- particles.js container -->
<div id="particles-js">
  <div class="">
    <div class="">
      <div class="col-md-12" style="position:absolute; width:100%">

        <div class="login-containe">
          <div class="col-sm-2">

          </div>
          <div class="col-sm-8">
            <div class="log">
              <div class="login-box animated fadeInDown">
                <div class="col-sm-12">
                  <header id="header"><!--header-->
                    <div class="header-middle"><!--header-middle-->
                      <div class="" style="background:; padding-bottom:10px">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="logo pull-left text-center">
                              <div class="" style="padding-top:5px">
                                <a href="profile-page.php" style="color:#2f4f4f">
                                  <img src="images/logos/box-logo.png" class="logo-img" alt="logo" width="45" height="45">
                                  <h1 class="logo-name"><span style="color:orangered">E </span>- PROGRESS</h1><br>
                                  <h6 class="logo-motto">Essential minds for an excellent career</h6>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!--/header-middle-->
                  </header><!--/header-->
                </div>
                  <div class="login-logo"></div>
                  <div class="login-body">
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                      <form action="" class="form-horizontal" method="post">
                        <div class="form-group">
                          <div class="col-md-12">
                            <input type="text" name="email_username" class="form-control ooo" placeholder="Email or Username"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <input type="password" name="password" class="form-control ooo" placeholder="Password"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-6">
                            <a href="#" class="btn-link btn-block">Forgot your password?</a>
                          </div>
                          <div class="col-md-6">
                            <button type="submit" name="login" class="btn btn-info btn-block">Log In</button>
                          </div>
                        </div>
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
                      <div class="pull-left">
                          &copy; 2014 AppName
                      </div>
                      <div class="pull-right">
                        <a href="index.php">Home</a> |
                        <!-- <a href="#">About</a> |
                        <a href="#">Privacy</a> | -->
                        <a href="register.php">Sign Up</a>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-sm-2">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- PARSLEY VALIDATION WITH AJAX -->
<script>
  $(document).ready(function(){
    $('#sign_in').parsley();

    $('#sign_in').on('submit', function(event){
      event.preventDefault();
      if ($('#sign_in').parsley().isValid()) {
        $.ajax({
          url: "includes/signin.php",
          method: "POST",
          data:$(this).serialize(),
          beforeSend:function(){
            $('#submit').attr('disabled', 'disabled');
            $('#submit').val('Submitting...');
          },
          success:function(data){
            $('#sign_in')[0].reset();
            $('#sign_in').parsley().reset();
            $('#submit').attr('disabled', false);
            $('#submit').val('submit');

            $('#message').html(data);
          }
        });
      }
    });
  });
</script>



<!-- scripts -->
<!-- <script src="js/plugins/jquery/jquery.js"></script> -->
<script src="js/particles/particles.js"></script>
<script src="js/particles/js/app.js"></script>
<script>
  particlesJS.load('particles-js','js/particles/particles.json', function(){
    console.log('particles.json loading...');
  });
</script>




<!-- Bootstrap -->
<!-- <script src="admin-panel/vendors/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- iCheck -->
<!-- <script src="admin-panel/vendors/iCheck/icheck.min.js"></script> -->
<!-- Custom Theme Scripts -->
<!-- <script src="admin-panel/build/js/plugins/custom.js"></script> -->


</body>
</html>
