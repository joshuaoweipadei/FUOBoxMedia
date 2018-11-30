<?php

class Users {

  public static function getUsers($userId){

    global $conn;
    $sql = "SELECT username, profile_img FROM users_account WHERE Id = '$userId'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($query) {
      if (mysqli_num_rows($query) == 1) {
        return mysqli_fetch_object($query);
      }
    }
    return null;
  }
}




 ?>
