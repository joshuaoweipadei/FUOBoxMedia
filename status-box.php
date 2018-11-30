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
<?php
// $sql2 = "SELECT * FROM comments WHERE Id = '$status->status_id'";
// $result = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
// if ($result) {
//   if ($row = mysqli_fetch_object($result)){
//
// }}

 ?>
<li class="comment-holder timeline-item" id="del_status_<?php echo $status->status_id; ?>">
  <div class="date">
    <span class="pull-right"><?php echo $ago; ?></span>
    <span class="pull-left"> Public <i class="fa fa-globe"></i></span>
  </div>

  <div style="clear:both; margin-bottom:5px"></div>

  <div class="container" style="padding-bottom:10px; padding-top:10px">
    <!--USER IMAGE-->
    <div class="user-img">
      <a href="friends/friend_profile.php?friend_id=<?php echo $status->userId; ?>" ><img src="uploaded_images/<?php echo $user->profile_img; ?>" class="user-img-pic" alt="upload picture"></a>
    </div>
    <div class="comment-body">
      <!--USER NAME-->
      <h3 class="username-field">
        <a href="friends/friend_profile.php?friend_id=<?php echo $status->userId; ?>"><?php echo $user->username; ?> </a><span style="font-size:12px"> added an article</span>
      </h3>

      <!--USER COMMENT-->
      <div class="comment-text">
        <?php echo $status->status; ?>
      </div>
      <div class="clearfix"></div>
      <!--comment footer-->
      <div class="timeline-footer">
        <div class="">
          <span class="likes">
            <span id="comment_count_<?php echo $status->status_id; ?>" style="font-size:16px; color:#fff"></span>
            <i class="fa fa-comments" style="font-size:17px; color:#fff; padding-right:8px"></i>
          </span>
          <span class="likes">
            <button class="like" id="<?php echo $status->status_id; ?>" value="sunglasses"><img src="/myProject/images/icon/sunglasses.png" alt="cool" width="27px" height="27px" title="Cool">
              <span id="like_<?php echo $status->status_id; ?>">
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
            <button class="like" id="<?php echo $status->status_id; ?>" value="laughing"><img src="/myProject/images/icon/laughing.png" alt="laughing" width="27px" height="27px" title="Laughing">
              <span id="like_<?php echo $status->status_id; ?>">
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
            <button class="like" id="<?php echo $status->status_id; ?>" value="shocked"><img src="/myProject/images/icon/flushed.png" alt="shocked" width="27px" height="27px" title="Shocked">
              <span id="like_<?php echo $status->status_id; ?>">
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
            <button class="like" id="<?php echo $status->status_id; ?>" value="smiles"><img src="/myProject/images/icon/smile.png" alt="smiles" width="27px" height="27px" title="Smiles">
              <span id="like_<?php echo $status->status_id; ?>">
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
            <button class="like" id="<?php echo $status->status_id; ?>" value="angry"><img src="/myProject/images/icon/angry.png" alt="angry" width="27px" height="27px" title="Angry">
              <span id="like_<?php echo $status->status_id; ?>">
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
        <input id="<?php echo $status->status_id; ?>" type="submit" value="Send" class="send_comment btn btn-success pull-right">
      </div>
      <!-- end of reply comment -->
      <div class="comment-item" id="adding_comment_<?php echo $status->status_id; ?>">
        <?php
        // TO GET THE COMMENNTS OR REPLIES FROM A PARTICULAR STATUS
        $sql9 = "SELECT * FROM comments WHERE statusId ='$status->status_id' ORDER BY Id DESC";
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
                      <img src='/myProject/uploaded_images/<?php echo $userRow['profile_img']; ?>'/>
                        <p class='comment-head'>
                          <a href='friends/friend_profile.php?friend_id=<?php echo $userRow['Id']; ?>' class='text-muted'>@ <?php echo $userRow['username']; ?> </a>
                        </p>
                        <p><?php echo $statusRow['comment']; ?></p>
                          <small class='text-muted'> <i class='fa fa-calendar'></i> <?php echo $ago; ?>
                            <?php if($userID == $userRow['Id']) { ?>
                            <button class='delete_comment pull-right' id="<?php echo $comment_id; ?>"> Delete <i class='fa fa-close'></i></button>
                            <?php } ?>
                          </small>
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
