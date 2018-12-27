<?php
// if (!isset($_SESSION['Id'])) {
//
//   header('location: /FUOBoxMedia/index.php');
// }


  function is_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
  }

  if (is_ajax()) {

    include '../database.php';

    if (isset($_POST["commentId"]) && isset($_POST["comment"]) && isset($_POST["userId"]) && isset($_POST["userEmail"]) && isset($_POST['task']) && $_POST['task'] == 'adding_comment') {
      if (!empty($_POST["commentId"]) && !empty($_POST["comment"]) && !empty($_POST["userId"]) && !empty($_POST["userEmail"])) {

        // Escape all $_POST variables to protect against SQL injections
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        $commentId = test_input($_POST["commentId"]);
        $comment = test_input($_POST["comment"]);
        $userId = test_input((int)$_POST["userId"]);
        $userEmail = test_input($_POST["userEmail"]);

        $sql = "SELECT * FROM users_account WHERE Id = '$userId' AND email = '$userEmail'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($query) {
          if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_array($query);
            $user_id = $row['Id'];
            $user_first = $row['first_name'];
            $user_last = $row['last_name'];
            $user_name = $row['username'];
            $user_img = $row['profile_img'];

            $sql2 = "SELECT * FROM status_post WHERE status_id = '$commentId'";
            $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
            if ($query2) {
              if (mysqli_num_rows($query2) == 1) {

                if ($comment != null && strlen($comment) > 0) {
                  $sql3 = "INSERT INTO comments (statusId, userId, comment, date_commented) VALUES ('$commentId', '$userId', '$comment', NOW())";
                  $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

                  if ($query3) {
                    $last_inserted_id = $conn->insert_id;

                    $std = new stdClass();
                    $std->commentId = $commentId;
                    $std->comment = $comment;
                    $std->user_id = $user_id;
                    $std->user_first = $user_first;
                    $std->user_last = $user_last;
                    $std->user_name = $user_name;
                    $std->user_img = $user_img;
                    $std->comment_id = $last_inserted_id;

                    echo json_encode($std);
                  }

                }

              }
            }

          }
        }

    }
  }




  // TO FETCH COMMENTS
  if (isset($_POST['Id']) && isset($_POST['task']) && $_POST['task'] == "fetch_comment") {
    if (!empty($_POST['Id'])) {

      // Escape all $_POST variables to protect against SQL injections
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $commentId = test_input($_POST["Id"]);

    }
  }





  // TO FETCH COMMENTS
  if (isset($_POST['count_Id']) && isset($_POST['count']) && $_POST['count'] == "count_comment") {
    if (!empty($_POST['count_Id'])) {

      $statusId = $_POST['count_Id'];

      $sql = "SELECT * FROM comments WHERE statusId ='$statusId'";
      $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
      if ($query) {
        $count = mysqli_num_rows($query);

        echo $count;
      }
    }
  }



  // VALIDATION TO UPLOAD IMAGES WITH STATUS
  // if (isset($_FILES['fileUpload']["name"])) {
  //   $errors = $_FILES["images"]["error"];
  //   foreach ($errors as $key => $error) {
  //     if ($error == UPLOAD_ERR_OK) {
  //       if (($_FILES['images']['size'][$key] < 1001924) ) {
  //         $name = $_FILES["images"]["name"][$key];
  //         $ext = pathinfo($name, PATHINFO_EXTENSION);
  //         if ($ext == "gif" || $ext == "jpg" || $ext == "jpeg" || $ext == "png") {
  //           $name = explode("_", $name);
  //           $imagename = '';
  //           foreach ($name as $letter) {
  //             $imagename .= $letter;
  //
  //           }
  //           echo $imagename;
  //         } else {
  //           echo "bad";
  //         }
  //       } else {
  //         echo "size";
  //       }
  //       // move_uploaded_file($_FILES["images"]["tmp_name"][$key], "images/uploads/".$imagename);
  //     }
  //   }
  // }



} else {
  header('Location: /FUOBoxMedia/profile_page.php?tine');
}


 ?>
