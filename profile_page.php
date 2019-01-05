<?php
session_start();

// // Check if user is logged in using the session variable
if (!isset($_SESSION['Id']) && !isset($_SESSION['email'])) {

  header('location: index.php');

}else {
  //SESSION VARIABLE DECLARED
  // Makes it easier to read
  $userID = $_SESSION['Id'];
  $email = $_SESSION['email'];
  $active = $_SESSION['active'];
}

include_once 'database.php';

?>

<!-- GETTING THE LOGGED IN USER DETAILS FOR THE DATABASE -->
<?php
$sql = "SELECT * FROM users_account WHERE Id = '$userID' AND email = '$email'";
$fetch_user = mysqli_query($conn, $sql) or die(mysqli_error($conn));
if ($fetch_user) {
  if ($logged_in_user = mysqli_fetch_array($fetch_user)) {
    $firstname = $logged_in_user['first_name'];
    $lastname = $logged_in_user['last_name'];
    $profile_img = $logged_in_user['profile_img'];
    $nickname = $logged_in_user['username'];
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
    <title>Profile | Details</title>

    <!-- <link rel="stylesheet" href="css/plugins/bootstrap-4.0.0/bootstrap.min.css"> -->
    <!-- plugin for photos-->
    <link rel="stylesheet" href="css/plugins/theme-default.css">
    <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/plugins/w3css/w3css.css">
    <link href="css/plugins/bootstrap.min.css" rel="stylesheet">

    <!-- popup style -->
    <link href="css/plugins/dist/custom.css" rel="stylesheet">

    <!-- main custom style -->
    <link rel="stylesheet" href="css/custom/main.css">
    <link rel="stylesheet" href="css/custom/profile-style.css">
    <link rel="stylesheet" href="css/custom/.css">
    <link rel="stylesheet" type="text/css" href="css/plugins/dropzone/dropzone.css" />

    <!-- light-box -->
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="screen" />

    <!-- Begin emoji-picker Stylesheets -->
    <link href="assets/emoji/lib/css/emoji.css" rel="stylesheet">
    <!-- End emoji-picker Stylesheets -->



	</head>
  <style media="screen">
  @viewport{
    zoom: 1.0;
    width : extend-to-zoom;
  }
  @-ms-viewport{
    width: extend-to-zoom;
    zoom: 1.0;
  }
  </style>
  <body>


    <header id="header"><!--header-->
      <div class="header_top"><!--header_top-->
        <div class="container">
          <div class="row" style="background:rgba(93,84,240,8.5)">
            <div class="col-xs-6 col-sm-6">
              <div class="contactinfo">
                <ul class="nav nav-pills top-contact-address">
                  <li><a href="#"><i class="fa fa-phone"></i> +706 654 1485</a></li>
                  <li><a href="#"><i class="fa fa-envelope"></i> oweipadeijoshie@gmail.com</a></li>
                </ul>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <?php if (isset($_SESSION['Id']) && isset($_SESSION['email'])) { ?>
              <ul class="nav navbar-nav navbar-right">
                <!-- SMALL PROFILE DETAILS -->
                <li class="dropdown pull-right" style="padding:0px 18px 0px 18px; margin:0px">
                  <a href="javascript:;" class="profile_icon pull-right" style="padding-top:0px; padding-bottom:0px;font-size:14px;font-weight:400;font-family:arial" data-toggle="dropdown" aria-expanded="false">
                    <img src="uploaded_images/<?php echo $profile_img; ?>" alt=""><?php echo $firstname." ".$lastname; ?>
                  </a>
                </li>
                <!-- END OF SMALL PROFILE DETAILS -->
                <!-- ALL NOTIFICATIONS -->
                <?php
                $sql1 = "SELECT * FROM friendship WHERE receiver = '$userID'";
                $query1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                if ($query1) {
                  if (mysqli_num_rows($query1) != 0) {
                    $notic_count = mysqli_num_rows($query1);
                ?>
                <li role="presentation" class="dropdown pull-left top-notification">
                  <a class="info-number" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="All Notificcations">
                    <i class="fa fa-bell" style="font-size:21px"></i>
                    <span class="badge bg-green"><?php echo $notic_count; ?></span>
                  </a>
                </li>
                <?php
                    } else {
                ?>
                <li role="presentation" class="dropdown pull-left top-notification">
                  <a class="info-number" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="All Notifications">
                    <i class="fa fa-bell" style="font-size:21px"></i>
                  </a>
                </li>
                <?php
                    }
                  }
                 ?>
                <!-- END OF ALL NOTIFICATION -->

                <!-- MESSAGE NOTIFICATION -->
                <?php
                  $sql3 = "SELECT * FROM messages WHERE receiverId = '$userID' AND  receiver_read = 'No'";
                  $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                  if ($query3) {
                    if (mysqli_num_rows($query3) != 0) {
                      $unread_count = mysqli_num_rows($query3);
                ?>
                <li role="presentation" class="dropdown pull-left top-notification">
                  <a class="info-number" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="MESSAGES">
                    <i class="fa fa-envelope-o" style="font-size:21px"></i>
                    <span class="badge bg-green"><?php echo $unread_count; ?></span>
                  </a>
                </li>
                <?php
                    } else {
                ?>
                <li role="presentation" class="dropdown pull-left top-notification">
                  <a class="info-number" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="MESSAGES">
                    <i class="fa fa-envelope-o" style="font-size:21px"></i>
                  </a>
                </li>
                <?php
                    }
                  }
                 ?>
                <!-- END OF MESSAGE NOTIFICATIONS -->
              </ul>
              <?php } ?>
            </div>
          </div>
        </div>
      </div><!--/header_top-->

      <div class="cover_wall">
        <div class="showcase">
          <div class="header-middle"><!--header-middle-->
            <div class="container">
              <div class="row">
                <div class="col-sm-6 md-end">

                </div>
                <div class="col-sm-6">
                  <div class="shop-menu">
                    <ul class="nav navbar-nav pull-right">
                      <?php
                        if (isset($_SESSION['Id'])) {
                          echo "<li><a href='profile_page.php' style='padding:4px 8px; color:#00004d'><i class='fa fa-refresh'></i></a></li>";
                          echo "<li><a href='index.php' style='padding:4px 8px;'> Home</a></li>";
                        }
                       ?>
                      <?php
                        if (!isset($_SESSION['Id'])) {
                          echo "<li><a href='register.php' style='padding:4px 8px; border-radius:5px; background:red; color:#fff'><i class='fa fa-plus-square'></i> Register</a></li>";
                        }
                       ?>
                       <?php
                         if (isset($_SESSION['Id'])) {
                           echo "<li><a href='logout.php' style='padding:4px 8px; color:red'><i class='fa fa-sign-out'></i> Log out</a></li>";
                         } else {
                           echo "<li><a href='login.php' style='padding:4px 8px; border-radius:5px; background:red; color:#fff'><i class='fa fa-sign-in'></i> Log in</a></li>";
                         }
                        ?>
                    </ul>
                  </div>
                  <div class="clearfix"></div>

                </div>
              </div>
            </div>
          </div><!--/header-middle-->

        </div>
      </div>
    </header><!--/header-->




  <?php if (isset($_SESSION['Id'])): ?>
    <input type="hidden" name="id" id="userID" value="<?php echo $userID; ?>">
  <?php endif; ?>

    <div class="container-fluid" style="margin:0px 6px">
      <div class="row">
        <div class="col-sm-3">
          <div class="profile_side">
            <div class="picture">
              <!--IMAGE FILE-->
              <input type="file" name="image" id="newAvatar" style="display:none">
                <?php
                echo "<div class='pic'>";
                if ($profile_img != "profiledefault.png"){
                  echo "<div class='img_section magnifier2'>
                          <a class='fancybox' href='uploaded_images/".$profile_img."' data-fancybox-group='gallery' title='".$firstname." ".$lastname."'>
                          <div class='img_container'>
                            <img src='uploaded_images/".$profile_img."' width='100%' height='100%'> <span> </span>
                          </div>
                          </a>
                        </div>
                        ";
                } else {
                  echo "<div class='img_section magnifier2'>
                          <a class='fancybox' href='uploaded_images/profiledefault.png' data-fancybox-group='gallery' title=''>
                            <img src='uploaded_images/profiledefault.png' width='100%' height='100%'>
                          </a>
                        </div>
                  ";
                }
                echo "<button type='button' class='Avatar upload_pic' title='Change Profile Pic'> <i class='fa fa-camera'></i> </button>";
                echo "</div>";
                ?>
                <h2><?php if (isset($_SESSION['Id'])) { echo $firstname." ".$lastname; }?></h2>



              <!--from quote in the database-->

              <?php
                $query = "SELECT * FROM quotes WHERE userId = '$userID'";
                $resultQuote = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if ($resultQuote) {
                  if (mysqli_num_rows($resultQuote) == 1) {
                    if ($user_quote = mysqli_fetch_array($resultQuote)) {
                      $quote = $user_quote['quote'];
                      $quote_time = $user_quote['time'];

                      date_default_timezone_set("Africa/Lagos");
                      $time_ago = strtotime($quote_time);
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
                    }
                  }
                }
               ?>
              <p><span class="says">Quote: </span> <span class="quote"><?php if(isset($quote)){ echo $quote; } ?></span> <i class="fa fa-pencil"></i> <span class="time"><?php if(isset($ago)){ echo $ago; } ?></span> </p>
            </div>

            <div class="sidemenubar">
              <li><a href="profile_page.php?timeline" class="list-group-item list-group-item-action"><i style="font-size:18px" class="fa fa-newspaper-o"></i> Timelines <i style="float:right; font-size:18px" class="fa fa-angle-right"></i></a></li>
              <li><a href="/FUOBoxMedia/friends/friend_personal_msg.php" class="list-group-item list-group-item-action"><i style="font-size:18px" class="fa fa-envelope-o"></i> Messages <i style="float:right; font-size:18px" class="fa fa-angle-right"></i></a></li>
              <li><a href="profile_page.php?user%theirsafefriendslist" class="list-group-item list-group-item-action"><i style="font-size:18px" class="fa fa-users"></i> Friends <i style="float:right; font-size:18px" class="fa fa-angle-right"></i></a></li>
              <li><a href="profile_page.php?edit-account" class="list-group-item list-group-item-action"><i style="font-size:18px" class="fa fa-edit"></i> Edit Account<i style="float:right; font-size:18px" class="fa fa-angle-right"></i></a></li>
            </div>

            <!-- hide the active users inedit page -->
            <?php if(!isset($_GET['user%theirsafefriendslist'])): ?>
              <?php if(!isset($_GET['edit-account'])): ?>
                <div class="chat-sidebar chat-sidebar-2">
                  <?php
                  $sql2 = "SELECT * FROM myfriends WHERE myId = '$userID' OR myfriends = '$userID'";
                  $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                  if ($query2) {
                    if (mysqli_num_rows($query2) != 0) {

                      while ($_row = mysqli_fetch_array($query2)) {
                        $myId = $_row['myId'];
                        $friend_Id = $_row['myfriends'];
                        $userID = $_SESSION['Id'];

                        if ($userID == $myId) {
                          $sql3 = "SELECT * FROM myfriends WHERE myfriends = '$userID'";
                          $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                          if ($query3) {
                            $row = mysqli_fetch_array($query3);
                            $user_id_1 = $row['myfriends'];

                            $sql5 = "SELECT * FROM users_account WHERE Id = '$user_id_1' AND active = 1";
                            $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
                            if ($query5) {
                              if (mysqli_num_rows($query5) != 0) {
                                if ($user_row = mysqli_fetch_array($query5)) {
                                  ?>
                                  <div class="sidebar-name">
                                    <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $user_row['Id']; ?>">
                                      <img src="uploaded_images/<?php echo $user_row['profile_img']; ?>" />
                                      <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                                      <span class="pull-right"><?php if ($user_row['active'] == 1){ echo " <span style='font-size:8px'> Online</span> <i class='fa fa-circle' style='color:#00cc00'></i>";} ?></span>
                                    </a>
                                    <div class="clearfix"></div>
                                  </div>
                                 <?php
                                }
                              } else {
                                $sql7 = "SELECT * FROM users_account WHERE Id = '$user_id_1' AND active = 0";
                                $query7 = mysqli_query($conn, $sql7) or die(mysqli_error($conn));
                                if ($query7) {
                                  if (mysqli_num_rows($query7) != 0) {
                                    if ($offline_user_row = mysqli_fetch_array($query7)) {

                                      // DISPLAYING THE SEEN OF THE USER
                                      date_default_timezone_set("Africa/Lagos");
                                      $time_ago = strtotime($offline_user_row['last_seen']);
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
                                            $ago = round($time/60).' min(s) ago';
                                          }
                                          break;

                                          // hour
                                          case $time >= 3600 && $time < 86400;
                                          if (round($time/3600) == 1) {
                                            $ago = 'an hour ago';
                                          } else {
                                            $ago = round($time/3600).' hr(s) ago';
                                          }
                                          break;

                                          // days
                                          case $time >= 86400 && $time < 604800;
                                          if (round($time/86400) == 1) {
                                            $ago = 'a day ago';
                                          } else {
                                            $ago = round($time/86400).' day(s) ago';
                                          }
                                          break;

                                          // weeks
                                          case $time >= 604800 && $time < 2600640;
                                          if (round($time/604800) == 1) {
                                            $ago = 'a week ago';
                                          } else {
                                            $ago = round($time/604800).' wk(s) ago';
                                          }
                                          break;

                                          // months
                                          case $time >= 2600640 && $time < 31207680;
                                          if (round($time/2600640) == 1) {
                                            $ago = 'a month ago';
                                          } else {
                                            $ago = round($time/2600640).' mnth(s) ago';
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
                                      <div class="sidebar-name">
                                        <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $offline_user_row['Id']; ?>">
                                          <img src="uploaded_images/<?php echo $offline_user_row['profile_img']; ?>" />
                                          <span><?php echo $offline_user_row['first_name']." ".$offline_user_row['last_name']; ?></span>
                                          <span class="pull-right"><?php if ($offline_user_row['active'] == 0){ echo " <span style='font-size:8px'> ".$ago."</span> <i class='fa fa-circle' style='color:#ff6666'></i>";} ?></span>
                                        </a>
                                        <div class="clearfix"></div>
                                      </div>
                                     <?php
                                    }
                                  }
                                }
                              }
                            }

                          }
                        } else {
                          $sql4 = "SELECT * FROM myfriends WHERE myfriends = '$userID'";
                          $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                          if ($query4) {
                            $rrow = mysqli_fetch_array($query4);
                            $user_id_2 = $rrow['myId'];

                            $sql6 = "SELECT * FROM users_account WHERE Id = '$user_id_2' AND active = 1";
                            $query6 = mysqli_query($conn, $sql6) or die(mysqli_error($conn));
                            if ($query6) {
                              if (mysqli_num_rows($query6) != 0) {
                                if ($user_row = mysqli_fetch_array($query6)) {
                                  ?>
                                  <div class="sidebar-name" id="<?php echo $user_row['email']; ?>">
                                    <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $user_row['Id']; ?>">
                                      <img src="uploaded_images/<?php echo $user_row['profile_img']; ?>" />
                                      <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                                      <span class="pull-right"><?php if ($user_row['active'] == 1){ echo " <span style='font-size:8px'> Online</span> <i class='fa fa-circle' style='color:#00cc00'></i>";} ?></span>
                                    </a>
                                  </div>
                                 <?php
                                }
                              } else {
                                $sql7 = "SELECT * FROM users_account WHERE Id = '$user_id_2' AND active = 0";
                                $query7 = mysqli_query($conn, $sql7) or die(mysqli_error($conn));
                                if ($query7) {
                                  if (mysqli_num_rows($query7) != 0) {
                                    if ($offline_user_row = mysqli_fetch_array($query7)) {

                                      // DISPLAYING THE SEEN OF THE USER
                                      date_default_timezone_set("Africa/Lagos");
                                      $time_ago = strtotime($offline_user_row['last_seen']);
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
                                            $ago = round($time/60).' min(s) ago';
                                          }
                                          break;

                                          // hour
                                          case $time >= 3600 && $time < 86400;
                                          if (round($time/3600) == 1) {
                                            $ago = 'an hour ago';
                                          } else {
                                            $ago = round($time/3600).' hr(s) ago';
                                          }
                                          break;

                                          // days
                                          case $time >= 86400 && $time < 604800;
                                          if (round($time/86400) == 1) {
                                            $ago = 'a day ago';
                                          } else {
                                            $ago = round($time/86400).' day(s) ago';
                                          }
                                          break;

                                          // weeks
                                          case $time >= 604800 && $time < 2600640;
                                          if (round($time/604800) == 1) {
                                            $ago = 'a week ago';
                                          } else {
                                            $ago = round($time/604800).' wk(s) ago';
                                          }
                                          break;

                                          // months
                                          case $time >= 2600640 && $time < 31207680;
                                          if (round($time/2600640) == 1) {
                                            $ago = 'a month ago';
                                          } else {
                                            $ago = round($time/2600640).' mnth(s) ago';
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
                                      <div class="sidebar-name">
                                        <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $offline_user_row['Id']; ?>">
                                          <img src="uploaded_images/<?php echo $offline_user_row['profile_img']; ?>" />
                                          <span><?php echo $offline_user_row['first_name']." ".$offline_user_row['last_name']; ?></span>
                                          <span class="pull-right"><?php if ($offline_user_row['active'] == 0){ echo " <span style='font-size:8px'> ".$ago."</span> <i class='fa fa-circle' style='color:#ff6666'></i>";} ?></span>
                                        </a>
                                      </div>
                                     <?php
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
      //gg
                      }
                    } else {
                      echo "<span style='padding-left:10px; font-family:Gabriola; font-size:18px; color:#fff'>
                              You do not have any friends yet.
                            </span>";
                    }
                  }
      //end
                   ?>
                    <!-- FRIEND REQUEST -->
                    <div class="" style="margin-top:50px">
                      <div class="friend_request_box">
                        <h4 class="text-center">Friend Requests</h4>
                        <?php
                        $sql = "SELECT * FROM friendship WHERE receiver = '$userID'";
                        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        if ($query) {
                          if (mysqli_num_rows($query) > 0) {
                            while ($_row = mysqli_fetch_array($query)) {
                              $friend_Id = $_row['sender'];

                              $sql2 = "SELECT * FROM users_account WHERE Id = '$friend_Id'";
                              $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                              if ($query2) {
                                while ($row = mysqli_fetch_array($query2)) {
                        ?>
                        <div class="w3-container">
                          <img src="/FUOBoxMedia/uploaded_images/<?php echo $row['profile_img']; ?>" alt="<?php echo $row['username']; ?>" width="50px" height="50px">
                          <span><?php echo $row['first_name']." ".$row['last_name']; ?></span>
                          <div class="w3-row text-center">
                            <div class="request-btn text-center">
                              <button id="accept_<?php echo $row['Id']; ?>" accept="<?php echo $row['Id']; ?>" class="btn btn-success accept_request" title="Accept">Accept</button>
                              <button id="delete_<?php echo $row['Id']; ?>" delete="<?php echo $row['Id']; ?>" class="btn btn-danger delete_request" title="Decline">Decline</button>
                            </div>
                            <?php if (isset($_SESSION['Id'])): ?>
                              <input type="hidden" id="userID" value="<?php echo $userID; ?>">
                            <?php endif; ?>
                          </div>
                        </div>
                        <?php
                                }
                              }
                            }
                          } else {
                            echo "<span style='font-family:Gabriola; font-size:20px; line-height:0.9em; color:#fff'>
                                    You do not have any friend request pending.
                                  </span>";
                          }
                        }
                         ?>
                      </div>
                    </div>
                    <!-- END OF FRIEND REQUEST -->
                </div>
              <?php endif; ?>
            <?php endif; ?>
            <!-- end of hide the active users in friends-list, edit-account page -->

            <div class="panel-body friends_photos">
              <!--friends-->
              <h4 class="text-title">People You May Know</h4>
              <div>
                <?php

                $sql = "SELECT * FROM users_account WHERE Id <> '$userID' ORDER BY RAND() LIMIT 0,20";
                $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if ($query) {
                  while ($row = mysqli_fetch_array($query)) {
                    $member_Id = $row['Id'];
                    $userID = $_SESSION['Id'];

                    /* below check if the friend is already your friend */
                    $sql2 = "SELECT * FROM myfriends WHERE (myId = '$userID' AND myfriends = '$member_Id') OR (myId = '$member_Id' AND myfriends = '$userID')";
                    $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                    if ($query2) {
                      if (mysqli_num_rows($query2) > 0) {
                        while ($row = mysqli_fetch_array($query2)) {
                          $myfriends = $member_Id;

                          $userID = $_SESSION['Id'];
                          if ($userID == $myfriends) {
                            $myfriends_1 = $row['myfriends'];

                            $sql3 = "SELECT * FROM users_account WHERE Id = '$myfriends_1'";
                            $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                            if ($query3) {
                              $_row = mysqli_fetch_array($query3);
                              echo "<span style='color:#'> friends </span>";
                            }

                          } else {
                            $sql4 = "SELECT * FROM users_account WHERE Id = '$myfriends'";
                            $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                          }
                        }
                      } else {
                 ?>
                 <div class="col-lg-4 col-md-4 col-xs-6 col-sm-6 friend_col" style="padding:2px">
                   <div class="fri">
                     <a href="friends/friend_profile.php?friend_id=<?php echo $row['Id'] ?>" class="friend" title="<?php echo $row['first_name']." ".$row['last_name']; ?>">
                       <img src="uploaded_images/<?php echo $row['profile_img']; ?>"/>
                       <span><i class="fa fa-at"></i> <?php echo $row['username']; ?></span>
                     </a>
                   </div>
                 </div>
               <?php } } } } ?>
              </div>
              <!--end of friends-->
            </div>
          </div>
        </div>
        <div class="col-sm-9">
        <!-- START TIMELINE ITEM -->
          <!-- STATUS AND POST -->
          <div class="right-big-side">
            <?php
            if (!isset($_GET['timeline'])) {
              if (!isset($_GET['usertheirsafephotos'])) {
                if (!isset($_GET['user%theirsafefriendslist'])) {
                  if (!isset($_GET['edit-account'])) {
             ?>
            <div class="col-sm-12">
              <div class="quote_box">
                <div class="modal-header">
                  <h4 class="modal-title">Daily Saying</h4>
                </div>
                <div class="modal-body">
                  <span>Your daily status is visible to everyone <i class="fa fa-eye"></i> <span>(255 words).</span></span>
                  <p style="font-size:11px"><span class="err pull-right"></span> </p>
                  <?php
                  $get_quote = "SELECT * FROM quotes WHERE userId = $userID";
                  $query_quote = mysqli_query($conn, $get_quote) or die(mysqli_error($conn));
                  if ($query_quote) {
                    if (mysqli_num_rows($query_quote) == 1) {
                      if ($row = mysqli_fetch_array($query_quote)) {
                        $user_quote = $row['quote'];
                      }
                    }
                  }
                   ?>
                  <div class="form-group">
                    <input type="text" class="form-control quote_text" placeholder="<?php if (!isset($user_quote)) { echo "Your daily saying..!";} ?>"
                    value="<?php if (isset($user_quote)) { echo $user_quote;} ?>" data-emojiable="true">
                  </div>
                </div>
                <div class="quote_footer_btn">
                  <button type="submit" class="btn btn-success pull-right quote"> <i class="fa fa-send"></i> </button>
                  <button type="button" class="btn btn-danger pull-right delete_quote">Delete</button>
                </div>
                <br><br>
                <div class='quote_msg'></div>
              </div>
            </div>
            <?php
                    }
                  }
                }
              }
             ?>


            <!-- SUCCESS
            <div class="alert alert-success alert-dismissible fade in" role="alert" style="background:#339933; color:#000">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
            </div>
            PRIMARY
            <div class="alert alert-info alert-dismissible fade in" role="alert" style="background:#3399ff; color:#fff">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
            </div>
            WARNIN
            <div class="alert alert-warning alert-dismissible fade in" role="alert" style="background:#ff6600; color:#fff">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
            </div>
            DANGER
            <div class="alert alert-danger alert-dismissible fade in" role="alert" style="background:#ff3300; color:#fff">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
            </div> -->
            <?php
            if (!isset($_GET['timeline'])) {
              if (!isset($_GET['user%theirsafefriendslist'])) {
                if (!isset($_GET['edit-account'])) {
                  echo "<div style='padding:0px 30px 130px 30px; color:#4d4d4d; font-family:arial'>

                          <h2 style='font-style:oblique; font-size:16px; text-transform:uppercase; color:rgba(93,84,240,8.5)'><b>Make the most of your profile.</b></h2>
                          <div style='height:3px; background:#e1e1e1'></div>
                          <br>
                          <p>Everything here is optional, it just feels nice to have a profile that is complete and looking good.</p>
                          <p>You're lot more recognizable around FUOBoxMedia with an avatar.</p>
                          <h4><b>Upload a new avatar</b></h4>
                          <div style='width:260px; border:2px dashed #fff; background:rgb(255, 92, 51); color:#fff; padding:20px'>
                            <p>TO CHANGE YOUR AVATAR, CLICK ON THE CAMERA ICON AND SELECT A FILE (not more than 2MB). Your picture will be automatically be uploaded.
                          </div>
                          <div class='pull-left' style='margin-top:10px'>
                            <b style='color:#fff; padding:1px 3px; background:rgba(93,84,240,8.5); border-radius:3px'><em>NOTE :</em></b>
                            Please, Select the only images (.jpg, .jpeg, .png) to upload with the size of minimum 2MB.
                          </div>
                        </div>";
                }
              }
            }
            ?>


            <?php
            if (isset($_GET['timeline'])) {
                include ('users/timeline.php');
              }
            ?>
            <?php
            if (isset($_GET['user%theirsafefriendslist'])) {
                include ('users/friend_list.php');
              }
            ?>
            <?php
            if (isset($_GET['edit-account'])) {
              include ('users/edit_account.php');
            }
             ?>
          </div>

          <!-- hide the active users inedit page -->
          <?php if(!isset($_GET['user%theirsafefriendslist'])): ?>
            <?php if(!isset($_GET['edit-account'])): ?>
              <div class="right-small-side">
                <div class="chat-sidebar">
                  <?php
                  $sql2 = "SELECT * FROM myfriends WHERE myId = '$userID' OR myfriends = '$userID'";
                  $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                  if ($query2) {
                    if (mysqli_num_rows($query2) != 0) {

                      while ($_row = mysqli_fetch_array($query2)) {
                        $myId = $_row['myId'];
                        $friend_Id = $_row['myfriends'];
                        $userID = $_SESSION['Id'];

                        if ($userID == $myId) {
                          $sql3 = "SELECT * FROM myfriends WHERE myfriends = '$friend_Id'";
                          $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                          if ($query3) {
                            $row = mysqli_fetch_array($query3);
                            $user_id_1 = $row['myfriends'];

                            $sql5 = "SELECT * FROM users_account WHERE Id = '$user_id_1' AND active = 1";
                            $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
                            if ($query5) {
                              if (mysqli_num_rows($query5) != 0) {
                                if ($user_row = mysqli_fetch_array($query5)) {
                                  ?>
                                  <div class="sidebar-name">
                                    <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $user_row['Id']; ?>">
                                      <img src="uploaded_images/<?php echo $user_row['profile_img']; ?>" />
                                      <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                                      <span class="pull-right"><?php if ($user_row['active'] == 1){ echo " <span style='font-size:8px'> Online</span> <i class='fa fa-circle' style='color:#00cc00'></i>";} ?></span>
                                    </a>
                                    <div class="clearfix"></div>
                                  </div>
                                 <?php
                                }
                              } else {
                                $sql7 = "SELECT * FROM users_account WHERE Id = '$user_id_1' AND active = 0";
                                $query7 = mysqli_query($conn, $sql7) or die(mysqli_error($conn));
                                if ($query7) {
                                  if (mysqli_num_rows($query7) != 0) {
                                    if ($offline_user_row = mysqli_fetch_array($query7)) {

                                      // DISPLAYING THE SEEN OF THE USER
                                      date_default_timezone_set("Africa/Lagos");
                                      $time_ago = strtotime($offline_user_row['last_seen']);
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
                                            $ago = round($time/60).' min(s) ago';
                                          }
                                          break;

                                          // hour
                                          case $time >= 3600 && $time < 86400;
                                          if (round($time/3600) == 1) {
                                            $ago = 'an hour ago';
                                          } else {
                                            $ago = round($time/3600).' hr(s) ago';
                                          }
                                          break;

                                          // days
                                          case $time >= 86400 && $time < 604800;
                                          if (round($time/86400) == 1) {
                                            $ago = 'a day ago';
                                          } else {
                                            $ago = round($time/86400).' day(s) ago';
                                          }
                                          break;

                                          // weeks
                                          case $time >= 604800 && $time < 2600640;
                                          if (round($time/604800) == 1) {
                                            $ago = 'a week ago';
                                          } else {
                                            $ago = round($time/604800).' wk(s) ago';
                                          }
                                          break;

                                          // months
                                          case $time >= 2600640 && $time < 31207680;
                                          if (round($time/2600640) == 1) {
                                            $ago = 'a month ago';
                                          } else {
                                            $ago = round($time/2600640).' mnth(s) ago';
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
                                      <div class="sidebar-name">
                                        <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $offline_user_row['Id']; ?>">
                                          <img src="uploaded_images/<?php echo $offline_user_row['profile_img']; ?>" />
                                          <span><?php echo $offline_user_row['first_name']." ".$offline_user_row['last_name']; ?></span>
                                          <span class="pull-right"><?php if ($offline_user_row['active'] == 0){ echo " <span style='font-size:8px'> ".$ago."</span> <i class='fa fa-circle' style='color:#ff6666'></i>";} ?></span>
                                        </a>
                                        <div class="clearfix"></div>
                                      </div>
                                     <?php
                                    }
                                  }
                                }
                              }
                            }

                          }
                        } else {
                          $sql4 = "SELECT * FROM myfriends WHERE myfriends = '$userID'";
                          $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                          if ($query4) {
                            $rrow = mysqli_fetch_array($query4);
                            $user_id_2 = $rrow['myId'];

                            $sql6 = "SELECT * FROM users_account WHERE Id = '$user_id_2' AND active = 1";
                            $query6 = mysqli_query($conn, $sql6) or die(mysqli_error($conn));
                            if ($query6) {
                              if (mysqli_num_rows($query6) != 0) {
                                if ($user_row = mysqli_fetch_array($query6)) {
                                  ?>
                                   <div class="sidebar-name" id="<?php echo $user_row['email']; ?>">
                                     <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $user_row['Id']; ?>">
                                       <img src="uploaded_images/<?php echo $user_row['profile_img']; ?>" />
                                       <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                                       <span class="pull-right"><?php if ($user_row['active'] == 1){ echo " <span style='font-size:8px'> Online</span> <i class='fa fa-circle' style='color:#00cc00'></i>";} ?></span>
                                     </a>
                                   </div>
                                 <?php
                                }
                              } else {
                                $sql7 = "SELECT * FROM users_account WHERE Id = '$user_id_2' AND active = 0";
                                $query7 = mysqli_query($conn, $sql7) or die(mysqli_error($conn));
                                if ($query7) {
                                  if (mysqli_num_rows($query7) != 0) {
                                    if ($offline_user_row = mysqli_fetch_array($query7)) {

                                      // DISPLAYING THE SEEN OF THE USER
                                      date_default_timezone_set("Africa/Lagos");
                                      $time_ago = strtotime($offline_user_row['last_seen']);
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
                                            $ago = round($time/60).' min(s) ago';
                                          }
                                          break;

                                          // hour
                                          case $time >= 3600 && $time < 86400;
                                          if (round($time/3600) == 1) {
                                            $ago = 'an hour ago';
                                          } else {
                                            $ago = round($time/3600).' hr(s) ago';
                                          }
                                          break;

                                          // days
                                          case $time >= 86400 && $time < 604800;
                                          if (round($time/86400) == 1) {
                                            $ago = 'a day ago';
                                          } else {
                                            $ago = round($time/86400).' day(s) ago';
                                          }
                                          break;

                                          // weeks
                                          case $time >= 604800 && $time < 2600640;
                                          if (round($time/604800) == 1) {
                                            $ago = 'a week ago';
                                          } else {
                                            $ago = round($time/604800).' wk(s) ago';
                                          }
                                          break;

                                          // months
                                          case $time >= 2600640 && $time < 31207680;
                                          if (round($time/2600640) == 1) {
                                            $ago = 'a month ago';
                                          } else {
                                            $ago = round($time/2600640).' mnth(s) ago';
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
                                      <div class="sidebar-name">
                                        <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $offline_user_row['Id']; ?>">
                                          <img src="uploaded_images/<?php echo $offline_user_row['profile_img']; ?>" />
                                          <span><?php echo $offline_user_row['first_name']." ".$offline_user_row['last_name']; ?></span>
                                          <span class="pull-right"><?php if ($offline_user_row['active'] == 0){ echo " <span style='font-size:8px'> ".$ago."</span> <i class='fa fa-circle' style='color:#ff6666'></i>";} ?></span>
                                        </a>
                                      </div>
                                     <?php
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
      //gg
                      }
                    } else {
                      echo "<div style='padding:1px 8px; font-family:Gabriola; font-size:20px; color:#fff'>
                              <span>You do not have any friends yet.</span>
                            </div>";
                    }
                  }
      //end
                   ?>
                    <!-- FRIEND REQUEST -->
                    <div class="" style="margin-top:50px">
                      <div class="friend_request_box">
                        <h4 class="text-center">Friend Requests</h4>
                        <?php
                        $sql = "SELECT * FROM friendship WHERE receiver = '$userID' ORDER BY Id DESC";
                        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        if ($query) {
                          if (mysqli_num_rows($query) > 0) {
                            while ($_row = mysqli_fetch_array($query)) {
                              $friend_Id = $_row['sender'];

                              $sql2 = "SELECT * FROM users_account WHERE Id = '$friend_Id'";
                              $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                              if ($query2) {
                                while ($row = mysqli_fetch_array($query2)) {
                        ?>
                        <div class="w3-container">
                          <img src="/FUOBoxMedia/uploaded_images/<?php echo $row['profile_img']; ?>" alt="<?php echo $row['username']; ?>" width="50px" height="50px">
                          <span><?php echo $row['first_name']." ".$row['last_name']; ?></span>
                          <div class="w3-row text-center">
                            <div class="request-btn text-center">
                              <button id="accept_<?php echo $row['Id']; ?>" accept="<?php echo $row['Id']; ?>" class="btn btn-success accept_request" title="Accept">Accept</button>
                              <button id="delete_<?php echo $row['Id']; ?>" delete="<?php echo $row['Id']; ?>" class="btn btn-danger delete_request" title="Decline">Decline</button>
                            </div>
                            <?php if (isset($_SESSION['Id'])): ?>
                              <input type="hidden" id="userID" value="<?php echo $userID; ?>">
                            <?php endif; ?>
                          </div>
                        </div>
                        <?php
                                }
                              }
                            }
                          } else {
                            echo "<span style='font-family:Gabriola; font-size:20px; line-height:0.9em; color:#fff'>
                                    You do not have any friend request pending.
                                  </span>";
                          }
                        }
                         ?>
                      </div>
                    </div>
                    <!-- END OF FRIEND REQUEST -->
                </div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <!-- end of hide the active users in friends-list, edit-account page -->
          <!-- END OF STATUS AND POST -->

        </div><!-- END right-hand-side -->

      </div>
    </div>









    <!--<script src="css/plugins/jquery.blueimp-gallery.min.js"></script>-->

        <!-- jQuery -->
        <script type="text/javascript" src="js/plugins/jquery/jquery-3.3.1.min.js"></script>


        <!-- jQuery Plugin - upload multiple images ajax -->
        <script type="text/javascript">
          (function (){
//             var input = document.getElementById('fileUpload'),
//             formdata = false;
//
//
//             // function showUploadedItem (source){
//             //   var list = document.getElementById("image-list"),
//             //       li = document.createElement("li"),
//             //       img = document.createElement("img");
//             //   img.src = source;
//             //   li.appendChild(img);
//             //   list.appendChild(li);
//             // }
//
//             if (window.FormData) {
//               formdata = new FormData();
//               document.getElementById("bbtn").style.display = "none";
//             }
//
//             input.addEventListener("change", function (evt){
//               // document.getElementById("response").innerHTML = "Uploading . . .";
//               var i = 0, len = this.files.length, img, reader, file;
//
//               for ( ; i < len; i++) {
//                 file = this.files[i];
//
//                 if (!!file.type.match(/image.*/)) {
//                   // if ( window.FileReader ) {
//                   //   reader = new FileReader();
//                   //   reader.onloadend = function (e) {
//                   //     showUploadedItem(e.target.result, file.fileName);
//                   //   };
//                   //   reader.readAsDataURL(file);
//                   // }
//                   if (formdata) {
//                     formdata.append("images[]", file);
//                   }
//                 }
//               }
// // alert(formdata);
//               if (formdata) {
//                 $.ajax({
//                   url : "/FUOBoxMedia/ajax/add_comment.php",
//                   type : "POST",
//                   data : formdata,
//                   processData : false,
//                   contentType : false,
//                   success : function (res) {
//                     document.getElementById("image-holder").innerHTML = res;
//                   }
//                 });
//               }
//             }, false);
          }());
        </script>
        <script src='master/js/uploadImages.js'></script>



<script type="text/javascript" src="js/comment/comment-insert.js?t=<?php echo time(); ?> "></script>
<script src="admin-panel/vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="admin-panel/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- <script src="js/plugins/bootstrap-4.0.0/bootstrap.min.js"></script> -->
        <!-- <script src="js/plugins/popper.min.js"></script>
        <script src="js/plugins/util.js"></script>
        <script src="js/plugins/tab.js"></script>
        <script src="js/plugins/dropdown.js"></script>
        <script src="js/plugins/collapse.js"></script> -->



    <!-- CUSTOM JS -->
    <script src="js/custom/dist/custom.min.js"></script>
    <script type="text/javascript" src="js/custom/user_scriptsheet.js"></script>
    <script src="js/custom/profile.js"></script>
    <script>
      $(document).ready(function(){
        // Simple image gallery. Uses default settings
        $('.fancybox').fancybox();

      });
    </script>
    <!-- light-box -->
	  <script type="text/javascript" src="js/jquery.fancybox.js"></script>


    <!-- PLUGINS JS -->
    <script type="text/javascript" src="js/plugins/dropzone/dropzone.js"></script>
    <script src="js/plugins/jquery/jQuery.Form.js"></script>

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
    <script>
      // Google Analytics
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-49610253-3', 'auto');
      ga('send', 'pageview');
    </script>


  </body>
</html>
