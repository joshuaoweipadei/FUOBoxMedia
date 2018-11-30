<?php

function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if (is_ajax()) {

  require '../../database.php';

  if (isset($_POST["friend"]) && isset($_POST["userID"]) && isset($_POST['action']) && $_POST['action'] == 'send_friend') {
    if (!empty($_POST["friend"]) && !empty($_POST["userID"]) && !empty($_POST["action"])) {

      // Escape all $_POST variables to protect against SQL injections
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $userID = test_input($_POST["userID"]);
      $friend_Id = test_input($_POST["friend"]);

      if (is_numeric($userID) && is_numeric($friend_Id)) {
        // check if there both friends or not
        $sql2 = "SELECT * FROM friendship WHERE (receiver = '$userID' AND sender ='$friend_Id') OR (receiver = '$friend_Id' AND sender = '$userID')";
        $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        if ($query2) {
          if (mysqli_num_rows($query2) > 0) {
            echo "Request <br> Already Sent";

          }else {
            $sql3 = "SELECT * FROM myfriends WHERE (myId = '$userID' AND myfriends = '$friend_Id') OR (myId = '$friend_Id' AND myfriends = '$userID')";
            $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
            if ($query3) {
              if (mysqli_num_rows($query3) > 0) {
                echo "Already Friends";

              } else {
                $sql4 = "INSERT INTO friendship (sender, receiver) VALUES ('$userID', '$friend_Id')";
                $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                if ($query4) {
                  echo "Friend <br> Request Sent";
                }
              }
            }
          }
        }

      }
    }
  }
} else {
  header('location: /FUOBoxMedia/profile_page.php');
}


 ?>
