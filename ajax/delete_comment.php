<?php



// delete comment
// delete comment
// delete comment
function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if (is_ajax()) {

  require '../includes/database.php';

  if (isset($_POST["StatusId"]) && isset($_POST['CommentId']) && isset($_POST['userId']) && isset($_POST['action']) && $_POST['action'] == 'delete_comment') {
    if (!empty($_POST["StatusId"]) && !empty($_POST["CommentId"]) && !empty($_POST["userId"]) && !empty($_POST["action"])) {

      // Escape all $_POST variables to protect against SQL injections
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $status_id = test_input($_POST['StatusId']);
      $comment_id = test_input($_POST['CommentId']);
      $user_id = test_input($_POST['userId']);

      $sql= "SELECT * FROM comments WHERE Id = '$comment_id' AND userId = '$user_id'";
      $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
      if ($query) {
        if (mysqli_num_rows($query) == 1) {
          if ($row = mysqli_fetch_array($query)) {
            $db_comment_id = $row['Id'];

            if ($comment_id == $db_comment_id) {
              $sql2 = "DELETE FROM comments WHERE Id = '$db_comment_id' AND userId = '$user_id'";
              $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
              if ($query2) {
                echo "Comment Deleted";
              }
            }
          }
        }
      }
    } else {
      // header('location: /FUOBoxMedia/profile_page.php');
    }
  }
} else {
  // header('location: /FUOBoxMedia/profile_page.php');
}




?>
