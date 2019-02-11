<?php
session_start();

// // Check if user is logged in using the session variable
if (!isset($_SESSION['Id']) && !isset($_SESSION['email'])) {

  header('location: /FUOBoxMedia/index.php');

}else {
  //SESSION VARIABLE DECLARED
  // Makes it easier to read
  $userID = $_SESSION['Id'];
  $email = $_SESSION['email'];
  $active = $_SESSION['active'];
}

include_once 'includes/database.php';

?>

<?php
if (isset($_GET['status-post-id'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $status_post_Id = test_input($_GET['status-post-id']);

  if (is_numeric($status_post_Id)) {
    $sql = "SELECT * FROM status_post WHERE status_id = '$status_post_Id'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if ($query) {
      if (mysqli_num_rows($query) == 1) {
        if ($statusRow = mysqli_fetch_array($query)) {
          $status_id = $statusRow['status_id'];
          $status_owner_id = $statusRow['userId'];
          $status_post = $statusRow['status'];
          $status_date = $statusRow['date_posted'];

          date_default_timezone_set("Africa/Lagos");
          $dateTime = strtotime($status_date);
            $date = date('d', $dateTime);
            $month = date('m', $dateTime);
            $year = date('y', $dateTime);
            $time_t = date('H:i a', $dateTime);

            switch ($month) {
                case "1":
                    $CurrentMonth = "January";
                    break;
                case "2":
                    $CurrentMonth = "Feb";
                    break;
                case "3":
                    $CurrentMonth = "Mar";
                    break;
                case "4":
                    $CurrentMonth = "Apr";
                    break;
                case "5":
                    $CurrentMonth = "May";
                    break;
                case "6":
                    $CurrentMonth = "Jun";
                    break;
                case "7":
                    $CurrentMonth = "Jul";
                    break;
                case "8":
                    $CurrentMonth = "Aug";
                    break;
                case "9":
                    $CurrentMonth = "Sep";
                    break;
                case "10":
                    $CurrentMonth = "Oct";
                    break;
                case "12":
                    $CurrentMonth = "Nov";
                    break;
                default:
                    $CurrentMonth = "Dec";
            }


            date_default_timezone_set("Africa/Lagos");
            $time_ago = strtotime($status_date);
            $time = time() - $time_ago;

            switch($time):
              // seconds
              case $time <= 60;
              $ago =  'Just now';
              break;

              // minutes
              case $time >= 60 && $time < 3600;
              if (round($time/60) == 1) {
                $ago = 'a minute';
              } else {
                $ago = round($time/60).' minutes ago';
              }
              break;

              // hour
              case $time >= 3600 && $time < 86400;
              if (round($time/3600) == 1) {
                $ago = 'an hour ago';
              } else {
                $ago = round($time/3600).' hours ago';
              }
              break;

              // days
              case $time >= 86400 && $time < 604800;
              if (round($time/86400) == 1) {
                $ago = 'a day ago';
              } else {
                $ago = round($time/86400).' days ago';
              }
              break;

              // weeks
              case $time >= 604800 && $time < 2600640;
              if (round($time/604800) == 1) {
                $ago = $time_t." ".$CurrentMonth." ".$date." 20".$year;
              } else {
                $ago = $time_t." ".$CurrentMonth." ".$date." 20".$year;
              }
              break;

              // months
              case $time >= 2600640 && $time < 31207680;
              if (round($time/2600640) == 1) {
                $ago = $time_t." ".$CurrentMonth." ".$date." 20".$year;
              } else {
                $ago = $time_t." ".$CurrentMonth." ".$date." 20".$year;
              }
              break;

              // years
              case $time >= 31207680;
              if (round($time/31207680) == 1) {
                $ago = $time_t." ".$CurrentMonth." ".$date." 20".$year;
              } else {
                $ago = $time_t." ".$CurrentMonth." ".$date." 20".$year;
              }
              break;
            endswitch;


          // getting the user details who uploaded the status
          $sql2 = "SELECT * FROM users_account WHERE Id = '$status_owner_id'";
          $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
          if ($query2) {
            if (mysqli_num_rows($query2) == 1) {
              if ($status_owner = mysqli_fetch_array($query2)) {
                $status_owner_firstname = $status_owner['first_name'];
                $status_owner_lastname = $status_owner['last_name'];
                $status_owner_img = $status_owner['profile_img'];
              }
            }
          }

        }
      } else {
        echo "not == 1";
      }
    }

  } else {
    header('location: /FUOBoxMedia/profile_page.php');
  }


}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FUOBoxMedia | Timeline show</title>
    <link rel="stylesheet" href="css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">

    <!-- light-box -->
    <link rel="stylesheet" type="text/css" href="css/plugins/jquery.fancybox.css" media="screen" />

    <!-- custom css -->
    <link rel="stylesheet" href="css/custom/main.css">
    <link rel="stylesheet" href="css/custom/timeline.css">

    <!-- Begin emoji-picker Stylesheets -->
    <link href="assets/emoji/lib/css/emoji.css" rel="stylesheet">
    <!-- End emoji-picker Stylesheets -->
  </head>
  <body>
    <div class="top-header">
      <div class="pull-left">
        <ul class="nav nav-pills">
          <li style="margin-left:10px"><a href="index.php"><span class="logo-name"><i class="fa fa-th-large" style="font-size:26px"></i> <span style="color:#fff" >FUO</span><span style="color:rgba(185,0,255,0.9)">BoxMedia</span></span></a></li>
        </ul>
      </div>
      <div class="pull-right">
        <ul class="nav nav-pills">
          <?php
            if (!isset($_SESSION['Id'])) {
              echo "<li><a href='register.php'><i class='fa fa-plus-square'></i> Register</a></li>";
            }
           ?>
           <?php
             if (isset($_SESSION['Id'])) {
               echo "<li><a href='logout.php'><i class='fa fa-sign-out'></i> Log out</a></li>";
             } else {
               echo "<li><a href='login.php'><i class='fa fa-sign-in'></i> Log in</a></li>";
             }
            ?>
        </ul>
      </div>
      <div class="clearfix"></div>
    </div>


    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <a href="javascript:history.back()" style="border:none; margin:8px 1px; color:rgba(93,84,240,8.5)" class="btn btn-default"> <i class="fa fa-arrow-left"></i> Go back</a>
        </div>
        <div class="col-md-12">
          <div class="comments-list">
            <ul class="comments-holder-ul">
              <li class="comment-holder timeline-item" id="del_status_<?php echo $status_id; ?>">
                <div class="status-id" id="<?php echo $status_id; ?>"></div>

                <div class="container-area" style="padding-bottom:10px; padding-top:10px">
                  <!--USER IMAGE-->
                  <div class="user-img">
                    <a>
                      <img src="images/uploaded_images/profile_photos/<?php echo $status_owner_img; ?>" class="user-img-pic" alt="upload picture">
                    </a>
                  </div>
                  <div class="comment-body">
                    <!--USER NAME-->
                    <h3 class="username-field">
                      <a href="friend_profile.php?friend_id=<?php echo $status_owner_id; ?>"> <?php echo $status_owner_firstname." ".$status_owner_lastname; ?> </a>
                    </h3>
                    <!--USER COMMENT-->
                    <div class="comment-text">
                      <p><?php echo $status_post; ?></p>
                    </div>

                    <div class="date">
                      <span> <i class="fa fa-globe"></i> | </span>
                      <span class="everyone">Everyone <i class="fa fa-eye"></i> </span>
                      <span class="pull-right" style="color:#c1c1c1"> <i class="fa fa-clock-o"></i> <?php echo $ago; ?> </span>
                      <?php if( $userID == $status_owner_id): ?>
                        <div class="comment-button-holder">
                          <ul>
                            <li class="delete-btn" id="<?php echo $status_id; ?>" title="Remove Status"><i class="fa fa-times"></i> Remove Status</li>
                          </ul>
                        </div>
                      <?php endif; ?>
                    </div>

                    <div class="clearfix"></div>

                    <!--comment footer-->
                    <div class="timeline-footer">
                      <div class="">
                        <span class="likes">
                          <i class="fa fa-comment" style="font-size:17px; color:#009900;"></i>
                          <span id="comment_count_<?php echo $status_id ?>" style="font-size:16px; color:#6a6a6a; font-family:cursive"></span>
                        </span>

                        <span class="likes">
                          <button class="like" id="<?php echo $status_id; ?>" value="thumbsUp" title="thumbsUp">
                            <i class="fa fa-thumbs-o-up emoji"></i>
                              <span id="thumbsUp_<?php echo $status_id; ?>">
                                <?php
                                  $sql = "SELECT * FROM like_unlike WHERE statusId = '$status_id' AND like_value = 'thumbsUp'";
                                  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                  if ($query) {
                                    echo mysqli_num_rows($query);
                                  }
                                ?>
                              </span>
                          </button>
                        </span>

                        <span class="likes">
                          <button class="like" id="<?php echo $status_id; ?>" value="thumbsDown" title="thumbsDown">
                            <i class="fa fa-thumbs-o-down emoji"></i>
                              <span id="thumbsDown_<?php echo $status_id; ?>">
                                <?php
                                  $sql = "SELECT * FROM like_unlike WHERE statusId = '$status_id' AND like_value = 'thumbsDown'";
                                  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                  if ($query) {
                                    echo mysqli_num_rows($query);
                                  }
                                ?>
                              </span>
                          </button>
                        </span>

                        <span class="likes">
                          <button class="like" id="<?php echo $status_id; ?>" value="frown" title="Frown">
                            <i class="fa fa-meh-o emoji"></i>
                              <span id="frown_<?php echo $status_id; ?>">
                                <?php
                                  $sql = "SELECT * FROM like_unlike WHERE statusId = '$status_id' AND like_value = 'frown'";
                                  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                  if ($query) {
                                    echo mysqli_num_rows($query);
                                  }
                                ?>
                              </span>
                          </button>
                        </span>

                        <span class="likes">
                          <button class="like" id="<?php echo $status_id; ?>" value="smiles" title="Smiles">
                            <i class="fa fa-smile-o emoji"></i>
                              <span id="smiles_<?php echo $status_id; ?>">
                                <?php
                                  $sql = "SELECT * FROM like_unlike WHERE statusId = '$status_id' AND like_value = 'smiles'";
                                  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                  if ($query) {
                                    echo mysqli_num_rows($query);
                                  }
                                ?>
                              </span>
                          </button>
                        </span>

                        <span class="likes">
                          <button class="like" id="<?php echo $status_id; ?>" value="angry" title="Angry">
                            <i class="fa fa-frown-o emoji"></i>
                              <span id="angry_<?php echo $status_id; ?>">
                                <?php
                                  $sql = "SELECT * FROM like_unlike WHERE statusId = '$status_id' AND like_value = 'angry'";
                                  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                  if ($query) {
                                    echo mysqli_num_rows($query);
                                  }
                                ?>
                              </span>
                          </button>
                        </span>

                      </div>
                    </div>
                    <!--end of comment footer-->
                    <div class="clearfix"></div>
                  </div>
                </div>

                  <!--reply comment-->
                  <div class="timeline-body comments">
                    <!-- reply comment -->
                    <div class="comment-write">
                      <textarea id="comment_<?php echo $status_id; ?>" class="form-control" placeholder="Write a comment" rows="1" data-emojiable="true"></textarea>
                      <input id="<?php echo $status_id; ?>" type="submit" value="Send comment" class="send_comment btn btn-success pull-right">
                    </div>

                    <!-- hidden user ID and EMAIL -->
                    <input type="hidden" id="userID" value="<?php echo $userID ?>">
                    <input type="hidden" id="userEmail" value="<?php echo $email ?>">

                    <!-- end of reply comment -->
                    <?php
                      $sql_comment_no = "SELECT * FROM comments WHERE statusId = '$status_id'";
                      $query_comment_no = mysqli_query($conn, $sql_comment_no) or die(mysqli_error($conn));
                      if ($query_comment_no) {
                        if (mysqli_num_rows($query_comment_no) != 0) {
                          ?>
                          <div class="comment-item" id="adding_comment_<?php echo $status_id; ?>">
                            <?php
                            // TO GET THE COMMENNTS OR REPLIES FROM A PARTICULAR STATUS
                            $sql9 = "SELECT * FROM comments WHERE statusId ='$status_id' ORDER BY date_commented DESC";
                            $query9 = mysqli_query($conn, $sql9) or die(mysqli_error($conn));
                            if ($query9) {
                              if (mysqli_num_rows($query9) != 0) {

                                while($statusRow = mysqli_fetch_array($query9)){
                                  $user_id =  $statusRow['userId'];
                                  $comment_id = $statusRow['Id'];
                                  //
                                  $sql2 = "SELECT * FROM users_account WHERE Id = '$user_id'";
                                  $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                                  if (mysqli_num_rows($query2) == 1) {
                                    while ($userRow = mysqli_fetch_array($query2)) {

                                      date_default_timezone_set("Africa/Lagos");
                                      $time_ago = strtotime($statusRow['date_commented']);
                                      $time = time() - $time_ago;

                                      switch($time):
                                        // seconds
                                        case $time <= 60;
                                        $ago =  'Just now';
                                        break;

                                        // minutes
                                        case $time >= 60 && $time < 3600;
                                        if (round($time/60) == 1) {
                                          $ago = 'a minute';
                                        } else {
                                          $ago = round($time/60).' minutes ago';
                                        }
                                        break;

                                        // hour
                                        case $time >= 3600 && $time < 86400;
                                        if (round($time/3600) == 1) {
                                          $ago = 'an hour ago';
                                        } else {
                                          $ago = round($time/3600).' hours ago';
                                        }
                                        break;

                                        // days
                                        case $time >= 86400 && $time < 604800;
                                        if (round($time/86400) == 1) {
                                          $ago = 'a day ago';
                                        } else {
                                          $ago = round($time/86400).' days ago';
                                        }
                                        break;

                                        // weeks
                                        case $time >= 604800 && $time < 2600640;
                                        if (round($time/604800) == 1) {
                                          $ago = 'a week ago';
                                        } else {
                                          $ago = round($time/604800).' weeks ago';
                                        }
                                        break;

                                        // months
                                        case $time >= 2600640 && $time < 31207680;
                                        if (round($time/2600640) == 1) {
                                          $ago = 'a month ago';
                                        } else {
                                          $ago = round($time/2600640).' months ago';
                                        }
                                        break;

                                        // years
                                        case $time >= 31207680;
                                        if (round($time/31207680) == 1) {
                                          $ago = 'a year ago';
                                        } else {
                                          $ago = round($time/31207680).' year ago';
                                        }
                                        break;
                                      endswitch;
                                        ?>

                                        <div class='comment-cont' id="del_<?php echo $comment_id; ?>">
                                          <img src='/FUOBoxMedia/images/uploaded_images/profile_photos/<?php echo $userRow['profile_img']; ?>'/>
                                            <p class='comment-head'>
                                              <a href='friend_profile.php?friend_id=<?php echo $userRow['Id']; ?>'> <?php echo $userRow['first_name']." ".$userRow['last_name']; ?></a>
                                              <span class="text-muted" style="font-size:11px; color:#b3b3b3">@<?php echo $userRow['username']; ?></span>
                                            </p>
                                            <p class="replied_comments"><?php echo $statusRow['comment']; ?></p>
                                              <small class=''> <i class='fa fa-clock-o'></i> <?php echo $ago; ?>
                                                <?php if($userID == $userRow['Id']) { ?>
                                                <button class='delete_comment pull-right' id="<?php echo $comment_id; ?>">Delete | <i class="fa fa-trash"></i> </button>
                                                <?php } ?>
                                              </small>
                                            <div class="clearfix"></div>
                                        </div>
                                        <input type="hidden" id="commented_userID" value="<?php echo $userID; ?>">
                                        <input type="hidden" id="statusId" value="<?php echo $status_id; ?>">
                                        <?php
                                    }
                                  }
                                }
                              }
                            }
                             ?>
                          </div>
                          <?php
                        }
                      }

                     ?>
                  </div>
                  <!-- end of reply comment-->
              </li>
            </ul>
          </div>


        </div>
      </div>
    </div>
  </body>


  <!-- jQuery -->
  <script src="js/plugins/jquery/jquery-3.3.1.min.js"></script>
  <!-- timeline comments js -->
  <script type="text/javascript" src="js/comment/comment-insert.js?t=<?php echo time(); ?> "></script>
  <!-- bootstrap js -->
  <script src="js/plugins/bootstrap.min.js"></script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom/status_likes.js"></script>
  <!-- Begin emoji-picker JavaScript -->
  <script src="assets/emoji/lib/js/config.js"></script>
  <script src="assets/emoji/lib/js/util.js"></script>
  <script src="assets/emoji/lib/js/jquery.emojiarea.js"></script>
  <script src="assets/emoji/lib/js/emoji-picker.js"></script>
  <!-- End emoji-picker JavaScript -->

  <script>
    $(function() {
      // Initializes and creates emoji set from sprite sheet
      window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: 'assets/emoji/lib/img/',
        popupButtonClasses: 'fa fa-smile-o'
      });
      // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
      // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
      // It can be called as many times as necessary; previously converted input fields will not be converted again
      window.emojiPicker.discover();
    });
  </script>
</html>
