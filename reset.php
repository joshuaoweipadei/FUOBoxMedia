<?php
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
include_once 'database.php';
session_start();




// Escape all $_GET variables to protect against SQL injections
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$email = test_input($_GET['email']);
$hash = test_input($_GET['hash']);

// Make sure email and hash variables aren't empty
if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) ){

    // Make sure user email with matching hash exist
    $sql = "SELECT * FROM users_account WHERE email='$email' AND hash='$hash'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ( mysqli_num_rows($result) == 0 ){
        $userMsg = "You have entered invalid URL for password reset!";

    }
} else {
    $userMsg = "Sorry, verification failed, try again!";

}
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
    .container-fluid{ margin: auto; overflow-x: hidden; }
    .major-row{ width:100%; overflow-x:hidden; margin: auto; }
    .header{ margin: 20px 0px 50px 0px; padding: 20px 0px; background:url(images/wallpapers/wallpaper7.jpg); background-repeat:
      no-repeat; background-size: cover; background-position: center; text-align: center; }
    .header h1{ color: #fff; font-weight: 700; font-size: 130%; }
    label{ font-size: 115%; width: 21%; }
    input{ height: 29px; font-size: 115%; padding: 0.9% 3px; margin: 5px 0px;background-color: #fff;color: #000;border: 2px solid grey; }
    input:hover{ background-color: grey; color: #fff; }
    .form button{ margin-top: 17px; padding: 0.2% 1.4%; font-size: 120%; font-weight: 600; }
  </style>
</head>

<body>
  <div class="container-fliud">
    <div class="row center-xs center-sm center-md center-lg major-row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="header">
            <h1>Choose Your New Password</h1>
          </div>
          <div class="form">
            <form action="reset_password.php" method="POST">
              <div>
                <label>New Password<span>*</span></label>
                <input type="password" name="newpassword" autocomplete="off"/>
                <br>
                <label>Verify New Password<span>*</span></label>
                <input type="password" name="comfirmpassword" autocomplete="off"/>
              </div>

              <p><?php if(isset($userMsg)) echo $userMsg; ?></p>

              <button type="submit" name="verifyPassword" class="btn btn-primary">Reset Password</button>
              <!-- This input field is needed, to get the email of the user -->
              <input type="hidden" name="email" value="<?= $email ?>">
              <input type="hidden" name="hash" value="<?= $hash ?>">


            </form>
          </div>



      </div>
    </div>
  </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
