<?php

if (!isset($_SESSION['Id'])) {
  header('location: index.php');
};
 ?>

<?php if (isset($GLOBALS['statuss'])): ?>

<?php foreach ($statuss as $key => $status): ?>

<?php $user = Users::getUsers($status->userId); ?>

<!-- TO SEPARATE THE DATE AND TIME GOTTEN FORM THE DATABASE -->
<?php
date_default_timezone_set("Africa/Lagos");
$dateTime = strtotime($status->date_posted);
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
  $time_ago = strtotime($status->date_posted);
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


?>


<li class="comment-holder timeline-item" id="del_status_<?php echo $status->status_id; ?>">
  <div class="status-id" id="<?php echo $status->status_id; ?>"></div>

  <div class="container-area" style="padding-bottom:10px; padding-top:10px">
    <!--USER IMAGE-->
    <div class="user-img">
      <a>
        <img src="images/uploaded_images/profile_photos/<?php echo $user->profile_img; ?>" class="user-img-pic" alt="upload picture">
      </a>
    </div>
    <div class="comment-body">
      <!--USER NAME-->
      <h3 class="username-field">
        <a href="friend_profile.php?friend_id=<?php echo $status->userId; ?>"> <?php echo $user->first_name." ".$user->last_name; ?> </a>
      </h3>
      <!--USER COMMENT-->
      <div class="comment-text">
        <p><?php echo $status->status; ?></p>
      </div>

      <div class="date">
        <span> <i class="fa fa-globe"></i> | </span>
        <span class="everyone">Everyone <i class="fa fa-eye" style="color:#ff0000"></i> </span>
        <span class="pull-right" style="color:#c1c1c1"> <?php echo $ago; ?> </span>
        <?php if( $userID == $status->userId): ?>
          <div class="comment-button-holder">
            <ul>
              <li class="delete-btn" id="<?php echo $status->status_id; ?>" title="Remove Status"><i class="fa fa-times"></i> Remove Status</li>
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
            <span id="comment_count_<?php echo $status->status_id; ?>" style="font-size:16px; color:#6a6a6a; font-family:cursive"></span>
          </span>

          <span class="likes">
            <button class="like" id="<?php echo $status->status_id; ?>" value="thumbsUp" title="thumbsUp">
              <i class="fa fa-thumbs-o-up emoji"></i>
                <span id="thumbsUp_<?php echo $status->status_id; ?>">
                  <?php
                    $sql = "SELECT * FROM like_unlike WHERE statusId = '$status->status_id' AND like_value = 'thumbsUp'";
                    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if ($query) {
                      echo mysqli_num_rows($query);
                    }
                  ?>
                </span>
            </button>
          </span>

          <span class="likes">
            <button class="like" id="<?php echo $status->status_id; ?>" value="thumbsDown" title="thumbsDown">
              <i class="fa fa-thumbs-o-down emoji"></i>
                <span id="thumbsDown_<?php echo $status->status_id; ?>">
                  <?php
                    $sql = "SELECT * FROM like_unlike WHERE statusId = '$status->status_id' AND like_value = 'thumbsDown'";
                    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if ($query) {
                      echo mysqli_num_rows($query);
                    }
                  ?>
                </span>
            </button>
          </span>

          <span class="likes">
            <button class="like" id="<?php echo $status->status_id; ?>" value="frown" title="Frown">
              <i class="fa fa-meh-o emoji"></i>
                <span id="frown_<?php echo $status->status_id; ?>">
                  <?php
                    $sql = "SELECT * FROM like_unlike WHERE statusId = '$status->status_id' AND like_value = 'frown'";
                    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if ($query) {
                      echo mysqli_num_rows($query);
                    }
                  ?>
                </span>
            </button>
          </span>

          <span class="likes">
            <button class="like" id="<?php echo $status->status_id; ?>" value="smiles" title="Smiles">
              <i class="fa fa-smile-o emoji"></i>
                <span id="smiles_<?php echo $status->status_id; ?>">
                  <?php
                    $sql = "SELECT * FROM like_unlike WHERE statusId = '$status->status_id' AND like_value = 'smiles'";
                    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if ($query) {
                      echo mysqli_num_rows($query);
                    }
                  ?>
                </span>
            </button>
          </span>

          <span class="likes">
            <button class="like" id="<?php echo $status->status_id; ?>" value="angry" title="Angry">
              <i class="fa fa-frown-o emoji"></i>
                <span id="angry_<?php echo $status->status_id; ?>">
                  <?php
                    $sql = "SELECT * FROM like_unlike WHERE statusId = '$status->status_id' AND like_value = 'angry'";
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
        <textarea id="comment_<?php echo $status->status_id; ?>" class="form-control" placeholder="Write a comment" rows="1" data-emojiable="true"></textarea>
        <input id="<?php echo $status->status_id; ?>" type="submit" value="Send comment" class="send_comment btn btn-success pull-right">
      </div>
      <!-- end of reply comment -->
      <?php
        $sql_comment_no = "SELECT * FROM comments WHERE statusId = '$status->status_id'";
        $query_comment_no = mysqli_query($conn, $sql_comment_no) or die(mysqli_error($conn));
        if ($query_comment_no) {
          if (mysqli_num_rows($query_comment_no) != 0) {
            ?>
            <div class="comment-item" id="adding_comment_<?php echo $status->status_id; ?>">
              <?php
              // TO GET THE COMMENNTS OR REPLIES FROM A PARTICULAR STATUS
              $sql9 = "SELECT * FROM comments WHERE statusId ='$status->status_id' ORDER BY date_commented DESC LIMIT 2";
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
                          <input type="hidden" id="statusId" value="<?php echo $status->status_id; ?>">
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
<?php endforeach; ?>

<?php endif; ?>
