<?php

function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

  if (is_ajax()) {

    include '../../includes/database.php';

    if (isset($_POST["uniqueid"]) && isset($_POST["news_comment"]) && isset($_POST["userID"]) && isset($_POST['action']) && $_POST['action'] == 'news_comment') {
      if (!empty($_POST["uniqueid"]) && !empty($_POST["news_comment"]) && !empty($_POST["userID"])) {

        // Escape all $_POST variables to protect against SQL injections
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        $newsUniqueNo = test_input($_POST["uniqueid"]);
        $userId = test_input($_POST["userID"]);
        $NewsComment = test_input($_POST["news_comment"]);

        if (is_numeric($newsUniqueNo) && is_numeric($userId)) {

          $sql = "INSERT INTO news_comments (userId, unique_no, comment, `time`)
                  VALUES ('$userId', '$newsUniqueNo', '$NewsComment', NOW())";
          $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
          if ($query) {
            $sql2 = "SELECT * FROM users_account WHERE Id = '$userId'";
            $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
            if ($query2) {
              if (mysqli_num_rows($query2) == 1) {
                $row = mysqli_fetch_array($query2);

                echo "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                  </button>
                  <strong>".$row['first_name']." ".$row['last_name']."!</strong> You've added a comment just now.
                </div>";
              }
            }
          }

        }
      }
    }




    // TO INSERT AND FETCH NEWS LIKES
    if (isset($_POST['news_id']) && isset($_POST['action']) && $_POST['action'] == "news_likes") {

      // Escape all $_POST variables to protect against SQL injections
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $newsUniqueNo = test_input($_POST['news_id']);

      if (is_numeric($newsUniqueNo)) {

        function getIp() {
          $ip = $_SERVER['REMOTE_ADDR'];

          if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
          } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }
          return $ip;
        }

        $ip_address = getIp();

        $sql = "SELECT * FROM news_likes WHERE news_unique_no = '$newsUniqueNo' AND ip_address = '$ip_address'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($query) {
          if (mysqli_num_rows($query) == 1) {

            $sql4 = "DELETE FROM news_likes WHERE news_unique_no = '$newsUniqueNo' AND ip_address = '$ip_address'";
            $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
            if ($query4) {

              $sql5 = "SELECT * FROM news_likes WHERE news_unique_no = '$newsUniqueNo' AND ip_address = '$ip_address'";
              $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
              if ($query5) {
                $count = mysqli_num_rows($query5);

                $status = 0;

                echo json_encode($status);
              }
            }

          } else {

            $sql2 = "INSERT INTO news_likes (news_unique_no, ip_address) VALUES ('$newsUniqueNo', '$ip_address')";
            $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
            if ($query2) {

              $sql3 = "SELECT * FROM news_likes WHERE news_unique_no = '$newsUniqueNo' AND ip_address = '$ip_address'";
              $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
              if ($query3) {
                $count = mysqli_num_rows($query3);

                $status = 1;

                echo json_encode($status);
              }
            }

          }
        }
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



} else {
  header('Location: /FUOBoxMedia/index.php?tine');
}


 ?>
