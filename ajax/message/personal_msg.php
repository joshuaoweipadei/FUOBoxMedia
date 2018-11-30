<?php

// if (!isset($_SESSION['Id'])) {
//
//   header('location: /FUOBoxMedia/index.php');
// }

// SENDING MESSAGES
// SENDING MESSAGt
// SENDING MESSAG
function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if (is_ajax()) {

  require '../../database.php';

  if (isset($_POST["friend_id"]) && isset($_POST["userID"]) && isset($_POST['msg']) && isset($_POST['action']) && $_POST['action'] == 'send_message') {
    if (!empty($_POST["friend_id"]) && !empty($_POST["userID"]) && !empty($_POST["msg"]) && !empty($_POST["action"])) {

      // Escape all $_POST variables to protect against SQL injections
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $friend_Id = mysqli_real_escape_string($conn, $_POST['friend_id']);
      $userID = mysqli_real_escape_string($conn, $_POST['userID']);
      $message = mysqli_real_escape_string($conn, $_POST['msg']);

      if (is_numeric($userID) && is_numeric($friend_Id)) {
        if ($userID == $friend_Id) {
          echo "<div style='color:red'>You cannot send a message to yourself.</div>";
        } else {

          $sql= "SELECT * FROM myfriends WHERE (myId = '$userID' AND myfriends = '$friend_Id') OR (myId = '$friend_Id' AND myfriends = '$userID')";
          $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
          if ($query) {
            if (mysqli_num_rows($query) == 1) {

              $sql2 = "INSERT INTO messages (senderId, receiverId, message, date, sender_read, receiver_read)
                        VALUES ('$userID', '$friend_Id', '$message', CURTIME(), 'Yes', 'No')";
              $query2 = mysqli_query($conn, $sql2) or mysqli_error($conn);
              if ($query2) {
                $sql3 = "SELECT * FROM users_account WHERE Id = '$userID'";
                $query3 = mysqli_query($conn, $sql3) or mysqli_error($conn);
                if ($query3) {
                  $row = mysqli_fetch_array($query3);

                  echo "
                  <div class='chat'>
                    <div class='col-xs-3 col-sm-2 col-md-2 col-lg-2 pull-left'>
                      <div class='user-photo' style='margin-right'>
                        <img src='/FUOBoxMedia/uploaded_images/".$row['profile_img']."' alt='".$row['username']."'>
                      </div>
                    </div>
                    <div class='col-xs-9 pull-left send'>
                        <div class='heading'>
                            <a href='#'>".$row['first_name']." ".$row['last_name']."</a>
                            <span class='pull-right'>Just Now</span>
                        </div>
                        ".$_POST['msg']."
                    </div>
                  </div>
                  ";
                }

              } else {
                echo "string";
              }
            }
          }
        }
      }

    }
  }  else {
    header('location: /FUOBoxMedia/profile_page.php');
  }
} else {
  header('location: /FUOBoxMedia/profile_page.php');
}




?>
