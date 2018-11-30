<?php
// 
// if (!isset($_SESSION['Id'])) {
//
//   header('location: /myProject/index.php');
//
// }

// delete friend request
// delete friend request
// delete friend request
function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if (is_ajax()) {

  require '../../database.php';

  if (isset($_POST["friend_id"]) && isset($_POST["userID"]) && isset($_POST['action']) && $_POST['action'] == 'delete_request') {
    if (!empty($_POST["friend_id"]) && !empty($_POST["userID"]) && !empty($_POST["action"])) {

      // Escape all $_POST variables to protect against SQL injections
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $acceptFriend_Id = test_input($_POST['friend_id']);
      $userID = test_input($_POST['userID']);

      $sql= "SELECT * FROM friendship WHERE (receiver = '$userID' AND sender = '$acceptFriend_Id') OR (receiver = '$acceptFriend_Id' AND sender = '$userID')";
      $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
      if ($query) {
        if (mysqli_num_rows($query) == 1) {

          $sql3 = "DELETE FROM friendship WHERE (receiver = '$userID' AND sender = '$acceptFriend_Id') OR (receiver = '$acceptFriend_Id' AND sender = '$userID')";
          $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
          if ($query3) {
            echo "Declined";
          }

        } else {
          header('location: /myProject/profile_page.php');
        }
      }
    }
  }
} else {
  header('location: /myProject/profile_page.php');
}




?>
