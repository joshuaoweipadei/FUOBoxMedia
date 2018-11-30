<?php

function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

  if (is_ajax()) {

    include '../../database.php';

    // Escape all $_POST variables to protect against SQL injections
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    if (isset($_POST["userId"]) && isset($_POST["quote"]) && isset($_POST['action']) && $_POST['action'] == 'daily_quote') {
      if (!empty($_POST["userId"]) && !empty($_POST["quote"])) {

        $userId = test_input($_POST["userId"]);
        $quote = mysqli_real_escape_string($conn, $_POST["quote"]);

        if (is_numeric($userId)) {
          if (strlen($quote) > 2 && strlen($quote) < 255) {

            $sql = "SELECT * FROM quotes WHERE userId = '$userId'";
            $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            if ($query) {
              if (mysqli_num_rows($query) > 0) {
                $sql2 = "UPDATE quotes SET quote = '$quote' WHERE userId = '$userId'";
                $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                if ($query2) {
                  echo "<div class='alert alert-success alert-dismissible fade in' role='alert' style='background:#00004d; color:#fff; padding:7px 10px'>
                          <button style='color:#fff' type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:#fff'>×</span>
                          </button>
                          <strong>Whoops!</strong> You have just updated your daily status.
                        </div>";
                }
              } else {
                $sql3 = "INSERT INTO quotes (userId, quote, `time`) VALUES ('$userId', '$quote', NOW())";
                $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                if ($query3) {
                  echo "<div class='alert alert-success alert-dismissible fade in' role='alert' style='background:#00004d; color:#fff; padding:7px 10px'>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                          </button>
                          <strong>Good!</strong> You have uploaded your daily status.
                        </div>";

                }
              }

            }
          }
        }
      }
    }




    // delete daily quote
    if (isset($_POST["userId"]) && isset($_POST['action']) && $_POST['action'] == 'delete_quote') {
      if (!empty($_POST["userId"])) {

        $userId = test_input($_POST["userId"]);

        if (is_numeric($userId)) {
          $sql = "SELECT * FROM quotes WHERE userId = '$userId'";
          $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
          if ($query) {
            if (mysqli_num_rows($query) == 1) {
              $sql4 = "DELETE FROM quotes WHERE userId = '$userId'";
              $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
              if ($query4) {
                echo "<span style='color:red'>Quote deleted successfully.</span>";
              }
            }else {
              echo "<span style='color:#666666'>You have no sayings</span>";
            }
          }
        }
      }
    }




} else {
  header('Location: /FUOBoxMedia/profile_page.php?tine');
}


 ?>
