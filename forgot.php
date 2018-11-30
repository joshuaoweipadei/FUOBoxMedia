<?php
/* Reset your password form, sends reset.php password link */
include_once 'database.php';
session_start();

// Escape all $_POST variables to protect against SQL injections
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){

  $email = test_input($_POST['email']);

  if (isset($_POST['resetPassword'])) {

    if (empty($email)) {
      $userMsg = "Please enter your email address!";

    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $userMsg = "Invalid Email";

        } else {
          $sql = "SELECT * FROM users_account WHERE email='$email'";
          $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            if (mysqli_num_rows($result) == 0 ){
              // User doesn't exist
              $userMsg = "User with this email doesn't exist!";

            } else {
              // If user exists (num_rows != 0)
              $user = mysqli_fetch_array($result);
              // $user becomes array with user data

              $email = $user['email'];
              $hash = $user['hash'];
              $firstname = $user['first_name'];
              $lastname = $user['last_name'];



              //Send registration confirmation link (reset.php)
              $to      = $email;
              $from   = 'oweipadeijoshie@gmail.com';
              $subject = 'Password Reset Link ( Education center(FUO) )';
              $message_body = '
              Hello '.$firstname.' '.$lastname.',

              You have requested password reset!

              Please click this link to reset your password:

              http://localhost/FUOBoxMedia/reset.php?email='.$email.'&hash='.$hash;

              mail( $to, $subject, $message_body, "From: $from\n" );

              $userMsg = "<p>Good!! Please check your email <span>'$email'</span>"
              . " for a verification link to complete your password reset!</p>";

            }
          }
        }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="veiwport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="css/flexboxgrid.css">-->
  <title>Reset Your Password</title>

  <!--INTERNAL STYLE SHEET-->
  <style media="screen">
    .container-fluid{
      margin: auto;
      overflow-x: hidden;
    }
    .major-row{
      width:100%;
      overflow-x:hidden;
      margin: auto;
      text-align: center;
    }
    .header{
      margin: 20px 0px 50px 0px;
      padding: 20px 0px;
      background:url(images/wallpapers/wallpaper7.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }
    .header h1{
      color: #fff;
      font-weight: 700;
      font-size: 150%
    }
    label{
      font-size: 180%;
    }
    input{
      height: 40px;
      font-size: 120%;
      padding: 0.9% 3px;
      margin: 6px 0px;
      background-color: #fff;
      color: #000;
      border: 2px solid grey
    }
    input:hover{
        background-color: grey;
        color: #fff
    }
    p{
      font-size: 150%;
      color: red;
    }
    .form button{
      margin-top: 17px;
      padding: 0.2% 1.4%;
      font-size: 120%;
      font-weight: 600;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row center-xs center-sm center-md center-lg major-row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="header">
            <h1>Reset Your Password</h1>
          </div>
          <div class="form">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
              <div>
                <label>Email Address <span> * </span></label>
                <input type="email" name="email" placeholder="example@gmail.com"/><br>
                <p><?php if(isset($userMsg)) echo $userMsg; ?></p>
              </div>
              <button type="submit" name="resetPassword" class="btn btn-primary">Send</button>
            </form>
          </div>

      </div>
    </div>
  </div>
</body>
</html>
