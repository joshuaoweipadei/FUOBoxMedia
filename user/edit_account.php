<?php
// // Check if user is logged in using the session variable
if (!isset($_SESSION['Id']) && !isset($_SESSION['email'])) {

  header('location: /FUOBoxMedia/index.php');

}else {
  //SESSION VARIABLE DECLARED
  // Makes it easier to read
  $userID = $_SESSION['Id'];
  $email = $_SESSION['email'];
  $active = $_SESSION['active'];
}

include_once 'includes/database.php';

?>


<!-- ACCOUNT EDIT -->
<!-- ACCOUNT EDIT -->
<!-- ACCOUNT EDIT -->
<?php
if (isset($_POST['update_account'])) {
  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $u_firstname = test_input($_POST['firstname']);
  $u_lastname = test_input($_POST['lastname']);
  $u_username = test_input($_POST['username']);

  if (isset($userID) && isset($email)) {
    if (empty($u_username)) {
      $errorUsername = "Choose a username!";
    } else {
      if (empty($u_firstname) || !preg_match("/^[a-zA-Z]*$/", $u_firstname)) {
        $errorFirst = "Firstname: Enter Name or Invalid Characters!";
      } else {
        if (empty($u_lastname) || !preg_match("/^[a-zA-Z]*$/", $u_lastname)) {
          $errorLast = "Lastname: Enter Name or Invalid Characters!";
        } else {
          if (strlen($u_firstname) < 3) {
            $errorFirst = "Minimum 3 Characters!";
          } else {
            if (strlen($u_lastname) < 3) {
              $errorLast = "Minimumm 3 Characters!";
            } else {
              if (strlen($u_username) < 3) {
                $errorUsername = "Username: At least 3 Characters";
              } else {

                // Check if user with that email already exists
                $sql = "SELECT * FROM users_account WHERE Id = '$userID' AND email = '$email'";
                $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if ($query) {
                  if (mysqli_num_rows($query) == 1) {
                    $row = mysqli_fetch_array($query);
                    $dbh_username = $row['username'];
                    if ($u_username == $dbh_username) {
                      $errorUsername = "That's your username already.";
                    } else {
                      // check the database if the username has already been taken
                      $sql2 = "SELECT * FROM users_account WHERE username = '$u_username'";
                      $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                      if ($query2) {
                        if (mysqli_num_rows($query2) > 0) {
                          $errorUsername = "username already taken.";
                        }else {

                          $update_user_sql = "UPDATE users_account SET first_name = '$u_firstname', last_name = '$u_lastname', username = '$u_username'
                                              WHERE Id = '$userID' AND email = '$email'";
                          $update_user_query = mysqli_query($conn, $update_user_sql) or die(mysqli_error($conn));
                          if ($update_user_query) {
                            $successMsg = "Your account informations has successfully been updated!";
                          }
                        }

                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}
?>
<!-- END OF ACCOUNT EDIT -->


<!-- RESET PASSWORD -->
<!-- RESET PASSWORD -->
<!-- RESET PASSWORD -->
<?php
if (isset($_POST['reset_password'])) {
  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $oldPassword = test_input($_POST['oldpassword']);
  $newPassword = test_input($_POST['newpassword']);
  $verifyPassword = test_input($_POST['verifypassword']);

  // extra precautions
  if (isset($oldPassword) && isset($newPassword) && isset($verifyPassword) && isset($userID) && isset($email)) {
    if (empty($oldPassword) || empty($newPassword) || empty($verifyPassword)) {
      $errorOld = "Enter Current Password";
      $errorNew = "Enter New Password";
      $errorConfirm = "Enter New Password Again";
    } else {
      $sql_pass = "SELECT * FROM users_account WHERE password = SHA('$oldPassword') AND Id = '$userID' AND email = '$email'";
      $query_pass = mysqli_query($conn, $sql_pass) or die(mysqli_error($conn));
      if ($query_pass) {
        if (mysqli_num_rows($query_pass) == 1) {
          if (strlen($newPassword) < 6) {
            $errorNew = "weak password choosen.";
          } else {
            if ($newPassword == $verifyPassword) {
              $sql_update_pass = "UPDATE users_account SET password = SHA('$newPassword') WHERE Id = '$userID' AND email = '$email'";
              $query_update_pass = mysqli_query($conn, $sql_update_pass) or die(mysqli_error($conn));

              if ($query_update_pass) {
                $reset_pass_success = "Password successfully changed.";
              }

            } else {
              $errorConfirm = "New passwords don't Match.";
            }
          }
        } else {
          $errorOld = "Your current password is wrong.";
        }
      }
    }
  }
}
?>
<!-- END OF RESET PASSWORD -->


<?php
$sql = "SELECT * FROM users_account WHERE Id = '$userID' AND email = '$email'";
$fetch_user = mysqli_query($conn, $sql) or die(mysqli_error($conn));
if ($fetch_user) {
  if ($row_ = mysqli_fetch_array($fetch_user)) {

  }
}
?>

<style media="screen">
/*
*
*  EDIT ACCOUNT SECTION
*
*/
#edit_account{
  background: #fff;
  margin-bottom: 74%;
}
#reset_password{
  background: #fff;
  margin-bottom: 111%;
}
#delete_account{
  background: #fff;
}
.edit_form{
  background: #fff
}
.edit_form h2{
  font-size: 170%;
  font-weight: bold;
  text-transform: uppercase;
  color: #262626
}
.edit_form form .form-group label{
  color: #666666;
  font-size: 14px
}
.edit_form form .form-group span{
  color: #ff6666;
  font-size: 14px
}

</style>

 <div id="edit_account">
   <div class="col-md-8 col-sm-offset-1" id="a">
     <div class="edit_form"><!--login form-->
       <h2>EDIT ACCOUNT</h2>
       <?php if(isset($successMsg)) {
         echo "<div class='alert alert-success alert-dismissible fade in' role='alert' style='background:#c2f0c2; color:#248f24; padding:8px 10px'>
             <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
             </button>
             <strong>$successMsg</strong>
           </div>" ;
       } ?>
       <br>
         <form action="#a" method="POST">
           <div class="form-group">
             <label for="firstname">First Name: <i class="fa fa-edit"></i></label>
             <input type="text" name="firstname" class="form-control" value="<?php echo $row_['first_name']; ?>" style="width:80%"/>
             <span><?php if(isset($errorFirst)){ echo $errorFirst;} ?></span>
           </div>

           <div class="form-group">
             <label for="lastname">Last Name: <i class="fa fa-edit"></i></label>
             <input type="text" name="lastname" class="form-control" value="<?php echo $row_['last_name']; ?>" style="width:80%"/>
             <span><?php if(isset($errorLast)){ echo $errorLast;} ?></span>
           </div>

           <div class="form-group">
             <label for="email">Email: <i class="fa fa-lock"></i></label>
             <input type="email" class="form-control" value="<?php echo $row_['email']; ?>" disabled style="width:80%; font-weight:600"/>
           </div>

           <div class="form-group">
             <label for="">Choose a Username: <i class="fa fa-edit"></i></label>
             <input type="text" name="username" class="form-control" value="<?php echo $row_['username']; ?>" style="width:80%"/>
             <span><?php if(isset($errorUsername)){ echo $errorUsername;} ?></span>
           </div>

           <div class="form-group">
             <label for="gender">Gender: <i class="fa fa-lock"></i></label>
             <select disabled class="form-control" style="width:80%; font-weight:600" >
               <option> <?php echo $row_['gender']; ?> </option>
             </select>
           </div>

           <button type="submit" name="update_account" class="btn btn-success">Save Changes</button>
         </form>
     </div><!--/login form-->
   </div>
 </div>


 <!-- RESET PASSWORD -->
 <div id="reset_password">
   <div class="col-md-8 col-sm-offset-1" id="b">
     <div class="edit_form"><!--login form-->
       <h2>RESET PASSWORD</h2>
       <?php if(isset($reset_pass_success)) {
         echo "<div class='alert alert-success alert-dismissible fade in' role='alert' style='background:#c2f0c2; color:#248f24; padding:8px 10px'>
             <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
             </button>
             <strong>$reset_pass_success</strong>
           </div>" ;
       } ?>
       <br>
         <form action="#b" method="POST">
           <div class="form-group">
             <label for="oldpassword">Old Password:</label>
             <input type="password" name="oldpassword" class="form-control" style="width:80%"/>
             <span><?php if(isset($errorOld)){ echo "<i class='fa fa-asterisk' style='color:red; font-size:10px'></i> ".$errorOld;} ?></span>
           </div>

           <div class="form-group">
             <label for="newpassword">New Password:</label>
             <input type="password" name="newpassword" class="form-control" style="width:80%"/>
             <span><?php if(isset($errorNew)){ echo "<i class='fa fa-asterisk' style='color:red; font-size:10px'></i> ".$errorNew;} ?></span>
           </div>

           <div class="form-group">
             <label for="verifypassword">Confirm New Password:</label>
             <input type="password" name="verifypassword" class="form-control" style="width:80%"/>
             <span><?php if(isset($errorConfirm)){ echo "<i class='fa fa-asterisk' style='color:red; font-size:10px'></i> ".$errorConfirm;} ?></span>
           </div>

           <button type="submit" name="reset_password" class="btn btn-success">Reset Password</button>
         </form>

     </div><!--/login form-->
   </div>
 </div>



 <div id="delete_account">
   <div class="col-md-8 col-sm-offset-1">
     <div class="edit_form"><!--login form-->
       <h2>DELETE ACCOUNT</h2>
       <br>
       <a href="user/delete_account.php" class="btn btn-default" style="margin-bottom:24px; color:#ff0000">Delete Account</a>
     </div><!--/login form-->
   </div>
 </div>
<!-- END OF DELETE ACCOUNT -->


<div class="col-md-8 col-sm-offset-1" style="margin-bottom:50px">
  <div class="alert alert-warning" style="background:#ff8080; color:#fff">
    <h4><i class="fa fa-warning" style="color:#ff0000"></i> Delete Warning!</h4> Apparently, Deleted accounts can not be accessed anymore. Please decide wisely before deleting your account.
    Our <a href="" class="alert-link">Support Service</a> can not retrieve any already deleted account. Thank You!
  </div>
</div>
