<?php

if (!isset($_SESSION['Id'])) {

  header('location: /myProject/index.php');
}

?>


<!-- MY FRIEND LIST -->
<div class="my_friends">

  <div class="content-frame-top">
      <div class="page-title" style="padding-bottom:10px">
          <h2><i class="fa fa-users"></i> My Friends</h2>
      </div>
  </div>

  <?php
  $sql = "SELECT * FROM myfriends WHERE myId = '$userID' OR myfriends = '$userID'";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    if (mysqli_num_rows($query) != 0) {
      while ($_row = mysqli_fetch_array($query)) {
        $myId = $_row['myId'];
        // LOGGED IN USER Id
        $userID = $_SESSION['Id'];

        if ($userID == $myId) {
          $myfriends = $_row['myfriends'];

          $sql2 = "SELECT * FROM users_account WHERE Id = '$myfriends'";
          $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
          if ($query2) {
            $row = mysqli_fetch_array($query2);
            ?>
            <div class=" profile_">
              <a href="/myProject/friends/friend_profile.php?friend_id=<?php echo $row['Id'] ?>">
                <div class="profile-ima pull-left">
                  <img src="/myProject/uploaded_images/<?php echo $row['profile_img']; ?>" alt="<?php echo $row['first_name']." ".$row['last_name']; ?>">
                </div>
                <div class="profile-da pull-left"><?php echo $row['first_name']." ".$row['last_name']; ?> <br><span><?php echo "@".$row['username']; ?></span> </div>
              </a>
              <a href="/myProject/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsg=<?php echo $row['Id'] ?>" class="send_msg btn btn-default pull-right"><i class="fa fa-envelope"></i> Send Message</a>

              <div class="clearfix"></div>
            </div>
            <?php
          }
        } else {

          $sql3 = "SELECT * FROM users_account WHERE Id = '$myId'";
          $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
          if ($query3) {
            $row = mysqli_fetch_array($query3);
            ?>
            <div class=" profile_">
              <a href="/myProject/friends/friend_profile.php?friend_id=<?php echo $row['Id'] ?>">
                <div class="profile-ima pull-left">
                  <img src="/myProject/uploaded_images/<?php echo $row['profile_img']; ?>" alt="<?php echo $row['first_name']." ".$row['last_name']; ?>">
                </div>
                <div class="profile-da pull-left"><?php echo $row['first_name']." ".$row['last_name']; ?> <br><span><?php echo "@".$row['username']; ?></span> </div>
              </a>
              <a href="/myProject/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsg=<?php echo $row['Id'] ?>" class="send_msg btn btn-default pull-right"><i class="fa fa-envelope"></i> Send Message</a>

              <div class="clearfix"></div>
            </div>
            <?php
          }
        }

      }
    } else {
      echo "You don't have any Friends";
    }
  }
   ?>

</div>
