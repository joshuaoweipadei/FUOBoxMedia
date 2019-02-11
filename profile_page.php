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

include_once 'includes/database.php';

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

    <link rel="stylesheet" href="css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">

    <!-- light-box -->
    <link rel="stylesheet" type="text/css" href="css/plugins/jquery.fancybox.css" media="screen" />

    <!-- custom css -->
    <link rel="stylesheet" href="css/custom/main.css">
    <link rel="stylesheet" href="css/custom/profile.css">

    <!-- Begin emoji-picker Stylesheets -->
    <link href="assets/emoji/lib/css/emoji.css" rel="stylesheet">
    <!-- End emoji-picker Stylesheets -->
	</head>
  <body>
    <?php if (isset($_SESSION['Id'])): ?>
      <input type="hidden" name="id" id="userID" value="<?php echo $userID; ?>">
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
           <li><a href='index.php'><i class='fa fa-home'></i> Home</a></li>
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

    <div class="container">
      <div class="row">
        <!-- profile picture frame -->
        <div class="col-md-12">
          <div class="picture">
            <!--IMAGE FILE-->
            <input type="file" name="image" id="newAvatar" style="display:none">
              <?php
              echo "<div class='pic'>";
              if ($profile_img != "profiledefault.png"){
                echo "<div class='img_section magnifier2'>
                        <a class='fancybox' href='images/uploaded_images/profile_photos/".$profile_img."' data-fancybox-group='gallery' title='".$firstname." ".$lastname."'>
                        <div class='img_container'>
                          <img src='images/uploaded_images/profile_photos/".$profile_img."' width='100%' height='100%' alt='photo'> <span> </span>
                        </div>
                        </a>
                      </div>
                      ";
              } else {
                echo "<div class='img_section magnifier2'>
                        <a class='fancybox' href='images/uploaded_images/profiledefault.png' data-fancybox-group='gallery' title=''>
                          <img src='images/uploaded_images/profile_photos/profiledefault.png' width='100%' height='100%' alt='photo'>
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
              <p><span class="says">Favourite quote: </span> <span class="quote"><?php if(isset($quote)){ echo $quote; } ?></span> ...<i class="fa fa-pencil"></i> <span class="time"><?php if(isset($ago)){ echo $ago; } ?></span> </p>
              <p>
                <a href="profile_page.php" class="btn btn-secondary" style="color:rgba(93,84,240,8.5)"> <i class="fa fa-refresh"></i> Dashboard</a>
                <a href="profile_page.php?friendlistlistfriendah3ina48bs" class="btn btn-secondary" style="color:rgba(93,84,240,8.5)"> <i class="fa fa-male"></i><i class="fa fa-female"></i> Friends </a>
                <a href="profile_page.php?editaccountaccountedit8jwuyrhn" class="btn btn-primary" style="background:rgba(93,84,240,8.5)"> <i class="fa fa-edit"></i> Edit Account</a>

              </p>
              <p></p>
          </div>
        </div><!-- end of profile picture frame -->

        <!-- main profile -->
        <?php
          if (!isset($_GET['friendlistlistfriendah3ina48bs'])) {
            if (!isset($_GET['editaccountaccountedit8jwuyrhn'])) {

         ?>
        <div class="col-md-4">
          <div class="chat-sidebar">
            <h4>Online <i class="fa fa-mobile"></i> </h4>
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

                      $sql5 = "SELECT * FROM users_account WHERE Id = '$user_id_1' AND active = 1 ORDER BY last_seen DESC";
                      $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
                      if ($query5) {
                        if (mysqli_num_rows($query5) != 0) {
                          if ($user_row = mysqli_fetch_array($query5)) {
                            ?>
                            <div class="sidebar-name">
                              <a href="/FUOBoxMedia/user/send_message.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $user_row['Id']; ?>">
                                <img src="images/uploaded_images/profile_photos/<?php echo $user_row['profile_img']; ?>" />
                                <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                                <span class="pull-right"><?php if ($user_row['active'] == 1){ echo " <span style='font-size:8px'> Online</span> <i class='fa fa-circle' style='color:#00cc00'></i>";} ?></span>
                              </a>
                              <div class="clearfix"></div>
                            </div>
                           <?php
                          }
                        } else {
                          $sql7 = "SELECT * FROM users_account WHERE Id = '$user_id_1' AND active = 0 ORDER BY last_seen DESC";
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
                                  <a href="/FUOBoxMedia/user/send_message.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $offline_user_row['Id']; ?>">
                                    <img src="images/uploaded_images/profile_photos/<?php echo $offline_user_row['profile_img']; ?>" />
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
                    $sql4 = "SELECT * FROM myfriends WHERE myId = '$myId'";
                    $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                    if ($query4) {
                      $rrow = mysqli_fetch_array($query4);
                      $user_id_2 = $rrow['myId'];

                      $sql6 = "SELECT * FROM users_account WHERE Id = '$user_id_2' AND active = 1 ORDER BY last_seen DESC";
                      $query6 = mysqli_query($conn, $sql6) or die(mysqli_error($conn));
                      if ($query6) {
                        if (mysqli_num_rows($query6) != 0) {
                          if ($user_row = mysqli_fetch_array($query6)) {
                            ?>
                            <div class="sidebar-name" id="<?php echo $user_row['email']; ?>">
                              <a href="/FUOBoxMedia/user/send_message.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $user_row['Id']; ?>">
                                <img src="images/uploaded_images/profile_photos/<?php echo $user_row['profile_img']; ?>" />
                                <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                                <span class="pull-right"><?php if ($user_row['active'] == 1){ echo " <span style='font-size:8px'> Online</span> <i class='fa fa-circle' style='color:#00cc00'></i>";} ?></span>
                              </a>
                            </div>
                           <?php
                          }
                        } else {
                          $sql7 = "SELECT * FROM users_account WHERE Id = '$user_id_2' AND active = 0 ORDER BY last_seen DESC";
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
                                  <a href="/FUOBoxMedia/user/send_message.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $offline_user_row['Id']; ?>">
                                    <img src="images/uploaded_images/profile_photos/<?php echo $offline_user_row['profile_img']; ?>" />
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
              <div style="margin-top:40px">
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
                  <div class="friend_request">
                  <img src="/FUOBoxMedia/images/uploaded_images/profile_photos/<?php echo $row['profile_img']; ?>" alt="<?php echo $row['username']; ?>" width="58px" height="58px">
                    <a href="">
                      <span><?php echo $row['first_name']." ".$row['last_name']; ?></span>
                    </a>
                    <div class="text-center">
                      <div class="request-btn text-center">
                        <button id="accept_<?php echo $row['Id']; ?>" accept="<?php echo $row['Id']; ?>" class="btn btn-success accept_request" title="Accept">Accept <i class="fa fa-check"></i> </button>
                        <button id="delete_<?php echo $row['Id']; ?>" delete="<?php echo $row['Id']; ?>" class="btn btn-danger delete_request" title="Decline">Decline <i class="fa fa-times"></i></button>
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
              </div><!-- END OF FRIEND REQUEST -->
          </div>
        </div>

        <div class="col-md-8">
          <div class="quote_box">
            <div class="modal-header">
              <h4 class="modal-title">favourite quote</h4>
            </div>
            <div class="modal-body">
              <span>Your daily favourite quote is visible to everyone <i class="fa fa-eye"></i> <span>(255 words).</span></span>
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
              <button type="submit" class="btn btn-success pull-right quote">Upload <i class="fa fa-upload"></i> </button>
              <button type="button" class="btn btn-danger pull-right delete_quote">Remove</button>
            </div>
            <br><br>
            <div class='quote_msg'></div>
          </div>

          <?php
          if (!isset($_GET['timeline'])) {
            if (!isset($_GET['user%theirsafefriendslist'])) {
              if (!isset($_GET['edit-account'])) {
                echo "<div style='margin-bottom:130px; padding:0px 30px 130px 30px; color:#4d4d4d; font-family:arial; border: 1px solid #f2f2f2; box-shadow: 5px 4px 8px 5px #f2f2f2, 5px 6px 20px 5px #f2f2f2;'>

                        <h2 style='font-style:oblique; font-size:16px; text-transform:uppercase; color:rgba(93,84,240,8.5)'><b>Make the most of your profile.</b></h2>
                        <div style='height:3px; background:#e1e1e1'></div>
                        <br>
                        <p>Everything here is optional, it just feels nice to have a profile that is complete and good looking.</p>
                        <p style='color:#595959'>You're lot more recognizable around <span style='color:rgba(93,84,240,8.5)'>FUO<span/><span style='color:rgba(185,0,255,0.9);'>BoxMedia<span/> <span style='color:#595959'>with an avatar.<span/></p>
                        <h4><b>Upload a new avatar</b></h4>
                        <div style='width:100%; border:2px dashed #fff; background:rgba(93,84,240,8.5); color:#fff; padding:20px'>
                          <p>TO CHANGE YOUR AVATAR, CLICK ON THE CAMERA ICON AND SELECT A FILE (not more than 2MB). Your picture will be automatically be uploaded.
                        </div>
                        <div class='pull-left' style='margin-top:20px'>
                          <b style='color:#fff; padding:2px 3px; background:rgba(93,84,240,8.5); border-radius:3px'><em>NOTE :</em></b>
                          Please, Select the only images (.jpg, .jpeg, .png) to upload with the size of minimum 2MB.
                        </div>
                      </div>";
              }
            }
          }
          ?>
        </div>

        <div class="col-md-12">
          <!-- people you may know -->
          <div class="friends_photos">
            <h4 class="text-title"><i class="fa fa-group"></i> People You May Know </h4>
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
               <div class="col-lg-2 col-md-4 col-xs-6 col-sm-4 friend_col" style="padding:4px">
                 <div class="fri">
                   <a href="friend_profile.php?friend_id=<?php echo $row['Id'] ?>" class="friend" title="<?php echo $row['first_name']." ".$row['last_name']; ?>">
                     <img src="images/uploaded_images/profile_photos/<?php echo $row['profile_img']; ?>"/>
                   </a>
                   <span><?php echo $row['first_name']." ".$row['last_name']; ?></span>
                   <span class="username"><i class="fa fa-at"></i> <?php echo $row['username']; ?></span>
                 </div>
               </div>
             <?php } } } } ?>
            </div>
            <div class="clearfix"></div>
          </div><!-- end of people you may know -->
        </div>
      <?php } }?> <!-- end of main profile -->

      <!-- INCLUDING THE EDIT AND FRIEND-LIST PAGE -->
      <?php
        if (isset($_GET['editaccountaccountedit8jwuyrhn'])) {
          include 'user/edit_account.php';
        }
       ?>
       <?php
         if (isset($_GET['friendlistlistfriendah3ina48bs'])) {
           include 'user/friend_list.php';
         }
        ?>
        <!-- END OF INCLUDING THE EDIT AND FRIEND-LIST PAGE -->

      </div>
    </div>

    <!-- jQuery -->
    <script src="js/plugins/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/plugins/bootstrap.min.js"></script>
    <!-- custom js -->
    <script src="js/custom/profile.js"></script>

    <script>
      $(document).ready(function(){
        // Simple image gallery. Uses default settings
        $('.fancybox').fancybox();
      });
    </script>
    <!-- light-box -->
    <script src="js/plugins/jquery.fancybox.js"></script>


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
  </body>
</html>
