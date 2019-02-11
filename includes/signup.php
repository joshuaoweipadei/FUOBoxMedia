<?php

include ('../includes/database.php');

function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if (is_ajax()) {
  if (isset($_POST["fitnae"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST['username']) && isset($_POST['gender']) && isset($_POST['password']) && isset($_POST['verPassword'])) {
    if (!empty($_POST["fitnae"]) && !empty($_POST["lastname"]) && !empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["gender"]) && !empty($_POST["password"])) {

      // Escape all $_POST variables to protect against SQL injections
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $allError = $emailErr = $usernameErr = $passErr = $success = "";

      $firstname = test_input($_POST['fitnae']);
      $lastname = test_input($_POST['lastname']);
      $email = test_input($_POST['email']);
      $username = test_input($_POST['username']);
      $gender = test_input($_POST['gender']);
      $password = test_input($_POST['password']);
      $verPassword = test_input($_POST['verPassword']);
      $hash = test_input(md5(rand(0,1000000)));

      if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($gender) || empty($password) || empty($verPassword)) {
        echo 'Please fill out all required fields';

      } else {
        if (preg_match("/^[a-zA-Z]*$/", $firstname) && preg_match("/^[a-zA-Z]*$/", $lastname)) {
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email';

          } else {
            if (strlen($username) > 2) {
              if (strlen($password) >= 6) {
                if ($password != $verPassword) {
                  echo 'Passwords do not match';

                } else {
                  // Check if user with that email already exists
                  $sql = "SELECT * FROM users_account WHERE username='$username'";
                  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                  if (mysqli_num_rows($result) > 0) {
                    echo 'User with this username already exists';

                  } else {
                    $sqll = "SELECT * FROM users_account WHERE email='$email'";
                    $query = mysqli_query($conn, $sqll) or die(mysqli_error($conn));
                    if (mysqli_num_rows($query) > 0){
                      echo 'User with this email already exists';

                    } else {
                      $sql = "INSERT INTO users_account (first_name, last_name, gender, email, username, profile_img, password, hash, date_registered)
                              VALUES ('$firstname', '$lastname', '$gender', '$email', '$username', 'profiledefault.png', SHA('$password'), '$hash', CURTIME())";
                              mysqli_query($conn, $sql) or die(mysqli_error($conn));

                              //Send registration confirmation link (verify.php)
                              // $to      = $email;
                              // $from   = 'oweipadeijoshie@gmail.com';
                              // $subject = '<b>Account Verification</b>';
                              // $message_body = '
                              // Hello '.$firstname.' '.$lastname.',
                              //
                              // Thank you for signing up!
                              //
                              // Please click this link to activate your account:
                              //
                              // http://localhost/FUOBoxMedia/verify.php?email='.$email.'&hash='.$hash;
                              //
                              // mail( $to, $subject, $message_body, "From: $from\n" );
                              // $success = 'Registration successfully! Verification link has been sent to '.$email.', please verify your account by clicking on the link in the message!';

                              echo "Registration successfully";

                    }
                  }
                }
              }
            }
          }
        }
      }

     //  $std = array(
     //    'a' => $success,
     //    'b' => $emailErr,
     //    'c' => $usernameErr,
     //    'd' => $passErr,
     //    'e' => $allError,
     // );
     //
     // // $std = new stdClass();
     // // $std->success = $success;
     // //
     // echo json_encode($std);
     //
     //



    }
  }
}

?>
