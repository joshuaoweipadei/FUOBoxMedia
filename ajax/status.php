<?php

include 'users.php';

class Status {
  //TO GET Status FROM THE DATABASE
  public static function getStatus( ){
    //to let it know its expecting an array and to output array
    $output = array();

    global $conn;
    $sql = "SELECT * FROM status_post ORDER BY status_id DESC";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if ($query) {
      if (mysqli_num_rows($query) > 0) {
        while ($statusRow = mysqli_fetch_object($query)) {
          $output[] = $statusRow;

        }
      }
    }
    return $output;
  }



  //TO INSERT COMMENTS INTO THE DATABASE
  public static function Insert($status, $userId){

    global $conn;

    // // Add slashes even with arrays
    // function addslashes_array($input_arr){
    //   if (is_array($input_arr)) {
    //     $tmp = array();
    //     foreach ($input_arr as $key1 => $value) {
    //       $tmp[$key1] = addslashes_array($value);
    //     }
    //     return $tmp;
    //   } else {
    //     return addslashes($input_arr);
    //   }
    // }
    //
    // $mainComment = addslashes_array(str_replace("\n" , "<br>", $comment));

    // $mainComment = addslashes(str_replace("\n" , "<br>", $comment));

    $sqll = "INSERT INTO status_post (userId, status, date_posted) VALUES('$userId', '$status', NOW())";
    $query = mysqli_query($conn, $sqll) or die(mysqli_error($conn));

    if ($query) {
      $last_inserted_id = $conn->insert_id;

      $std = new stdClass();
      $std->status_id = $last_inserted_id;
      $std->status = $status;
      $std->userId = (int)$userId;

      return $std;
    }
    return null;

  }



  //TO UPDATE COMMENTS IN THE DATABASE
  public static function update($data){

  }



  //TO DELETE COMMENTS FROM THE DATABASE
  public static function delete($statusId){

    global $conn;
    $sql = "DELETE FROM status_post WHERE status_id = '$statusId'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if($query){
      return true;
    }

    return null;

  }


}



 ?>
