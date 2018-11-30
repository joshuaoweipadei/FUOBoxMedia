<?php

  session_start();

  // Check if user is logged in using the session variable
  if (isset($_SESSION['Id']) && isset($_SESSION['email'])) {

    //SESSION VARIABLE DECLARED
    $userID = $_SESSION['Id'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];

  }

include ('database.php');


include ('functions/news_events.php');

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="veiwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Welcome | Home of FUO</title>

    <!-- <link rel="stylesheet" href="css/plugins/bootstrap-4.0.0/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="css/plugins/theme-default.css"> -->
    <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="css/plugins/w3css/w3css.css"> -->
    <!-- <link rel="stylesheet" href="css/plugins/default/theme-default.css"> -->
    <link href="css/plugins/font-awesome.min.css" rel="stylesheet">
    <link href="css/plugins/prettyPhoto.css" rel="stylesheet">
    <link href="css/plugins/price-range.css" rel="stylesheet">
    <link href="css/plugins/animate.css" rel="stylesheet">
    <link href="css/plugins/responsive.css" rel="stylesheet" media="all">
    <link href="css/plugins/bootstrap.min.css" rel="stylesheet">

    <!-- comment popup styling -->
    <link href="css/plugins/dist/custom.css" rel="stylesheet">

    <!-- main custom style -->
    <link rel="stylesheet" href="css/custom/main.css">
    <link rel="stylesheet" href="css/custom/style.css">

    <!-- light-box -->
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="screen" />


    <!-- steps to register DEMO (index.php) -->
    <link rel="stylesheet" href="css/external/et-line.css">
    <link rel="stylesheet" href="css/external/style.css">










    <script type="text/javascript" src="js/custom/user_scriptsheet.js"></script>
    <!-- <script type="text/javascript" src="js/plugins/bootstrap-4.0.0/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="js/plugins/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/comment/comment-insert.js?t=<?php echo time(); ?> "></script>

















</head>
<body>
  <!--PAGE HEADER-->

  <?php include 'includes/header.php'; ?>

  <?php if (isset($_SESSION['Id'])): ?>
    <input type="hidden" id="userID" value="<?php echo $userID; ?>">
  <?php endif; ?>

  <section class="background">
    <div class="container">
      <div class="row">
        <!-- LEFT HNAD SIDE -->
        <div class="col-sm-9 left_side">
          <!-- SLIDE SHOW -->

          <!-- END OF SLIDE SHOW -->

          <!-- ABOUT OUR WEBSITE -->
          <?php if (!isset($_SESSION['Id'])) { ?>
          <div class="">
            <div class="row">
              <div class="account_steps">
                <div class="stepss">
                  <h3>Everything you need in one package!!!</h3>
                  <h5>We offer you the best just in three steps to get started</h5>

                  <div class="_steps">
                    <h4><i class="fa fa-sign-in" style="color: #009999"></i> Register </h4>
                    <p>Create an account to start reaching out to your friends and coursemate on campus.</p>

                    <h4><i class="fa fa-plus-square" style="color: #009999"></i> Add Friends</h4>
                    <p>Send friend request to your friends and start chat with them.</p>

                    <h4><i class="fa fa-truck" style="color: #009999"></i> FUO marketplace</h4>
                    <p>Here is the opportunity you have being waiting for to sell your school items easily on campus.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <!-- END OF ABOUT OUR WESITE -->

          <div class="col-sm-12" style="padding:0">
            <div class="news_section">
              <?php trendingNews(); ?>

                <!-- MINOR NEWS -->
                <?php
                $sql = "SELECT * FROM news_single ORDER BY Id DESC LIMIT 3";
                $singleNews_query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if ($singleNews_query) {
                  while ($row = mysqli_fetch_array($singleNews_query)) {
                ?>
                <div class="col-sm-4" style="padding:2px; margin:0">
                  <div class="small_news">
                    <div class="news_img_box">
                      <a href="news_details.php?news_id=<?php echo $row['Id']; ?>">
                        <img src="/FUOBoxMedia/admin-panel/uploaded_images/<?php echo $row['news_img']; ?>" alt="">
                        <h5><?php echo $row['news_title']; ?></h5>
                      </a>
                    </div>
                    <div class="newss">
                      <?php
                       $sql2 = "SELECT * FROM news_comments WHERE unique_no = '".$row['Id']."'";
                       $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                       if ($query2) {
                         $comm_count = mysqli_num_rows($query2);

                         $sql3 = "SELECT * FROM news_likes WHERE news_unique_no = '".$row['Id']."'";
                         $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                         if ($query3) {
                           $like_count = mysqli_num_rows($query3);
                           ?>
                           <span><?php echo $like_count; ?> <i class="fa fa-heart-o"></i></span>
                           <span><?php echo $comm_count; ?> <i class="fa fa-comments-o"></i></span>
                           <?php
                         }
                       }
                       ?>
                      <div class="pull-right">
                        <button class="btn panel-heading collapsed" role="tab" id="heading_<?php echo $row['Id']; ?>" data-toggle="collapse"
                          data-parent="#accordion" href="#collapse_<?php echo $row['Id']; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $row['Id']; ?>"> <i class="fa fa-bars"></i>
                        </button>
                      </div>
                      <!-- <div class="clearfix"></div> -->
                      <div class="panel">
                        <div id="collapse_<?php echo $row['Id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_<?php echo $row['Id']; ?>">
                          <div class="panel-body news_desc">
                              <?php echo $row['news_desc']; ?>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <?php
                  }
                }
                 ?>
                 <div class="clearfix"></div>
                 <?php
                 $sql = "SELECT * FROM news_single ORDER BY Id DESC LIMIT 3,2";
                 $singleNews_query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                 if ($singleNews_query) {
                   while ($row = mysqli_fetch_array($singleNews_query)) {
                 ?>
                 <div class="col-sm-6" style="padding:2px; margin:0">
                   <div class="small_news">
                     <div class="news_img_box">
                       <a href="news_details.php?news_id=<?php echo $row['Id']; ?>">
                         <img src="/FUOBoxMedia/admin-panel/uploaded_images/<?php echo $row['news_img']; ?>" alt="">
                         <h5><?php echo $row['news_title']; ?></h5>
                       </a>
                     </div>
                     <div class="newss">
                       <?php
                        $sql2 = "SELECT * FROM news_comments WHERE unique_no = '".$row['Id']."'";
                        $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                        if ($query2) {
                          $comm_count = mysqli_num_rows($query2);

                          $sql3 = "SELECT * FROM news_likes WHERE news_unique_no = '".$row['Id']."'";
                          $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                          if ($query3) {
                            $like_count = mysqli_num_rows($query3);
                            ?>
                            <span><?php echo $like_count; ?> <i class="fa fa-heart-o"></i></span>
                            <span><?php echo $comm_count; ?> <i class="fa fa-comments-o"></i></span>
                            <?php
                          }
                        }
                        ?>
                       <div class="pull-right">
                         <button class="btn panel-heading collapsed" role="tab" id="heading_<?php echo $row['Id']; ?>" data-toggle="collapse"
                           data-parent="#accordion" href="#collapse_<?php echo $row['Id']; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $row['Id']; ?>"> <i class="fa fa-bars"></i>
                         </button>
                       </div>
                       <div class="panel">
                         <div id="collapse_<?php echo $row['Id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_<?php echo $row['Id']; ?>">
                           <div class="panel-body news_desc">
                               <?php echo $row['news_desc']; ?>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
                 <?php
                   }
                 }
                  ?>
                <div class="clearfix"></div>
              </div>
          </div>

        </div>
        <!-- END OF RIGHT SIDE -->


        <!-- LEFT SIDE -->
        <div class="col-sm-3 right_side">
          <!-- STUDENTS LATEST QUOTE POST -->
          <div class="co-blog-sidebar">
            <h5 class="sidebar-title text-center">Latest Daily Quotes</h5>
            <?php
            $get_quote = "SELECT * FROM quotes ORDER BY time DESC LIMIT 30";
            $query_quote = mysqli_query($conn, $get_quote) or die(mysqli_error($conn));
            if ($query_quote) {
              while ($quotes = mysqli_fetch_array($query_quote)) {
                $user_id = $quotes['userId'];
                $t = $quotes['time'];
                $sql = "SELECT * FROM users_account WHERE Id = '$user_id'";
                $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if ($query) {
                  if ($user = mysqli_fetch_array($query)) {

                    date_default_timezone_set("Africa/Lagos");
                    $time_ago = strtotime($t);
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
                    <div class="co-sidebar-post "><!-- fix -->
                      <div class="img_section magnifier2">
                        <a href="uploaded_images/<?php echo $user['profile_img']; ?>" data-fancybox-group="gallery" class="fancybox image pull-left" title="<?php echo $user['first_name']." ".$user['last_name']; ?>">
                          <div class="img_container">
                            <img src="/FUOBoxMedia/uploaded_images/<?php echo $user['profile_img']; ?>" alt="" width="100%" height="100%">
                          </div>
                        </a>
                      </div>
                      <div class="content ">
                        <a href="friends/friend_profile.php?friend_id=<?php echo $user['Id']; ?>" class="title">
                          <i class="fa fa-quote-left" style="font-size:6px; color:rgb(255, 92, 51)"></i>
                          <?php echo $quotes['quote']; ?>
                          <i class="fa fa-quote-right" style="font-size:6px; color:rgb(255, 92, 51)"></i>
                        </a>
                        <span class="date"><?php echo $ago; ?></span>
                      </div>
                    </div>
                    <?php
                  }
                }
              }
            }
             ?>
          </div>
          <!-- END OF STUDENTS LATEST QUOTE POST -->
        </div>
        <!-- END OF LEFT SIDE -->


      </div>
    </div>
    <div class="container-fluid">
      <!-- STEPS IN CREATING AN CREATE -->
      <div class="co-service-section-3 section">
        <div class="">
          <!--Single Service-->
          <div class="col-sm-4" style="padding:0">
            <div class="co-single-service-3">
              <span class="icon"><i class="icon-chat"></i></span>
              <div class="content fix">
                <h3>Social Events on Campus</h3>
                <p>We update you will the trending and famous events right here on campus.</p>
              </div>
            </div>
          </div>
          <!--Single Service-->
          <div class="col-sm-4" style="padding:0">
            <div class="co-single-service-3">
              <span class="icon"><i class="icon-tools"></i></span>
              <div class="content fix">
                <h3>Chat up a Friend</h3>
                <p>Making life easy fro people around campus to chat up themselves(group) up. E.g when is lecture time etc.</p>
              </div>
            </div>
          </div>
          <!--Single Service-->
          <div class="col-sm-4" style="padding:0">
            <div class="co-single-service-3">
              <span class="icon"><i class="icon-tools-2"></i></span>
              <div class="content fix">
                <h3>FUO Marketplace</h3>
                <p>Students can easy sell and buy things online E.g accessories, student household items etc.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END OF STEPS IN CREATING AN CREATE -->
    </div>
  </section>


    <!--PAGE FOOTER-->
    <footer id="main_footer">
      <div class="container-fluid">
        <div class=" row footBackground">
          <!--Main footer contain-->
          <div class="row start-xs start-sm start-md start-lg major-row">
            <h2 class="base-logo">Education <span style="font-family:segoe script"> Center (FUO)</span> </h2>
          </div>

          <hr style="height:0.0005em; background-color:white; width:94%">

          <!--FOOT ROW 1-->
          <div class="row start-xs start-sm start-md start-lg major-row">
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 footMenu">
              <h1>About</h1>
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 footMenu">
              <p>
                <a href="#">Our Company</a>
                <a href="#">Career</a>
                <a href="#">Advertise with Us</a>
                <a href="#">Terms and Conditions</a>
                <a href="#">Privacy Policy</a>
              </p>
            </div>
          </div>
          <!--FOOT ROW 2-->
          <div class="row start-xs start-sm start-md start-lg major-row">
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 footMenu">
              <h1>Contact</h1>
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 footMenu">
              <p>
                <a href="#">Customer Service</a>
                <a href="#">Agent</a>
                <a href="#">Location</a>
                <a href="includes/about.author.php">Author</a>
              </p>
            </div>
          </div>
          <!--FOOT ROW 3-->
          <div class="row start-xs start-sm start-md start-lg major-row">
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 footMenu">
              <h1>Connect</h1>
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 footMenu">
              <p>
                <a href="#">Email Newsletter</a>
                <a href="#"><img src="images/social_media/facebook1.png" alt="facebook" width="25"> Facebook</a>
                <a href="#"><img src="images/social_media/twitter1.png" alt="twitter" width="25"> Twitter</a>
                <a href="#"><img src="images/social_media/gmail1.png" alt="google" width="25"> Google</a>
                <a href="#"><img src="images/social_media/instagram1.png" alt="instagram" width="25"> Instagram</a>
                <a href="#"><img src="images/social_media/whatsapp1.png" alt="whatsapp" width="25"> WhatsApp</a>
              </p>
            </div>
          </div>

          <!--FOOT BASE-->
          <div class="row center-xs center-sm center-md center-lg major-row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align:center">
              <p style="color:#fff"> &copy; 2018 Home of FUO. All Right Reserved | Design By Joshie O. Bayefa</p>
            </div>
          </div>
        </div>
      </div>
    </footer> <!--FOOTER OF THE PAGE-->




    <!---->
    <!-- jQuery latest version -->
    <!-- <script src="pixal/js/vendor/jquery-3.1.1.min.js"></script> -->
    <!-- Bootstrap js -->
    <!-- <script src="pixal/js/bootstrap.min.js"></script> -->
    <!-- Plugins js -->
    <!-- <script src="pixal/js/plugins.js"></script> -->
    <!-- Ajax Mail js -->
    <!-- <script src="pixal/js/ajax-mail.js"></script> -->
    <!-- Main js -->
    <!-- <script src="pixal/js/main.js"></script> -->
    <!-- jQuery -->

















  <!--Jquery-->
  <script src="js/plugins/jquery/jquery.js"></script>

    <script src="js/plugins/dist/jquery.min.js"></script>
    <script src="js/plugins/bootstrap.min.js"></script>
    <script src="js/custom/dist/custom.min.js"></script>

    <!-- CUSTOM -->
    <script src="js/custom/main.js"></script>


    <script>
      $(document).ready(function(){
        // Simple image gallery. Uses default settings
        $('.fancybox').fancybox();

      });
    </script>
    <!-- light-box -->
	  <script type="text/javascript" src="js/jquery.fancybox.js"></script>


</body>
</html>
