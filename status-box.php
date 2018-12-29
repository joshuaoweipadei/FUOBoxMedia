<?php
if (!isset($_SESSION['Id'])) {
  header('location: profile_page.php');
};
 ?>

<?php if (isset($GLOBALS['statuss'])): ?>

<?php foreach ($statuss as $key => $status): ?>

<?php $user = Users::getUsers($status->userId); ?>

<!-- TO SEPARATE THE DATE AND TIME GOTTEN FORM THE DATABASE -->
<?php
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
<li class="comment-holder timeline-item" id="del_status_<?php echo $status->status_id; ?>">
  <div class="status-id" id="<?php echo $status->status_id; ?>"></div>

  <div class="container-area" style="padding-bottom:10px; padding-top:10px">
    <!--USER IMAGE-->
    <div class="user-img">
      <a href="friends/friend_profile.php?friend_id=<?php echo $status->userId; ?>" >
        <img src="uploaded_images/<?php echo $user->profile_img; ?>" class="user-img-pic" alt="upload picture">
      </a>
    </div>
    <div class="comment-body">
      <!--USER NAME-->
      <h3 class="username-field">
        <a href="friends/friend_profile.php?friend_id=<?php echo $status->userId; ?>"> <?php echo $user->first_name." ".$user->last_name; ?> </a>
      </h3>
      <!--USER COMMENT-->
      <div class="comment-text">
        <p><?php echo $status->status; ?></p>
      </div>

      <div class="date">
        <span> <i class="fa fa-globe"></i> | </span>
        <span class="everyone">Everyone <i class="fa fa-eye"></i> </span>
        <span class="pull-right" style="color:#595959"> <?php echo $ago; ?> </span>
      </div>

      <div class="clearfix"></div>

      <!--comment footer-->
      <div class="timeline-footer">
        <div class="">
          <span class="likes">
            <i class="fa fa-comment-o" style="font-size:17px; color:#6a6a6a;"></i>
            <span id="comment_count_<?php echo $status->status_id; ?>" style="font-size:16px; color:#6a6a6a; font-family:cursive"></span>
          </span>

          <span class="likes">
            <button class="like" id="<?php echo $status->status_id; ?>" value="sunglasses" title="Cool">
              <img src="/FUOBoxMedia/images/icon/sunglasses.png" alt="cool" width="21px" height="21px">
                <span id="sunglasses_<?php echo $status->status_id; ?>">
                  <?php
                    $sql = "SELECT * FROM like_unlike WHERE statusId = '$status->status_id' AND like_value = 'sunglasses'";
                    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if ($query) {
                      echo mysqli_num_rows($query);
                    }
                  ?>
                </span>
            </button>
          </span>

          <span class="likes">
            <button class="like" id="<?php echo $status->status_id; ?>" value="laughing" title="Laughing">
              <img src="/FUOBoxMedia/images/icon/laughing.png" alt="laughing" width="21px" height="21px">
                <span id="laughing_<?php echo $status->status_id; ?>">
                  <?php
                    $sql = "SELECT * FROM like_unlike WHERE statusId = '$status->status_id' AND like_value = 'laughing'";
                    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if ($query) {
                      echo mysqli_num_rows($query);
                    }
                  ?>
                </span>
            </button>
          </span>

          <span class="likes">
            <button class="like" id="<?php echo $status->status_id; ?>" value="shocked" title="Shocked">
              <img src="/FUOBoxMedia/images/icon/flushed.png" alt="shocked" width="21px" height="21px">
                <span id="shocked_<?php echo $status->status_id; ?>">
                  <?php
                    $sql = "SELECT * FROM like_unlike WHERE statusId = '$status->status_id' AND like_value = 'shocked'";
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
              <img src="/FUOBoxMedia/images/icon/smile.png" alt="smiles" width="21px" height="21px">
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
              <img src="/FUOBoxMedia/images/icon/angry.png" alt="angry" width="21px" height="21px">
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
        <textarea id="comment_<?php echo $status->status_id; ?>" class="form-control" placeholder="Write a comment" rows="1"></textarea>
        <input id="<?php echo $status->status_id; ?>" type="submit" value="Send comment" class="send_comment btn btn-success pull-right">
      </div>
      <!-- end of reply comment -->
      <?php
        $sql_comment_no = "SELECT * FROM comments WHERE statusId = '$status->status_id'";
        $query_comment_no = mysqli_query($conn, $sql_comment_no) or die(mysqli_error($conn));
        if ($query_comment_no) {
          if (mysqli_num_rows($query_comment_no) >= 4) {
            ?>
            <div class="comment-item" style="height:300px; overflow-y:scroll" id="adding_comment_<?php echo $status->status_id; ?>">
              <?php
              // TO GET THE COMMENNTS OR REPLIES FROM A PARTICULAR STATUS
              $sql9 = "SELECT * FROM comments WHERE statusId ='$status->status_id' ORDER BY date_commented DESC";
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
                            <img src='/FUOBoxMedia/uploaded_images/<?php echo $userRow['profile_img']; ?>'/>
                              <p class='comment-head'>
                                <a href='friends/friend_profile.php?friend_id=<?php echo $userRow['Id']; ?>'> <?php echo $userRow['first_name']." ".$userRow['last_name']; ?></a>
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
          } else {
            ?>
            <div class="comment-item" style="height:auto" id="adding_comment_<?php echo $status->status_id; ?>">
              <?php
              // TO GET THE COMMENNTS OR REPLIES FROM A PARTICULAR STATUS
              $sql9 = "SELECT * FROM comments WHERE statusId ='$status->status_id' ORDER BY date_commented DESC";
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
                            <img src='/FUOBoxMedia/uploaded_images/<?php echo $userRow['profile_img']; ?>'/>
                              <p class='comment-head'>
                                <a href='friends/friend_profile.php?friend_id=<?php echo $userRow['Id']; ?>'> <?php echo $userRow['first_name']." ".$userRow['last_name']; ?></a>
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

<?php if( $userID == $status->userId): ?>
  <div class="comment-button-holder">
    <ul>
      <li class="delete-btn" id="<?php echo $status->status_id; ?>"><i class="fa fa-trash"></i></li>
    </ul>
  </div>
<?php endif; ?>
</li>
<?php endforeach; ?>

<?php endif; ?>
