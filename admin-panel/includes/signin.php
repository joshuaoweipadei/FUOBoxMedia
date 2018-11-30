<?php
// //START SESSION

include ('includes/database.php');
// Escape all $_POST variables to protect against SQL injections
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$userMsgg = "";
// Escape email to protect against SQL injections
$email = test_input($_POST['email']);
$password = test_input($_POST['password']);

if (isset($email) && isset($password)) {
  if (empty($email) || empty($password)) {
    $userMsgg = "Please enter your Email and Password!";

  } else{
      $sql = "SELECT * FROM admin WHERE email = '$email' AND password = SHA('$password');";
      $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

      if (mysqli_num_rows($result) == 1) {
        //THE USER IS FOUND
        $user = mysqli_fetch_array($result);
        $userid = $user['Id'];
        $emailVerified = $user['emailVerified'];
        //CHECK IF THE USER HAS CLICKED ON THE VERIFICATION LINK ON THIER EMAIL
        if ($emailVerified == 0) {
          $userMsgg = "Account has not been verified! Please click on the verification link sent to your email.";
        } else {

          $ssql = "UPDATE admin SET active = 1 WHERE Id = $userid";
          mysqli_query($conn, $ssql) or die(mysqli_error($conn));

          $_SESSION['Id'] = $user['Id'];
          $_SESSION['first_name'] = $user['first_name'];
          $_SESSION['last_name'] = $user['last_name'];
          $_SESSION['email'] = $user['email'];
          $_SESSION['username'] = $user['username'];
          $_SESSION['active'] = $user['active'];
          $_SESSION['profile_img'] = $user['profile_img'];


          header("location: /myProject/admin-panel/index.php");
        }

      } else {
        $userMsgg = "You have entered a wrong Email or Password, try again!";
      }

    }
  }
