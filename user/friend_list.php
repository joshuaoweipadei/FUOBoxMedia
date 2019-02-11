<?php

if (!isset($_SESSION['Id'])) {

  header('location: /FUOBoxMedia/index.php');
}

?>


<style media="screen">
/*
*
*	MY FRIENDS
*
*/
.my_friends{
background: #FFF
}
.friend_profile{
  width: 100%;
  background: #fff;
  padding: 3px 0 3px 0px;
  border-bottom: 1px solid #e1e1e1;
}
.profile-ima{
  width: 65px !important;
  height: 65px !important;
  border: 1px solid rgba(93,84,240,8.5) !important;
  padding: 2px !important;
  border-radius: 2px !important;
  overflow: hidden !important;
}
.profile-ima img{
  width: 100%;
  height: 100%;
  border-radius: 0px !important;
}
.profile-da{
  padding-left: 3% !important;
  margin: auto;
  margin-top: 0px;
  font-size: 17px;
  color: #595959;
}
.profile-da span{
  color: #c1c1c1;
  font-size: 14px;
}
.send_msg{
  margin-right: 6%;
  margin-top: 1%;
}
.my_friends .title h3{
  padding: 13px  12px;
  background: rgba(185,0,255,0.9);
  color: #fff;
  border-top-left-radius: 6px;
  border-top-right-radius: 6px;
}
</style>
<!-- MY FRIEND LIST -->
<div class="my_friends">
  <div class="col-md-12">
    <div class="title" style="padding-bottom:10px">
      <h3><i class="fa fa-users"></i> All Friends</h3>
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
            <div class="col-md-8">
              <div class="friend_profile">
                <a href="friend_profile.php?friend_id=<?php echo $row['Id'] ?>">
                  <div class="profile-ima pull-left">
                    <img src="/FUOBoxMedia/images/uploaded_images/profile_photos/<?php echo $row['profile_img']; ?>" alt="<?php echo $row['first_name']." ".$row['last_name']; ?>">
                  </div>
                  <div class="profile-da pull-left"><?php echo $row['first_name']." ".$row['last_name']; ?> <br><span><?php echo "@".$row['username']; ?></span> </div>
                </a>
                <a href="/FUOBoxMedia/user/send_message.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $row['Id'] ?>" class="send_msg btn btn-secondary pull-right"><i class="fa fa-envelope"></i> Send Message</a>

                <div class="clearfix"></div>
              </div>
            </div>
            <?php
          }
        } else {

          $sql3 = "SELECT * FROM users_account WHERE Id = '$myId'";
          $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
          if ($query3) {
            $row = mysqli_fetch_array($query3);
            ?>
            <div class="col-md-8">
              <div class="friend_profile">
                <a href="friend_profile.php?friend_id=<?php echo $row['Id'] ?>">
                  <div class="profile-ima pull-left">
                    <img src="/FUOBoxMedia/images/uploaded_images/profile_photos/<?php echo $row['profile_img']; ?>" alt="<?php echo $row['first_name']." ".$row['last_name']; ?>">
                  </div>
                  <div class="profile-da pull-left"><?php echo $row['first_name']." ".$row['last_name']; ?> <br><span><?php echo "@".$row['username']; ?></span> </div>
                </a>
                <a href="/FUOBoxMedia/user/send_message.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $row['Id'] ?>" class="send_msg btn btn-secondary pull-right"><i class="fa fa-envelope"></i> Send Message</a>

                <div class="clearfix"></div>
              </div>
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
