<?php
// //START SESSION

// Escape all $_POST variables to protect against SQL injections
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$userMsgg = "";
// Escape email to protect against SQL injections
$emailUsername = test_input($_POST['email_username']);
$password = test_input($_POST['password']);

if (isset($emailUsername) && isset($password)) {
  if (empty($emailUsername) || empty($password)) {
    $userMsgg = "Please enter your Email and Password!";

  } else{
      $sql = "SELECT * FROM users_account WHERE (email = '$emailUsername' OR username = '$emailUsername') AND password = SHA('$password');";
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

          $ssql = "UPDATE users_account SET active = 1 WHERE Id=$userid";
          mysqli_query($conn, $ssql) or die(mysqli_error($conn));

          $_SESSION['Id'] = $user['Id'];
          $_SESSION['first_name'] = $user['first_name'];
          $_SESSION['last_name'] = $user['last_name'];
          $_SESSION['email'] = $user['email'];
          $_SESSION['username'] = $user['username'];
          $_SESSION['active'] = $user['active'];
          $_SESSION['profile_img'] = $user['profile_img'];


          // This is how we'll know the user is logged in
          //$_SESSION['logged_in'] = true;


          header("location: index.php");
        }

      } else {
        $userMsgg = "You have entered a wrong Email or Password, try again!";
      }

    }
  }
