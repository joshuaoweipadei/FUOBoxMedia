<?php
session_start();

if (isset($_SESSION['Id']) && isset($_SESSION['email'])) {
  header('location: index.php');
}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Registration | Home of FUO</title>
  <meta name="description" content="">
  <meta name="author" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/custom/main.css">

  <!-- jQuery -->
  <script src="js/plugins/jquery/jquery-3.3.1.min.js"></script>
  <!-- parsleyJS file -->
  <script src="js/plugins/parsleyJS/parsley.min.js"></script>
  <style media="screen">
    #sign_up{
      background: #fff;
      padding: 30px 26px 35px 26px;
      border-radius: 4px;
      margin: auto;
      height: auto;
      box-shadow: 5px 4px 8px 5px #f2f2f2, 5px 6px 20px 5px #f2f2f2;
      margin-bottom: 200px;
    }
    #sign_up p{
      margin-bottom: 15px
    }
    #sign_up input{
      background: #fff;
      padding-top: 18px;
      padding-bottom: 18px;
      border: none;
      border-bottom: 1px solid #d1d1d1;
    }
    #sign_up input:focus{
      background: #f2f2f2;
      color: #595959;
    }
    #sign_up h5.acct_log a{
      font-size: 15px;
      font-weight: 600;
      color: #0000cc;
    }
    #sign_up h5.acct_log a:hover{
      color: #4d4dff;
      text-decoration: none;
    }
    #sign_up button.btn-success{
      padding-left: 23px;
      padding-right: 23px;
      font-size: 15px;
      font-weight: 500;
      font-family: arial;
      background: #ff0000;
      text-transform: capitalize;
      border-radius: 3px;
      border: none
    }
    #sign_up button.btn-success:hover{
      background: #b30000
    }
    #required{
      font-size: 15px;
      color: #ff0000
    }
    #firstnameErr,
    #lastnameErr,
    #emailErr,
    #usernameErr,
    #passwordErr{
      font-size: 12px;
      color: #ff0000
    }
    #message{
      font-size: 14px;
      padding: 19px 10px;
      color: #008000;
      margin: auto;
      text-align: justify;
    }
    .reg-account{
      font-size: 200%;
      font-weight: 500;
      font-style: normal;
      font-family: arial;
      color: #ff0000;
      margin: 20px 0 40px 0;
      text-align: center;
    }
    .reg-account span{
      font-size: 17px;
      color: #595959;
    }
    @media only screen and (max-width: 768px) {
      #sign_up{
        top: 30px;
        padding: 34px 2px 44px 2px;
      }
    }
  </style>
</head>

<body>
  <div class="top-header">
    <div class="pull-left">
      <ul class="nav nav-pills">
        <li style="margin-left:10px"><a href="index.php"><span class="logo-name"><i class="fa fa-th-large" style="font-size:26px"></i> <span style="color:#fff" >FUO</span><span style="color:rgba(185,0,255,0.9)">BoxMedia</span></span></a></li>
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
  </div>

  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4 class="reg-account">Create an account now and stay connected on campus! <br> <span>Federal University Otuoke | BoxMedia</span> </h4>

          <div class="col-md-8 col-lg-8 col-md-offset-2">
            <form id="sign_up" method="post">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fitnae">First Name: </label> <span id="required"> *</span>
                  <input type="text" id="fisrtname" name="fitnae" class="form-control" placeholder="Josh" required
                  data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup">
                  <span id="firstnameErr"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastname">Last Name: </label> <span id="required"> *</span>
                  <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Baye" required
                  data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup">
                  <span id="lastnameErr"></span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="username">Email: </label> <span id="required"> *</span>
                  <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required
                  data-parsley-type="email" data-parsley-trigger="keyup">
                  <span id="emailErr"></span>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="username">Choose Username: </label> <span id="required"> *</span>
                  <input type="text" id="username" name="username" class="form-control" placeholder="Username" required
                  data-parsley-length="[3,16]" data-parsley-trigger="keyup">
                  <span id="usernameErr"></span>
                </div>
              </div>
              <div class="col-md-12">
                <label>Gender :</label> <span id="required"> *</span>
                <p>
                  Male : <input type="radio" class="flat" name="gender" id="genderM" value="Male" checked="" required />
                  Female : <input type="radio" class="flat" name="gender" id="genderF" value="Female" />
                </p>
              </div>
              <div class="col-md-12">
                <br>
                <div class="form-group">
                  <label for="paasword">Password: </label> <span id="required"> *</span>
                  <input type="password" id="password" name="password" class="form-control" placeholder="Password" required
                  data-parsley-length="[6,16]" data-parsley-trigger="keyup">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fisrtname">Confirm Password: </label> <span id="required"> *</span>
                  <input type="password" id="confirm_password" name="verPassword" class="form-control" placeholder="Confirm Password" required
                  data-parsley-equalto="#password" data-parsley-trigger="keyup">
                  <span id="passwordErr"></span>
                </div>
              </div>

              <!-- Reg successfully message -->
              <div class="col-md-12">
                <div class="form-group">
                  <h1 id="message"></h1>
                </div>
              </div>
              <!-- end of Reg successfully message -->

              <div class="col-md-6">
                <h5 class="acct_log">Already have an Account | <a href="login.php">Login</a> </h5>
              </div>
              <div class="col-md-6">
                <div class="form-group pull-right">
                  <button type="submit" id="submit" name="submit" class="btn btn-success">Sign up</button>
                </div>
              </div>
              <div class="clearfix"></div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>


<!-- PARSLEY VALIDATION WITH AJAX -->
<script>
  $(document).ready(function(){
    $('#sign_up').parsley();

    $('#sign_up').on('submit', function(event){
      event.preventDefault();
      if ($('#sign_up').parsley().isValid()) {
        $.ajax({
          url: "includes/signup.php",
          method: "POST",
          data:$(this).serialize(),
          beforeSend:function(){
            $('#submit').attr('disabled', 'disabled');
            $('#submit').val('Submitting...');
          },
          success:function(data){
            $('#sign_up')[0].reset();
            $('#sign_up').parsley().reset();
            $('#submit').attr('disabled', false);
            $('#submit').val('submit');

            if (data == "Please fill out all required fields") {
              $('#firstnameErr').html(data);
              $('#lastnameErr').html(data);
              $('#emailErr').html(data);
              $('#usernameErr').html(data);
              $('#passwordErr').html(data);
            }
            if (data == "Invalid email" || data == "User with this email already exists") {
              $('#emailErr').html(data);
            }
            if (data == "Passwords do not match") {
              $('#passwordErr').html(data);
            }
            if (data == "User with this username already exists") {
              $('#usernameErr').html(data);
            }
            if (data == "Registration successfully") {
              $('#message').html("Registration successfully! A verification link has been sent to your email address, please verify your account by clicking on the link in below!");
            }

          }
        });
      }
    });
  });
</script>



</body>
</html>
