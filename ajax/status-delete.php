<?php

function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if (is_ajax()) {

  include '../includes/database.php';

  if (isset($_POST['task']) && $_POST['task'] == 'status_delete') {
    if (!empty($_POST["status_id"])) {

      require_once 'status.php';

      if (class_exists('Status')) {
        if (Status::delete($_POST['status_id'])) {
          $status_delete_id = $_POST['status_id'];

          // deleting all comments related to the status
          $sql_delete_status = "DELETE FROM comments WHERE statusId = '$status_delete_id'";
          $query_delete_status = mysqli_query($conn, $sql_delete_status) or die(mysqli_error($conn));
          if ($query_delete_status) {
            echo "true";
          }

          // deleting all the likes related to the status
          $sql_delete_status_like = "DELETE FROM like_unlike WHERE statusId = '$status_delete_id'";
          $query_delete_status_like = mysqli_query($conn, $sql_delete_status_like) or die(mysqli_error($conn));
          if ($query_delete_status_like) {
            echo "true";
          }

        }
      }

    }
  } else {
    header('Location: /FUOBoxMedia/profile_page.php?timeline');
  }
} else {
  header('Location: /FUOBoxMedia/profile_page.php?timeline');
}

 ?>
