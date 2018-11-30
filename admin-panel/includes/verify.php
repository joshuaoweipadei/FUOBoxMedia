<?php
/* Verifies registered user email, the link to this page
   is included in the register.php email message
*/
session_start();

include ('database.php');

// Escape all $_GET variables to protect against SQL injections
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Make sure email and hash variables aren't empty
if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash'])){

    $email = test_input($_GET['email']);
    $hash = test_input($_GET['hash']);

    // Select user with matching email and username, who hasn't verified their account yet (active = 0)
    $sql = "SELECT * FROM admin WHERE email='$email' AND hash='$hash' AND emailVerified=0";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) == 0 ){
        $_SESSION['msg'] = "Account has already been activated or the URL is invalid!";

        header("location: /myProject/admin-panel/page_404.php");
    } else {

        $_SESSION['msg'] = "Your account has been activated!";

        // Set the user status to active (active = 1)
        //  POSSIBLE SELF MISTAKE
        $sql = "UPDATE admin SET emailVerified = 1 WHERE email='$email'";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));

        header("location: /myProject/admin-panel/includes/success.php");
    }
} else {
    $_SESSION['msg'] = "Invalid parameters provided for account verification!";
    header("location: /myProject/admin-panel/page_403.php");
}
?>
