<?php

// LIKES AND UNLIKES
// LIKES AND UNLIKES
// LIKES AND UNLIKES
function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if (is_ajax()) {

  include '../../includes/database.php';

  if (isset($_POST["userId"]) && isset($_POST["statusId"]) && isset($_POST["value"]) && isset($_POST['action']) && $_POST['action'] == 'likes_unlikes') {
    if (!empty($_POST["userId"]) && !empty($_POST["statusId"]) && !empty($_POST["value"]) && !empty($_POST["action"])) {

      // Escape all $_POST variables to protect against SQL injections
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $userID = test_input($_POST['userId']);
      $statusId = test_input($_POST['statusId']);
      $likeValue = test_input($_POST['value']);

      if (is_numeric($userID) && is_numeric($statusId) && preg_match("/^[a-zA-Z]*$/", $likeValue)) {
        $sql = "SELECT * FROM like_unlike WHERE userId = '$userID' AND statusId = '$statusId' AND like_value = '$likeValue'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($query) {
          if (mysqli_num_rows($query) > 0) {
            $sql2 = "DELETE FROM like_unlike WHERE userId = '$userID' AND statusId = '$statusId' AND like_value = '$likeValue'";
            $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
            if ($query2) {
              $sql3 = "SELECT * FROM like_unlike WHERE statusId = '$statusId' AND like_value = '$likeValue'";
              $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
              if ($query3) {
                if (mysqli_num_rows($query3) == 0) {
                  echo 0;
                } else {
                  echo mysqli_num_rows($query3);
                }
              }
            }
          } else {

            $sql6 = "SELECT * FROM like_unlike WHERE userId = '$userID' AND statusId = '$statusId'";
            $query6 = mysqli_query($conn, $sql6) or die(mysqli_error($conn));
            if ($query6) {
              if (mysqli_num_rows($query6) > 0) {
                $sql7 = "SELECT * FROM like_unlike WHERE statusId = '$statusId' AND like_value = '$likeValue'";
                $query7 = mysqli_query($conn, $sql7) or die(mysqli_error($conn));
                if ($query7) {
                  echo mysqli_num_rows($query7);
                }
              } else {
                $sql4 = "INSERT INTO like_unlike (userId, statusId, like_value) VALUES ('$userID', '$statusId', '$likeValue')";
                $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                if ($query4) {
                  $sql5 = "SELECT * FROM like_unlike WHERE statusId = '$statusId' AND like_value = '$likeValue'";
                  $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
                  if ($query5) {
                    if (mysqli_num_rows($query5) == 0) {
                      echo 0;
                    } else {
                      echo mysqli_num_rows($query5);
                    }
                  }
                }
              }
            }

          }
        }
      }

    }
  }  else {
    header('location: /FUOBoxMedia/index.php');
  }
} else {
  header('location: /FUOBoxMedia/index.php');
}




?>
