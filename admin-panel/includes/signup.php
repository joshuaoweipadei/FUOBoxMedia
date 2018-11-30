<?php

include ('includes/database.php');

// Escape all $_POST variables to protect against SQL injections
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $firstname = test_input($_POST['first_name']);
    $lastname = test_input($_POST['last_name']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $comfirmPassword = test_input($_POST['verifyPassword']);
    $hash = test_input(md5(rand(0,1000000)));


    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($comfirmPassword)) {
      $Msg = 'Please fill out all fields';
      // $Msg = $hash;
    } else {
      if (!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)) {
        $Msg = 'Invalid Name Character';
      } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $Msg = 'This '.$email.' is Invalid!';
        } else {
          if (strlen($password) <= 7) {
            $Msg = "Password too Weak, Min. of 8 Character.";
          } else {
            if ($password != $comfirmPassword) {
              $Msg = "Password don't Match.";
            } else {
              $sql = "SELECT * FROM admin WHERE email='$email'";
              $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
              if ($query) {
                if (mysqli_num_rows($query) > 0) {
                  $Msg = 'User with this Email('.$email.') already exists!';
                } else {
                  $sql2 = "INSERT INTO admin (first_name, last_name, email, password, hash, profile_img, date_registered)
                           VALUES ('$firstname', '$lastname', '$email', SHA('$password'), '$hash', 'profiledefault.png', NOW())";
                  $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                  if ($query2) {

                     //Send registration confirmation link (verify.php)
                     $to      = $email;
                     $from   = 'oweipadeijoshie@gmail.com';
                     $subject = '<b>Account Verification</b>';
                     $message_body = '
                     Hello '.$firstname.' '.$lastname.',

                     Thank you for signing up!

                     Please click this link to activate your account:

                     http://localhost/myProject/admin-panel/includes/verify.php?email='.$email.'&hash='.$hash;

                     if (mail( $to, $subject, $message_body, "From: $from\n" )) {
                       $Success = '<h4 style="font-size:18px; font-weight:arial">Registration successfully!</h4>
                                  <span style="font-size:13px">Click on the click sent to your email to activate your admin account.</span>';
                     }
                  }
                }
              }
            }
          }



            //  $Msg = "Password don't match";
            //}
            //$Msg = "good";
          //}
      }
    }
  }

?>
