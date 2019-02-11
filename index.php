<?php

session_start();

// Check if user is logged in using the session variable
if (isset($_SESSION['Id']) && isset($_SESSION['email'])) {

  //SESSION VARIABLE DECLARED
  $userID = $_SESSION['Id'];
  $email = $_SESSION['email'];
  $active = $_SESSION['active'];

  include ('includes/database.php');

  // GETTING THE LOGGED IN USER DETAILS FOR THE DATABASE
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

}

include ('includes/database.php');

// include ('functions/news_events.php');

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Welcome | Home of FUO</title>
    <link rel="stylesheet" href="css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">

    <!-- light-box -->
    <link rel="stylesheet" type="text/css" href="css/plugins/jquery.fancybox.css" media="screen" />

    <!-- custom css -->
    <link rel="stylesheet" href="css/custom/main.css">
    <link rel="stylesheet" href="css/custom/timeline.css">

    <!-- Begin emoji-picker Stylesheets -->
    <link href="assets/emoji/lib/css/emoji.css" rel="stylesheet">
    <!-- End emoji-picker Stylesheets -->
  </head>
  <body>
    <?php
    include 'includes/header.php';
     ?>

    <!-- MAIN BODY -->
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <?php if(!isset($_GET['timeline'])){ ?>
          <div class="news_section">
            <h3><i class="fa fa-puzzle-piece"></i> Trending Gist on campus
              <i class="fa fa-star-half pull-right" style="font-size:18px; color:#ff0000"></i>
              <i class="fa fa-star pull-right" style="font-size:18px; color:#ff0000"></i>
              <i class="fa fa-star pull-right" style="font-size:18px; color:#ff0000"></i>
              <i class="fa fa-star pull-right" style="font-size:18px; color:#ff0000"></i>
            </h3>
            <!-- MINOR NEWS -->
            <?php
            $sql = "SELECT * FROM news_single ORDER BY Id DESC LIMIT 20";
            $singleNews_query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            if ($singleNews_query) {
              while ($row = mysqli_fetch_array($singleNews_query)) {
            ?>
            <div class="col-md-6" style="padding:2px; margin:0">
              <div class="small_news">
                <div class="news_img_box">
                  <img src="/FUOBoxMedia/admin-panel/uploaded_images/<?php echo $row['news_img']; ?>" alt="<?php echo $row['news_title']; ?>">
                </div>
                <div class="news_desc_box">
                  <a href="news_details.php?news_id=<?php echo $row['Id']; ?>">
                    <h5><?php echo $row['news_title']; ?></h5>
                  </a>
                  <p><?php echo (strlen($row['news_desc']) > 100 ) ? substr($row['news_desc'], 0, 100) : $row['news_desc']; ?><?php echo "...."; ?></p>
                    <div class="news_likes_box">
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
                           <span style="color:rgba(93,84,240,8.5)"> <i class="fa fa-globe"></i> </span>
                           <span><?php echo $like_count; ?> <i class="fa fa-thumbs-o-up" style="color:rgba(93,84,240,8.5)"></i></span>
                           <span ><i class="fa fa-comments-o" style="color:rgba(93,84,240,8.5)"></i> <?php echo $comm_count; ?>Comments</span>
                           <span class="pull-right date"><i class="fa fa-clock-o"></i> 07 Jul '18</span>
                           <?php
                         }
                       }
                       ?>
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
          </div>
          <?php } ?>

          <div class="timeline_box">
            <?php
            if (isset($_GET['timeline'])) {
                include ('user/timeline.php');
              }
            ?>
          </div>

        </div>

        <!-- FAVOURITE QUOTES -->
        <div class="col-md-3">
          <!-- STUDENTS LATEST QUOTE POST -->
          <div class="co-blog-sidebar">
            <h5 class="sidebar-title text-center">Daily Favourite Quotes</h5>
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
                        <a href="images/uploaded_images/profile_photos/<?php echo $user['profile_img']; ?>" data-fancybox-group="gallery" class="fancybox image pull-left" title="<?php echo $user['first_name']." ".$user['last_name']; ?>">
                          <div class="img_container">
                            <img src="/FUOBoxMedia/images/uploaded_images/profile_photos/<?php echo $user['profile_img']; ?>" alt="photo" width="100%" height="100%">
                          </div>
                        </a>
                      </div>
                      <a href="friends/friend_profile.php?friend_id=<?php echo $user['Id']; ?>" style="text-decoration:none;">
                        <h6 class="quote_username"><?php echo $user['first_name']." ".$user['last_name']; ?></h6>
                      </a>
                      <div class="content">
                        <span class="">
                          <i class="fa fa-quote-left" style="font-size:6px; color:rgba(93,84,240,8.5)"></i>
                          <?php if($quotes['quote']){ echo $quotes['quote']; } ?>
                        </span>
                      </div>
                      <span class="date"><?php echo $ago; ?></span>
                      <div class="clearfix"></div>
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
      </div>
    </div><!-- MAIN BODY -->
  </body>


  <!-- jQuery -->
  <script src="js/plugins/jquery/jquery-3.3.1.min.js"></script>
  <!-- timeline comments js -->
  <script type="text/javascript" src="js/comment/comment-insert.js?t=<?php echo time(); ?> "></script>
  <!-- bootstrap js -->
  <script src="js/plugins/bootstrap.min.js"></script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom/main.js"></script>
  <script type="text/javascript" src="js/custom/status_likes.js"></script>

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
</html>
