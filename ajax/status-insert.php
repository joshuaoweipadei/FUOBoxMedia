<?php

function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

  if (is_ajax()) {

    include '../includes/database.php';

    if (isset($_POST["status"]) && isset($_POST["userId"]) && isset($_POST["userEmail"]) && isset($_POST['task']) && $_POST['task'] == 'status_insert') {
      if (!empty($_POST["status"]) && !empty($_POST["userId"]) && !empty($_POST["userEmail"])) {

        // Escape all $_POST variables to protect against SQL injections
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        $status = test_input($_POST["status"]);
        $userId = test_input((int)$_POST["userId"]);
        $userEmail = test_input($_POST["userEmail"]);

        $sql = "SELECT * FROM users_account WHERE Id = '$userId' AND email = '$userEmail'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($query) {
          if (mysqli_num_rows($query) == 1) {


            $std = new stdClass();
            $std->user = null;
            $std->status = null;

            //requiring the comment.php class has the subscriber.php class in it
            //so it is requiring two classes here
            require_once 'status.php';


            if (class_exists('Status') && class_exists('Users')) {

              $userInfo = Users::getUsers($userId);
              if ($userInfo == null) {
                $std->error = true;
              }
                //if ($realUserID == null) {
                //  $std->error = true;
                //}
              $commentInfo = Status::Insert($status, $userId);
              if ($commentInfo == null) {
                $std->error = true;
              }

              $std->user = $userInfo;
              $std->status = $commentInfo;
            }

          echo json_encode($std);
          }
        }

    }

  } else {
    header('Location: /FUOBoxMedia/profile_page.php?timline');
  }
} else {
  header('Location: /FUOBoxMedia/profile_page.php?timline');
}


 ?>
