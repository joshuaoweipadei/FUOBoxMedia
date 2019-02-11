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

include_once '../includes/database.php';

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

<?php
if (isset($_GET['fri11end1470msgfri36msge70ndmsgmessage'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $sure_member = "";

  $frnd_Id = test_input($_GET['fri11end1470msgfri36msge70ndmsgmessage']);

  if (is_numeric($frnd_Id)) {
    $sql = "SELECT * FROM users_account WHERE Id = '$frnd_Id'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if ($query) {
      if (mysqli_num_rows($query) == 1) {

        $sql2 = "SELECT * FROM myfriends WHERE (myId = '$userID' AND myfriends = '$frnd_Id') OR (myId = '$frnd_Id' AND myfriends = '$userID')";
        $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        if ($query2) {
          if (mysqli_num_rows($query2) == 1) {

            // making sure the user is a real member in the database
            // if the user actual clicks on the exact user
            $sure_member = "";

            // getting the actual details of the friend you are with
            if ($row_frnd_Id = mysqli_fetch_array($query)) {
              $friend_Id = $row_frnd_Id['Id'];
              $friend_firstname = $row_frnd_Id['first_name'];
              $friend_lastname = $row_frnd_Id['last_name'];
              $friend_username = $row_frnd_Id['username'];
              $friend_profile_img = $row_frnd_Id['profile_img'];
              $friend_active = $row_frnd_Id['active'];
            }
            // end of getting the actual details of the friend you are with


            $sql3 = "SELECT * FROM messages WHERE receiverId = '$userID' AND senderId = '$frnd_Id' AND receiver_read = 'No'";
            $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
            if ($query3) {
              if (mysqli_num_rows($query3) > 0) {
                $sql4 = "UPDATE messages SET receiver_read = 'Yes' WHERE receiverId = '$userID' AND senderId = '$frnd_Id'";
                $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                if ($query4) {
                  // do nothing
                }

              }
            }

          } else {
            header('location: /FUOBoxMedia/profile_page.php?user%theirsafefriendslist');
          }
        }
      } else {
        header('location: /FUOBoxMedia/profile_page.php');
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
    <title>FUOBoxMedia | Messgae</title>

    <link rel="stylesheet" href="/FUOBoxMedia/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="/FUOBoxMedia/css/plugins/font-awesome/css/font-awesome.min.css">

    <!-- light-box -->
    <link rel="stylesheet" type="text/css" href="/FUOBoxMedia/css/plugins/jquery.fancybox.css" media="screen" />

    <!-- custom css -->
    <link rel="stylesheet" href="/FUOBoxMedia/css/custom/main.css">
    <link rel="stylesheet" href="/FUOBoxMedia/css/custom/message.css">

    <!-- Begin emoji-picker Stylesheets -->
    <link href="/FUOBoxMedia/assets/emoji/lib/css/emoji.css" rel="stylesheet">
    <!-- End emoji-picker Stylesheets -->

  </head>
  <body>

    <!-- main header -->
    <div class="top-header">
      <div class="pull-left">
        <ul class="nav nav-pills">
          <li style="margin-left:10px"><a href="/FUOBoxMedia/index.php"><span class="logo-name"><i class="fa fa-th-large" style="font-size:26px"></i> <span style="color:#fff" >FUO</span><span style="color:rgba(185,0,255,0.9)">BoxMedia</span></span></a></li>
        </ul>
      </div>
      <div class="pull-right">
        <ul class="nav nav-pills">
          <?php
            if (!isset($_SESSION['Id'])) {
              echo "<li><a href='/FUOBoxMedia/register.php'><i class='fa fa-plus-square'></i> Register</a></li>";
            }
           ?>
           <?php
             if (isset($_SESSION['Id'])) {
               echo "<li><a href='/FUOBoxMedia/logout.php'><i class='fa fa-sign-out'></i> Log out</a></li>";
             } else {
               echo "<li><a href='/FUOBoxMedia/login.php'><i class='fa fa-sign-in'></i> Log in</a></li>";
             }
            ?>
        </ul>
      </div>
      <div class="clearfix"></div>
    </div><!-- end of main header -->


    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="" style="border:1px solid #e1e1e1; box-shadow: 5px 4px 8px 5px #f2f2f2, 5px 6px 20px 5px #f2f2f2; margin-top:10px">

            <?php
              if (isset($sure_member)) {
                ?>
                <div class="friend_details">
                  <div class="friend_details_img_box pull-left">
                    <img src="/FUOBoxMedia/images/uploaded_images/profile_photos/<?php echo $friend_profile_img; ?>" alt="<?php echo $friend_username; ?>">
                  </div>
                  <div class="friend_details_name pull-left">
                    <h4><?php echo $friend_firstname." ".$friend_lastname; ?></h4>
                  </div>
                  <div class="friend_details_back_btn pull-right">
                    <a href="javascript:history.back()" class="pull-left" title="Go back"><i class="fa fa-arrow-circle-left"></i><i class="fa fa-arrow-circle-left"></i></a>
                  </div>
                  <div class="friend_details_back_btn pull-right">
                    <a href="../friend_profile.php?friend_id=<?php echo $friend_Id;?>" class="pull-left" title="Profile"><i class="fa fa-user" style="color:#595959"></i></a>
                  </div>
                  <div class="friend_details_back_btn pull-right">
                    <a class="pull-left"><i class="fa fa-crosshairs" style="color:#595959"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <?php
              }
             ?>

            <!-- Use any element to open the sidenav -->
            <div class="pull-left bar_container" onclick="openNav()">
              <div class="header-title pull-left">
                <h4 class="pull-left"><i class="fa fa-th-list" style="font-size:32px; color:#ff0000"></i> Your Friends </h4>
              </div>
            </div>

            <div class="clearfix"></div>

            <div id="mySidenav" class="sidenav">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
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
                                  <img src="/FUOBoxMedia/images/uploaded_images/profile_photos/<?php echo $user_row['profile_img']; ?>" />
                                  <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                                  <span class="pull-right"><?php if ($user_row['active'] == 1){ echo " <i class='fa fa-circle' style='color:#00cc00'></i>";} ?></span>
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

                                  ?>
                                  <div class="sidebar-name">
                                    <a href="/FUOBoxMedia/user/send_message.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $offline_user_row['Id']; ?>">
                                      <img src="/FUOBoxMedia/images/uploaded_images/profile_photos/<?php echo $offline_user_row['profile_img']; ?>" />
                                      <span><?php echo $offline_user_row['first_name']." ".$offline_user_row['last_name']; ?></span>
                                      <span class="pull-right"><?php if ($offline_user_row['active'] == 0){ echo " <i class='fa fa-circle' style='color:#ff6666'></i>";} ?></span>
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
                                  <img src="/FUOBoxMedia/images/uploaded_images/profile_photos/<?php echo $user_row['profile_img']; ?>" />
                                  <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                                  <span class="pull-right"><?php if ($user_row['active'] == 1){ echo " <i class='fa fa-circle' style='color:#00cc00'></i>";} ?></span>
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

                                  ?>
                                  <div class="sidebar-name">
                                    <a href="/FUOBoxMedia/user/send_message.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $offline_user_row['Id']; ?>">
                                      <img src="/FUOBoxMedia/images/uploaded_images/profile_photos/<?php echo $offline_user_row['profile_img']; ?>" />
                                      <span><?php echo $offline_user_row['first_name']." ".$offline_user_row['last_name']; ?></span>
                                      <span class="pull-right"><?php if ($offline_user_row['active'] == 0){ echo " <i class='fa fa-circle' style='color:#ff6666'></i>";} ?></span>
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
            </div>


            <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
            <div class="col-md-8 col-md-offset-2" style="padding:1px">
              <div class="message_container">
                <!-- top tiles -->
                <div class="text-center message_head">
                  <h3 class=""><i class="fa fa-envelope"></i> Messages</h3>
                </div>
                <!-- /top tiles -->

                <div class="chatBox">
                  <?php if(!isset($sure_member)){ ?>
                  <div style="font-size:23px; color:#595959">
                    <i class="fa fa-location-arrow" style="font-size:31px"></i> Compose a message.
                  </div>
                  <?php } ?>

                  <div class="chatLog">
                    <?php if(isset($sure_member)) {?>
                      <div class="txt">
                        <div class="text_message" style="background:">
                          <!-- <p class="lead emoji-picker-container">  textarea-control   data-emojiable="true" -->
                            <textarea id="text_msg_<?php echo $frnd_Id; ?>" class="form-control msg_area" placeholder="Compose a message" rows="3"></textarea>
                          <!-- </p> -->
                          <button id="<?php echo $frnd_Id; ?>" class="sending_msg btn btn-success pull-right"><i class="fa fa-send"></i> Send Message</button>
                        </div>

                        <input type="hidden" id="userID_msg" value="<?php echo $userID; ?>">
                        <div class="clearfix"></div>
                      </div>
                    <?php } ?>

                    <div class="clearfix"></div>

                    <?php
                    if (isset($sure_member)) {

                      ?>
                      <div id='sender_<?php echo $userID; ?>'>

                      </div>
                      <?php

                      $sql3 = "SELECT * FROM messages WHERE (senderId = '$userID' AND receiverId = '$frnd_Id') OR (senderId = '$frnd_Id' AND receiverId = '$userID') ORDER BY messageId DESC";
                      $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                      if ($query3) {
                        if (mysqli_num_rows($query3) != 0) {

                          while ($row = mysqli_fetch_array($query3)) {
                            $message_id = $row['messageId'];
                            $userID = $_SESSION['Id'];
                            $sender_id = $row['senderId'];

                            // fro the time
                            date_default_timezone_set("Africa/Lagos");
                            $dateTime = strtotime($row['date']);

                              $date = date('d', $dateTime);
                              $month = date('m', $dateTime);
                              $year = date('y', $dateTime);
                              $time = date('H:i A', $dateTime);

                              switch ($month) {
                                  case "1":
                                      $CurrentMonth = "Jan";
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

                            if ($userID == $sender_id) {
                              $sql5 = "SELECT * FROM users_account WHERE Id = '$sender_id'";
                              $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
                              $user = mysqli_fetch_array($query5);
                                echo "
                                  <div class='chat sending'>
                                    <div class='user-photo pull-left'>
                                      <img src='/FUOBoxMedia/images/uploaded_images/profile_photos/".$user['profile_img']."' alt='".$user['username']."'>
                                    </div>

                                    <div class='send'>
                                      <div class='sender_name'>
                                          <a href=''>".$user['first_name']." ".$user['last_name']."</a>
                                      </div>
                                      <div class='sender_massage'>
                                        ".$row['message']."
                                      </div>
                                      <span class='pull-right' style='font-size:9px'>".$CurrentMonth."-".$date." - ".$time."</span>
                                      <button type='button' id='$message_id' delete_message='".$message_id."' class='message_delete_btn pull-right'>Delete <i class='fa fa-trash'></i></button>
                                      <div class='clearfix'></div>

                                      <div id='myModal_".$message_id."' class='modal'>
                                        <div class='modal-content'>
                                        <span class='close_".$message_id."'>x</span>
                                        <p>".$message_id."Delete this message?</p>
                                        <button class='btn btn-danger del_this_message' value='".$message_id."'>Delete</button>
                                        </div>
                                      </div>

                                    </div>
                                  </div>
                                  <div class='clearfix'></div>
                                ";

                            } else {

                              $sql5 = "SELECT * FROM users_account WHERE Id = '$sender_id'";
                              $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
                              $_user = mysqli_fetch_array($query5);
                                echo "
                                <div class='chat recieving'>
                                  <div class='user-photo pull-right'>
                                    <img src='/FUOBoxMedia/images/uploaded_images/profile_photos/".$_user['profile_img']."' alt='".$_user['username']."'>
                                  </div>

                                  <div class='recieve'>
                                    <div class='recieve_name'>
                                        <a href=''>".$_user['first_name']." ".$_user['last_name']."</a>
                                    </div>
                                    <div class='recieve_massage pull-'>
                                      ".$row['message']."
                                    </div>
                                    <span class='pull-right' style='font-size:9px'>".$CurrentMonth."-".$date." - ".$time."</span>
                                    <button type='button' id='$message_id' delete_message='".$message_id."'  class='message_delete_btn pull-right'>Delete <i class='fa fa-trash'></i></button>
                                    <div class='clearfix'></div>

                                    <div id='myModal_".$message_id."' class='modal'>
                                      <div class='modal-content'>
                                      <span class='close_".$message_id."'>x</span>
                                      <p>".$message_id."Delete this message?</p>
                                      <button class='btn btn-danger del_this_message_".$message_id."' value='".$message_id."'>Delete</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <div class='clearfix'></div>
                                  ";
                              }
                            }
                          } else {
                            echo "<div><b><em>Currently,</em></b> you have not had any conversation at the moment.</div>";
                          }

                        }
                      }

                    ?>
          </div>
        </div>

          </div>
        </div>


        <div class='clearfix'></div>
          </div>
          <!--  -->



    </div>
  </div>
</div>



<!-- Trigger/Open The Modal -->
<button id="myBtn">Open Modal</button>
<div id='myModal' class='modal'>
  <div class='modal-content'>
  <span class='close'>x</span>
  <p>Some text in the Modal..</p>
  </div>
</div>

<!-- The Modal -->




    <!-- jQuery -->
    <script src="/FUOBoxMedia/js/plugins/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="/FUOBoxMedia/js/plugins/bootstrap.min.js"></script>
    <!-- custom js -->
    <script src="/FUOBoxMedia/js/custom/message.js"></script>

    <script>
      $(document).ready(function(){
        // Simple image gallery. Uses default settings
        $('.fancybox').fancybox();
      });
    </script>
    <!-- light-box -->
    <script src="/FUOBoxMedia/js/plugins/jquery.fancybox.js"></script>


    <!-- Begin emoji-picker JavaScript -->
    <script src="/FUOBoxMedia/assets/emoji/lib/js/config.js"></script>
    <script src="/FUOBoxMedia/assets/emoji/lib/js/util.js"></script>
    <script src="/FUOBoxMedia/assets/emoji/lib/js/jquery.emojiarea.js"></script>
    <script src="/FUOBoxMedia/assets/emoji/lib/js/emoji-picker.js"></script>
    <!-- End emoji-picker JavaScript -->

    <script>
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '/FUOBoxMedia/assets/emoji/lib/img/',
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
