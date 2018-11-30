<?php

function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if (is_ajax()) {

  include '../database.php';

  if (isset($_POST['task']) && $_POST['task'] == 'status_delete') {
    if (!empty($_POST["status_id"])) {

      require_once 'status.php';

      if (class_exists('Status')) {
        if (Status::delete($_POST['status_id'])) {
          echo "true";
        }
      }

      echo "false";

    }
  } else {
    header('Location: /myProject/profile_page.php?timeline');
  }
} else {
  header('Location: /myProject/profile_page.php?timeline');
}

 ?>
