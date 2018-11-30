<?php
session_start();

// // Check if user is logged in using the session variable
if (!isset($_SESSION['Id']) && !isset($_SESSION['email'])) {

  header('location: index.php');

}else {
  //SESSION VARIABLE DECLARED
  // Makes it easier to read
  $userID = $_SESSION['Id'];
  $firstname = $_SESSION['first_name'];
  $lastname = $_SESSION['last_name'];
  $email = $_SESSION['email'];
  $user_name = $_SESSION['username'];
  $active = $_SESSION['active'];
  $profile_img = $_SESSION['profile_img'];
}


include_once '../database.php';

?>
<!--CHAT BOX-->


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
    header('location: /FUOBoxMedia/profile_page.php?user%theirsafefriendslist');
  }


}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="/FUOBoxMedia/admin-panel/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/FUOBoxMedia/admin-panel/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/FUOBoxMedia/admin-panel/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/FUOBoxMedia/admin-panel/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="/FUOBoxMedia/admin-panel/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="/FUOBoxMedia/admin-panel/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="/FUOBoxMedia/admin-panel/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/FUOBoxMedia/admin-panel/build/css/plugins/custom.min.css" rel="stylesheet">

    <!-- popup style -->
    <!-- <link href="../css/plugins/dist/custom.css" rel="stylesheet"> -->

    <!-- main custom style -->
    <link rel="stylesheet" href="/FUOBoxMedia/css/custom/main.css">
    <link rel="stylesheet" href="/FUOBoxMedia/css/custom/profile-style.css">

    <!-- Begin emoji-picker Stylesheets -->
    <!-- <link href="/FUOBoxMedia/asset/emoji/lib/css/emoji.css" rel="stylesheet"> -->
    <!-- End emoji-picker Stylesheets -->
    <style media="screen">
      .pro_pic{
        width:70px;
        height:70px;
        overflow:hidden;
        border-radius:50px;
        border: 4px solid #fff;
        margin: 7px 0px 0px 12px;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">

            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <div class="pro_pic">
                  <img src="/FUOBoxMedia/uploaded_images/<?php echo $profile_img; ?>"  alt="..." width="100%" height="100%">
                </div>

              </div>
              <div class="profile_info">
                <span>Hey there,</span>
                <h2><?php echo $firstname." ".$lastname; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!-- SEARCH -->
                <div class="online-search">
                  <div class="search_box">
                    <form action="results.php" method="GET" enctype="multipart/form-data">
                      <input class="search" type="text" name="search" placeholder="Search"/>
                    </form>
                  </div>
                </div>
                <!-- SEARCH -->
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-users"></i> Friends <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
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

                                $sql5 = "SELECT * FROM users_account WHERE Id = '$user_id_1' AND active = 1 ORDER BY last_seen";
                                $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
                                if ($query5) {
                                  if (mysqli_num_rows($query5) != 0) {
                                    if ($user_row = mysqli_fetch_array($query5)) {
                                      ?>
                                      <li style="margin-bottom:5px">
                                        <div class="sidebar-name">
                                          <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $user_row['Id']; ?>">
                                            <img width="30" height="30" src="/FUOBoxMedia/uploaded_images/<?php echo $user_row['profile_img']; ?>" />
                                            <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                                            <span class="pull-right"><?php if ($user_row['active'] == 1){ echo "Online";} ?></span>
                                          </a>
                                        </div>
                                      </li>
                                      <?php
                                     }
                                   } else {
                                     $sql7 = "SELECT * FROM users_account WHERE Id = '$user_id_1' AND active = 0";
                                     $query7 = mysqli_query($conn, $sql7) or die(mysqli_error($conn));
                                     if ($query7) {
                                       if (mysqli_num_rows($query7) != 0) {
                                         if ($offline_user_row = mysqli_fetch_array($query7)) {
                                           ?>
                                           <li>
                                             <div class="sidebar-name">
                                               <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $offline_user_row['Id']; ?>">
                                                 <img width="30" height="30" src="/FUOBoxMedia/uploaded_images/<?php echo $offline_user_row['profile_img']; ?>" />
                                                 <span><?php echo $offline_user_row['first_name']." ".$offline_user_row['last_name']; ?></span>
                                                 <span class="pull-right"><?php if ($offline_user_row['active'] == 0){ echo "Offline";} ?></span>
                                               </a>
                                             </div>
                                           </li>
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
                                        <li>
                                          <div class="sidebar-name">
                                            <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $user_row['Id']; ?>">
                                              <img width="30" height="30" src="/FUOBoxMedia/uploaded_images/<?php echo $user_row['profile_img']; ?>" />
                                              <span><?php echo $user_row['first_name']." ".$user_row['last_name']; ?></span>
                                              <span class="pull-right"><?php if ($user_row['active'] == 1){ echo "Online";} ?></span>
                                            </a>
                                          </div>
                                        </li>
                                        <?php
                                       }
                                     } else {
                                       $sql7 = "SELECT * FROM users_account WHERE Id = '$user_id_1' AND active = 0";
                                       $query7 = mysqli_query($conn, $sql7) or die(mysqli_error($conn));
                                       if ($query7) {
                                         if (mysqli_num_rows($query7) != 0) {
                                           if ($offline_user_row = mysqli_fetch_array($query7)) {
                                             ?>
                                             <li>
                                               <div class="sidebar-name">
                                                 <a href="/FUOBoxMedia/friends/friend_personal_msg.php?fri11end1470msgfri36msge70ndmsgmessage=<?php echo $offline_user_row['Id']; ?>">
                                                   <img width="30" height="30" src="/FUOBoxMedia/uploaded_images/<?php echo $offline_user_row['profile_img']; ?>" />
                                                   <span><?php echo $offline_user_row['first_name']." ".$offline_user_row['last_name']; ?></span>
                                                   <span class="pull-right"><?php if ($offline_user_row['active'] == 0){ echo "Offline";} ?></span>
                                                 </a>
                                               </div>
                                             </li>
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
                              echo "You do not any ";
                            }
                          }
                //end

                           ?>

                    </ul>
                  </li>
                  <!-- <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">General Form</a></li>
                      <li><a href="form_advanced.html">Advanced Components</a></li>
                      <li><a href="form_validation.html">Form Validation</a></li>
                      <li><a href="form_wizards.html">Form Wizard</a></li>
                      <li><a href="form_upload.html">Form Upload</a></li>
                      <li><a href="form_buttons.html">Form Buttons</a></li>
                    </ul>
                  </li> -->
                  <!-- <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li> -->
                </ul>
              </div>
              <div class="menu_section">
                <h3>Offline</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle" style="color:#00004d"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li role="presentation" class="dropdown" style="margin-right:6%; background:#00004d;">
                  <?php
                    $sql3 = "SELECT * FROM messages WHERE receiverId = '$userID' AND  receiver_read = 'No'";
                    $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                    if ($query3) {
                      if (mysqli_num_rows($query3) != 0) {
                        $unread_count = mysqli_num_rows($query3);
                  ?>
                        <a class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-envelope-o" style="color:#fff; font-size:17px"></i>
                          <span class="badge bg-green"><?php echo $unread_count; ?></span>
                        </a>
                  <?php
                      } else {
                  ?>
                        <a class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-envelope-o" style="color:#fff; font-size:17px"></i>
                          <span class="badge bg-green"></span>
                        </a>
                  <?php
                      }
                    }
                   ?>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="content-frame-to">
              <div class="page-title">
                <a href="/FUOBoxMedia/profile_page.php?timeline" class="btn btn-secondary pull-left" style="margin-left:4%; margin-right:2%"><i class="fa fa-mail-reply-all"></i> Back</a>
                <h2 class="pull-left" style=""><i class="fa fa-comments"></i> Messages</h2>
              </div>
            </div>
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="" style="padding:0">
                  <div>
                    <div class="chatBox">
                      <?php if(!isset($sure_member)){ ?>
                      <div class="">
                        <i class="fa fa-users" style="font-size:100px"></i> write some sirt here
                      </div>
                      <?php } ?>
                      <div class="chatLog">
                        <?php if(isset($sure_member)) {?>
                          <div class="txt" style="position:relative">
                            <div class="text_message" style="background:">
                              <!-- <p class="lead emoji-picker-container">  textarea-control   data-emojiable="true" -->
                                <textarea id="text_msg_<?php echo $frnd_Id; ?>" class="form-control msg_area" placeholder="Message" rows="3"></textarea>
                              <!-- </p> -->
                              <button id="<?php echo $frnd_Id; ?>" class="sending_msg btn btn-success pull-right"><i class="fa fa-send"></i> </button>
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
                                  <div>
                                    <div class='chat'>
                                      <div class='col-xs-3 col-sm-2 col-md-2 col-lg-2 pull-left'>
                                        <div class='user-photo' style='margin-right'>
                                          <img src='/FUOBoxMedia/uploaded_images/".$user['profile_img']."' alt='".$user['username']."'>
                                        </div>
                                      </div>
                                      <div class='col-xs-9 pull-left send'>
                                          <div class='heading'>
                                              <a href=''>".$user['first_name']." ".$user['last_name']."</a>
                                              <span class='pull-right' style='font-size:9px'>".$CurrentMonth."-".$date." - ".$time."</span>
                                          </div>
                                          ".$row['message']."
                                      </div>
                                    </div>
                                  </div>
                                  ";

                                } else {

                                  $sql5 = "SELECT * FROM users_account WHERE Id = '$sender_id'";
                                  $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
                                  $_user = mysqli_fetch_array($query5);
                                  echo "
                                     <div>
                                       <div class='chat'>
                                         <div class='col-xs-3 pull-left'>
                                           <div class='user-photo'>
                                             <img src='/FUOBoxMedia/uploaded_images/".$_user['profile_img']."' alt='".$_user['username']."'>
                                           </div>
                                         </div>
                                         <div class='col-xs-9 pull-left recieve'>
                                             <div class='heading'>
                                                 <a href=''>".$_user['first_name']." ".$_user['last_name']."</a>
                                                 <span class='pull-right' style='font-size:9px'>".$CurrentMonth."-".$date." - ".$time."</span>
                                             </div>
                                             ".$row['message']."
                                         </div>
                                       </div>
                                     </div>
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
        <!-- /page content -->
        <div class="clearfix"></div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="/FUOBoxMedia/admin-panel/vendors/jquery/dist/jquery.min.js"></script>
    <!-- MY CUSTOM  -->
    <script src="/FUOBoxMedia/js/custom/profile.js"></script>
    <!-- Bootstrap -->
    <script src="/FUOBoxMedia/admin-panel/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/FUOBoxMedia/admin-panel/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/FUOBoxMedia/admin-panel/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="/FUOBoxMedia/admin-panel/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="/FUOBoxMedia/admin-panel/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/FUOBoxMedia/admin-panel/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/FUOBoxMedia/admin-panel/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="/FUOBoxMedia/admin-panel/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="/FUOBoxMedia/admin-panel/vendors/Flot/jquery.flot.js"></script>
    <script src="/FUOBoxMedia/admin-panel/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/FUOBoxMedia/admin-panel/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/FUOBoxMedia/admin-panel/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/FUOBoxMedia/admin-panel/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/FUOBoxMedia/admin-panel/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/FUOBoxMedia/admin-panel/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/FUOBoxMedia/admin-panel/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/FUOBoxMedia/admin-panel/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="/FUOBoxMedia/admin-panel/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/FUOBoxMedia/admin-panel/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/FUOBoxMedia/admin-panel/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/FUOBoxMedia/admin-panel/vendors/moment/min/moment.min.js"></script>
    <script src="/FUOBoxMedia/admin-panel/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/FUOBoxMedia/admin-panel/build/js/plugins/custom.min.js"></script>

    <!-- Begin emoji-picker JavaScript -->
    <!-- <script src="/FUOBoxMedia/asset/emoji/lib/js/config.js"></script>
    <script src="/FUOBoxMedia/asset/emoji/lib/js/util.js"></script>
    <script src="/FUOBoxMedia/asset/emoji/lib/js/jquery.emojiarea.js"></script>
    <script src="/FUOBoxMedia/asset/emoji/lib/js/emoji-picker.js"></script> -->
    <!-- End emoji-picker JavaScript -->

    <!-- <script>
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '/FUOBoxMedia/asset/emoji/lib/img/',
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
    </script> -->

  </body>
</html>
