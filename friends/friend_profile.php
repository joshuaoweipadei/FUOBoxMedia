<?php

session_start();

if (isset($_SESSION['Id'])) {

  //SESSION VARIABLE DECLARED
  $userID = $_SESSION['Id'];
  $firstname = $_SESSION['first_name'];
  $lastname = $_SESSION['last_name'];
  $email = $_SESSION['email'];
  $user_name = $_SESSION['username'];
  $active = $_SESSION['active'];

} else {
  header('location: /myProject/index.php');
}

include '../database.php';

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Welcome | Market Place</title>

    <!-- <link rel="stylesheet" href="css/plugins/bootstrap-4.0.0/bootstrap.min.css"> -->
    <link rel="stylesheet" href="/myProject/css/plugins/font-awesome/css/font-awesome.min.css">
    <link href="/myProject/css/plugins/bootstrap.min.css" rel="stylesheet">

    <!-- main custom style -->
    <link rel="stylesheet" href="/myProject/css/custom/friend_profile.css">

</head>
<body>
  <?php

  if (isset($_GET['friend_id'])) {

    // Escape all $_POST variables to protect against SQL injections
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $friend_Id = test_input($_GET['friend_id']);

    if (is_numeric($friend_Id)) {
      if ($userID == $friend_Id) {
        header('location: /myProject/profile_page.php');
      } else {
        $sql = "SELECT * FROM users_account WHERE Id = '$friend_Id'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($query) {
          if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_array($query);
            $friend_Id = $row['Id'];

          } else {
            header('location: /myProject/profile_page.php');
          }
        }
      }
    } else {
      header('location: /myProject/profile_page.php?user%theirsafefriendslist');
    }


    // check if there both friends or not
    $Msg = "";
    $sql2 = "SELECT * FROM friendship WHERE (receiver = '$userID' AND sender ='$friend_Id') OR (receiver = '$friend_Id' AND sender = '$userID')";
    $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    if ($query2) {
      if (mysqli_num_rows($query2) > 0) {
        $MsgAlreadySent = "Request <br> Already Sent";

      }else {
        $sql3 = "SELECT * FROM myfriends WHERE (myId = '$userID' AND myfriends = '$friend_Id') OR (myId = '$friend_Id' AND myfriends = '$userID')";
        $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
        if ($query3) {
          if (mysqli_num_rows($query3) > 0) {
            $MsgAlreadyFriends = "Already Friends";

          } else {
            $MsgSendFriendRequest = "Send <br> Friend Request";
          }
        }
      }
    }


  // end of the GET Id
} else {
  header('location: /myProject/');
}
 ?>

  <!-- LOGGED IN USER id -->
  <input type="hidden" id="userID" value="<?php echo $userID; ?>">


  <section class="container">
    <div class="row">
      <div class="col-sm-12">

        <div class="w">
          <div class="profile_name">
            <h3><?php echo $row['first_name']. " " .$row['last_name']; ?></h3>
            <h6><i class="fa fa-at"></i><?php echo $row['username']; ?></h6>
          </div>
        </div>

        <div class="col-sm-12" style="position:relative">
          <div class="col-sm-3">
            <div class="friend_profile_img">
              <img src="/myProject/uploaded_images/<?php echo $row['profile_img']; ?>" alt="">
            </div>
            <h3 class="profile_name2">Joshua Oweipadei</h3>
            <h6 class="profile_name_3"><i class="fa fa-at"></i>joshiee</h6>
          </div>
          <div class="col-sm-9">
            <div class="col-sm-12 text-center">
              <div class="col-sm-4" style="background:; padding:0">
                <div class="pro_box">
                  <span>112</span>
                  <h4><i class="fa fa-comments"></i> Comment Entries</h4>
                </div>
              </div>
              <div class="col-sm-4" style="padding:0">
                <button id="<?php echo $row['Id']; ?>"
                  <?php if (isset($MsgAlreadySent) || isset($MsgAlreadyFriends)) {echo "disabled";} ?>
                  class="request btn btn-default pro_box">
                  <?php if (isset($MsgAlreadySent)) {echo $MsgAlreadySent;} ?>
                  <?php if (isset($MsgAlreadyFriends)) {echo $MsgAlreadyFriends;} ?>
                  <?php if (isset($MsgSendFriendRequest)) {echo "<i class='fa fa-plus'></i> ".$MsgSendFriendRequest;} ?>
                </button>
              </div>
              <div class="col-sm-4" style="padding:0">
                <?php if (isset($MsgAlreadyFriends)) {
                  echo "<a href='/myProject/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsg=".$row['Id']."'><button class='btn btn-default pro_box'><i class='fa fa-envelope'></i> Send <br> Message</button></a>";}
                ?>
              </div>
            </div>
          </div>
        </div>

        <div style="clear:both"></div>

        <div class="col-sm-12">
          <div class="personal_info">
            <h3>Profile Info</h3>
            <table cellpadding="6" cellspacing="4">
              <tr>
                <th>Status - </th>
                <td>dfjjdfhhjs sdfsdusdfwe defksd ksd <i class="fa fa-pencil"></i></td>
              </tr>
              <tr>
                <th>Hobbies - </th>
                <td>dfjjdfh hjhas efisdasn dfgfd <i class="fa fa-lightbulb-o"></td>
              </tr>
              <tr>
                <th>Likes - </th>
                <td>dfjjdfh jumsdfis sdisdjiern fhjsdfwejsd sduiwerwe <i class="fa fa-life-ring"></td>
              </tr>
            </table>
          </div>
        </div>


        <div class="col-sm-12">
          <div class="friend_friends">
            <h2 class="">Friends</h2>
            <!--friends-->
            <div class="row" style="padding:0px 1px">
              <div class="col-lg-1 col-md-2 col-xs-3 col-sm-2 friend_col">
                <div class="fri">
                  <div class="friend">
                    <img src="/myProject/images/me/josh1.jpg"/>
                    <span>fghjgfhfg ghdfghgf</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 col-md-2 col-xs-3 col-sm-2 friend_col">
                <div class="fri">
                  <div class="friend">
                    <img src="/myProject/images/me/josh1.jpg"/>
                    <span>fghjgfhfg ghdfghgf</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 col-md-2 col-xs-3 col-sm-2 friend_col">
                <div class="fri">
                  <div class="friend">
                    <img src="/myProject/images/me/josh1.jpg"/>
                    <span>fghjgfhfg ghdfghgf</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 col-md-2 col-xs-3 col-sm-2 friend_col">
                <div class="fri">
                  <div class="friend">
                    <img src="/myProject/images/me/josh1.jpg"/>
                    <span>fghjgfhfg ghdfghgf</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 col-md-2 col-xs-3 col-sm-2 friend_col">
                <div class="fri">
                  <div class="friend">
                    <img src="/myProject/images/me/josh1.jpg"/>
                    <span>fghjgfhfg ghdfghgf</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 col-md-2 col-xs-3 col-sm-2 friend_col">
                <div class="fri">
                  <div class="friend">
                    <img src="/myProject/images/me/josh1.jpg"/>
                    <span>fghjgfhfg ghdfghgf</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 col-md-2 col-xs-3 col-sm-2 friend_col">
                <div class="fri">
                  <div class="friend">
                    <img src="/myProject/images/me/josh1.jpg"/>
                    <span>fghjgfhfg ghdfghgf</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-1 col-md-2 col-xs-3 col-sm-2 friend_col">
                <div class="fri">
                  <div class="friend">
                    <img src="/myProject/images/me/josh1.jpg"/>
                    <span>fghjgfhfg ghdfghgf</span>
                  </div>
                </div>
              </div>
            </div>
            <!--end of friends-->
            <div class="col-sm-12">
              <div class="">
                <a href="" class="btn btn-primary pull-right">Unfriend</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>




  <!-- Jq-->
  <script type="text/javascript" src="../js/plugins/jquery/jquery-3.3.1.min.js"></script>

    <script src="/myProject/js/plugins/bootstrap.min.js"></script>
    <script src="/myProject/js/custom/dist/custom.min.js"></script>
    <script src="/myProject/js/custom/profile.js"></script>


  </body>
  </html>
