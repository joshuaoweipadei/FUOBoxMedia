<?php

session_start();

if (isset($_SESSION['Id'])) {

  //SESSION VARIABLE DECLARED
  $userID = $_SESSION['Id'];
  $email = $_SESSION['email'];
  $active = $_SESSION['active'];

} else {
  header('location: /FUOBoxMedia/index.php');
}

include 'includes/database.php';

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FUOBoxMedia | Friend Profile</title>

    <link rel="stylesheet" href="css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="css/custom/main.css">
    <link rel="stylesheet" href="css/custom/profile.css">

    <!-- light-box -->
    <link rel="stylesheet" type="text/css" href="css/plugins/jquery.fancybox.css" media="screen" />

    <style media="screen">
    /* FRIEND PROFILE */
    .picture p .friend_info{
      font-size: 16px;
      font-weight: 600;
      color: #00004d;
      font-family: arial;
    }
    .picture p span.delete_friend_btn a{
      margin-right: 1%;
      border: none;
      border-radius: 3px;
      background: rgba(185,0,255,0.9);
      color: #fff;
      font-size: 16px;
      font-family: arial;
    }
    .picture p span.delete_friend_btn a:hover{
      background: rgba(93,84,240,8.5)
    }
    .delete_unfriend{
      background:pink;
      margin-top: 10px;
      padding: 10px;
    }
    .delete_unfriend .delete_unfriend_btn{
      margin-top: 10px;
    }
    .delete_unfriend span{
      font-size: 17px;
      font-weight: 500;
      color: #595959;
    }
    .friend_comm_msg_box{
      margin-top: 10px;
      margin-bottom: 15px;
      padding: 12px;
      border: 1px solid #f2f2f2;
      box-shadow: 5px 4px 8px 5px #f2f2f2, 5px 6px 20px 5px #f2f2f2;
    }
    .comment_entries_box{
      height: 80px;
      width: 87%;
      background: rgba(93,84,240,8.5);
      padding-right: 7px;
      padding-left: 7px;
      margin: auto;
      text-align: center;
      border-radius: 6px;
      margin-top: 5px;
      margin-bottom: 5px;
      position: relative;
      color: #ffffff;
    }
    .comment_entries_box span{
      font-size: 20px;
    }
    .comment_entries_box h4{
      font-size: 15px;
      font-weight: 600;
      margin-top: 1px
    }
    button.comment_entries_box{
      font-size: 15px;
      font-weight: 600;
      border: none;
      color: #ffffff;
    }
    button.comment_entries_box:hover{
      background: #00004d;
      color: #fff
    }
    /*  PAGE LOADER */
    .loader {
    border: 7px solid #f3f3f3;
    border-radius: 50%;
    border-top: 7px solid rgba(93,84,240,8.5);
    border-bottom: 7px solid rgba(93,84,240,8.5);
    border-right: 7px solid #e1e1e1;
    border-left: 7px solid #e1e1e1;
    width: 40px;
    height: 40px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    margin: auto;
    }

    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
    </style>
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
        header('location: /FUOBoxMedia/profile_page.php');
      } else {
        $sql = "SELECT * FROM users_account WHERE Id = '$friend_Id'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($query) {
          if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_array($query);
            $friend_Id = $row['Id'];

          } else {
            header('location: /FUOBoxMedia/profile_page.php');
          }
        }
      }
    } else {
      header('location: /FUOBoxMedia/profile_page.php');
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
  header('location: /FUOBoxMedia/');
}
 ?>

  <!-- LOGGED IN USER id -->
  <?php if (isset($_SESSION['Id'])): ?>
    <input type="hidden" id="userID" value="<?php echo $userID; ?>">
  <?php endif; ?>

  <!-- main header -->
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
  </div><!-- end of main header -->

  <div class="container" style="margin-bottom:100px">
    <div class="row">
      <div class="col-md-12">
        <div class="picture">
          <a href="javascript:history.back()" class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> back </a>
            <?php
            echo "<div class='pic'>";
              echo "<div class='img_section magnifier2'>
                      <a class='fancybox' href='images/uploaded_images/profile_photos/".$row['profile_img']."' data-fancybox-group='gallery' title='".$row['first_name']." ".$row['last_name']."'>
                      <div class='img_container'>
                        <img src='images/uploaded_images/profile_photos/".$row['profile_img']."' width='100%' height='100%' alt='photo'> <span> </span>
                      </div>
                      </a>
                    </div>
                    ";
            echo "</div>";
            ?>
            <h2 style="font-size:46px; font-weight:600; color:rgba(185,0,255,0.9)"><?php echo $row['first_name']." ".$row['last_name'];?></h2>

            <!--from quote in the database-->
            <?php
              $query = "SELECT * FROM quotes WHERE userId = '$friend_Id'";
              $resultQuote = mysqli_query($conn, $query) or die(mysqli_error($conn));
              if ($resultQuote) {
                if (mysqli_num_rows($resultQuote) == 1) {
                  if ($user_quote = mysqli_fetch_array($resultQuote)) {
                    $quote = $user_quote['quote'];
                  }
                }
              }
             ?>
            <p><span class="friend_info">Favourite quote: </span> <span class="quote"><?php if(isset($quote)){ echo $quote; } ?></span> ...<i class="fa fa-pencil"></i></p>
            <p><span class="friend_info">Department: </span> <span class="quote"><?php echo "Computer science and Informatics"; ?></span> ...<i class="fa fa-pencil"></i></p>
            <p><span class="friend_info">Hobbies/Likes: </span> <span class="quote"><?php  echo "rice"; ?></span> ...<i class="fa fa-pencil"></i></p>
            <p><span class="friend_info">Gender: </span> <span class="quote">
              <?php echo $row['gender']; ?>
            </span> <i class="fa fa-child"></i>
            </p>
            <p><span class="friend_info">Mutual Friends: </span> <span class="quote"><?php  echo "110"; ?></span> <i class="fa fa-group"></i></p>
            <?php
              if (isset($MsgAlreadyFriends)) {
              ?>
              <p><span class="delete_friend_btn"><a href="user/delete_friendship.php?id=<?php echo $row['Id']; ?>" class="btn btn-primary pull-right">Unfriend</a></p>
              <?php
              }
             ?>
              <div class="clearfix"></div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="friend_comm_msg_box">
          <div class="col-sm-12" style="position:relative">
            <div class="col-md-4 text-center" style="padding:0">
              <div class="comment_entries_box">
                <?php
                  $sql_total_comment = "SELECT * FROM comments WHERE userId = '$friend_Id'";
                  $query_total_comment = mysqli_query($conn, $sql_total_comment) or die(mysqli_error($conn));
                  if ($query_total_comment) {
                    $total_comment_count = mysqli_num_rows($query_total_comment);
                    echo '<span>'.$total_comment_count.' <i class="fa fa-comments"></i></span>
                    <h4>Total comments entries</h4>';
                  }
                 ?>
              </div>
            </div>
            <div class="col-md-4 text-center" style="padding:0">
              <button id="<?php echo $row['Id']; ?>"
                <?php if (isset($MsgAlreadySent) || isset($MsgAlreadyFriends)) {echo "disabled";} ?>
                class="request btn btn-default comment_entries_box" style="color:rgba(93,84,240,8.5); background:#f2f2f2; border:1px solid rgba(93,84,240,8.5)">
                <?php if (isset($MsgAlreadySent)) {echo $MsgAlreadySent;} ?>
                <?php if (isset($MsgAlreadyFriends)) {echo "<i class='fa fa-check-square-o'></i> <br> ".$MsgAlreadyFriends;} ?>
                <?php if (isset($MsgSendFriendRequest)) {echo "<i class='fa fa-plus'></i> ".$MsgSendFriendRequest;} ?>
              </button>
            </div>
            <div class="col-md-4 text-center" style="padding:0">
              <?php if (isset($MsgAlreadyFriends)) {
                echo "<a href='/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsg=".$row['Id']."'>
                <button class='btn btn-default comment_entries_box'><i class='fa fa-envelope'></i> Send <br> Message</button></a>";}
              ?>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="chat-sidebar">
          <h4><i class="fa fa-group"></i> Friends </h4>
          <?php
          $sql = "SELECT * FROM myfriends WHERE myId = '$friend_Id' OR myfriends = '$friend_Id'";
          $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
          if ($query) {
            if (mysqli_num_rows($query) != 0) {

              while ($_row = mysqli_fetch_array($query)) {
                $myId = $_row['myId'];
                $frnd_Id = $_row['myfriends'];
                $userID = $_SESSION['Id'];

                if ($frnd_Id == $friend_Id) {
                  // checking if they are MUTUAL Friends or not
                  $sql4 = "SELECT * FROM myfriends WHERE (myId = '$myId' AND myfriends = '$userID') OR (myId = '$userID' AND myfriends = '$myId')";
                  $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                  if ($query4) {
                    if (mysqli_num_rows($query4) == 1) {
                      $mutualFriend = "Mutual Friend";
                    } else {
                      $mutualFriend = " ";
                    }
                  }

                  $sql2 = "SELECT * FROM users_account WHERE Id = '$myId'";
                  $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                  if ($query2) {
                    if (mysqli_num_rows($query2) != 0) {
                      if ($user_row = mysqli_fetch_array($query2)) {
                        ?>
                        <div class="sidebar-name">
                          <a href="friend_profile.php?friend_id=<?php echo $user_row['Id']; ?>">
                            <img src="images/uploaded_images/profile_photos/<?php echo $user_row['profile_img']; ?>" />
                            <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                            <span class="pull-right">
                              <?php
                                echo "<span style='font-size:13px; color:#c1c1c1'>".$mutualFriend."</span>";
                                if ($user_row['active'] == 1){
                                  echo " | <i class='fa fa-circle' style='color:#00cc00'></i>";
                                }
                              ?>
                            </span>
                          </a>
                          <div class="clearfix"></div>
                        </div>
                       <?php
                      }
                    }
                  }

                } else {
                  // checking if they are MUTUAL Friends or not
                  $sql4 = "SELECT * FROM myfriends WHERE (myId = '$frnd_Id' AND myfriends = '$userID') OR (myId = '$userID' AND myfriends = '$frnd_Id')";
                  $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                  if ($query4) {
                    if (mysqli_num_rows($query4) == 1) {
                      $mutualFriend = "Mutual Friend";
                    } else {
                      $mutualFriend = " ";
                    }
                  }

                  $sql3 = "SELECT * FROM users_account WHERE Id = '$frnd_Id'";
                  $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                  if ($query3) {
                    if (mysqli_num_rows($query3) != 0) {
                      if ($user_row = mysqli_fetch_array($query3)) {
                        ?>
                        <div class="sidebar-name">
                          <a href="friend_profile.php?friend_id=<?php echo $user_row['Id']; ?>">
                            <img src="images/uploaded_images/profile_photos/<?php echo $user_row['profile_img']; ?>" />
                            <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                            <span class="pull-right">
                              <?php
                                echo "<span style='font-size:13px; color:#c1c1c1'>".$mutualFriend."</span>";
                                if ($user_row['active'] == 1){
                                  echo " | <i class='fa fa-circle' style='color:#00cc00'></i>";
                                }
                              ?>
                            </span>                          </a>
                          <div class="clearfix"></div>
                        </div>
                       <?php
                      }
                    }
                  }
                }

              }
            } else {
              echo "<span style='padding-left:10px; font-family:Gabriola; font-size:18px; color:#595959'>
                      You do not have any friends yet.
                    </span>";
            }
          }
           ?>
        </div>
      </div>

    </div>
  </div>


  <!-- jQuery -->
  <script src="js/plugins/jquery/jquery-3.3.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/plugins/bootstrap.min.js"></script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom/profile.js"></script>

  <script>
    $(document).ready(function(){
      // Simple image gallery. Uses default settings
      $('.fancybox').fancybox();
    });
  </script>
  <!-- light-box -->
  <script type="text/javascript" src="js/plugins/jquery.fancybox.js"></script>


  </body>
  </html>
