<?php

  session_start();

  // Check if user is logged in using the session variable
  if (isset($_SESSION['Id']) && isset($_SESSION['email'])) {

    //SESSION VARIABLE DECLARED
    $userID = $_SESSION['Id'];
    $firstname = $_SESSION['first_name'];
    $lastname = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $user_name = $_SESSION['username'];
    $active = $_SESSION['active'];
    $profile_img = $_SESSION['profile_img'];

  }

include ('database.php');

?>

<?php

if (isset($_GET['news_id'])) {
  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $news_id = test_input($_GET['news_id']);
  if (is_numeric($news_id)) {

    // main news events
    $sql = "SELECT * FROM news WHERE unique_no = '$news_id'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if ($query) {
      if (mysqli_num_rows($query) > 0) {
        if ($_row = mysqli_fetch_array($query)) {
          $main_newsTitle = $_row['news_title'];
          $main_newsDesc = $_row['news_desc'];
        }
      } else {

        // single news
        $sql2 = "SELECT * FROM news_single WHERE Id = '$news_id'";
        $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        if ($query2) {
          if (mysqli_num_rows($query2) > 0) {
            if ($_row = mysqli_fetch_array($query2)) {
              $single_newsTitle = $_row['news_title'];
              $single_newsDesc = $_row['news_desc'];
              $single_newsImg = $_row['news_img'];
            }
          }
        }

      }
    }

  } else {
    header('location: index.php');
  }
} else {
  header('location: index.php');
}


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>FUO | CampusGist</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/news/css/bootstrap.min.css">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/news/css/icon-font.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/news/css/plugins.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/news/css/style.css">
    <link rel="stylesheet" href="css/custom/man.css">
    <!-- Modernizer JS -->
    <script src="assets/news/js/vendor/modernizr-2.8.3.min.js"></script>
    <style media="screen">
    /*************************
    *******Header CSS******
    **************************/
    .header_top {
      background: none repeat scroll 0 0 #00004d;
    }
    .contactinfo ul li:last-child{
        margin-left: 15px;
    }
    .contactinfo ul li a{
      font-size: 12px;
      color: #fff;
      font-family: 'Roboto', sans-serif;
    }
    .contactinfo ul li {
      background: #00004d;
    }
    .social-icons ul li a {
      border: 0 none;
      border-radius: 0;
      color: #fff;
      padding:0px;
    }
    .social-icons ul li{
      display:inline-block;
    }
    .social-icons ul li a i {
      padding: 11px 15px;
       transition: all 0.9s ease 0s;
      -moz-transition: all 0.9s ease 0s;
      -webkit-transition: all 0.9s ease 0s;
      -o-transition: all 0.9s ease 0s;
    }
    .me li a:hover{
      color: #fff !important;
    }
    .social-icons ul li a i:hover{
      color: #fff;
       transition: all 0.9s ease 0s;
      -moz-transition: all 0.9s ease 0s;
      -webkit-transition: all 0.9s ease 0s;
      -o-transition: all 0.9s ease 0s;
    }
    /*
    *
    * THE TOP PROFILE ICON AND NOTIFICATION MESSAGES
    *
    */
    .header-middle .container .row {
      margin-left: 0;
      margin-right: 0;
      padding-bottom: 5px;
      padding-top: 0px;
      margin-top: 3px
    }
    .header-middle .container .row .col-sm-4{
      padding-left: 0;
    }
    .header-middle .container .row .col-sm-8 {
      padding-right:0;
    }
    .logo-img{
      float: left;
      margin-left: 4.5%;
    }
    .logo-name{
      float: left;
      margin: 0% 0% 0% 3%;
      font-size: 160%;
      font-weight: 700;
      font-family: arial;
      font-style: italic;
    }
    .logo-motto{
      float: left;
      padding: 2px 0px;
      margin: 0% 0% 0% 4%;
      font-size: 70%;
      color: #2F4F4F;
    }
    .fuo_head{
      font-weight: 700;
      font-size: 230%;
    }
    .like_btn{
      background: none;
      border: none;
      font-size: 20px;
      padding: 3px 11px;
      border-radius: 4px;
      margin-top: 10px
    }
    .comment_text_area{
      margin-bottom:100px;
      margin-top: 190px;
    }
    .localNews .co-sidebar-post{
      border-bottom: 1px solid #00004d;
      list-style: square;
      margin: 1px 18px;
      padding: 3px 26px;
      border-radius: 5px;
      color: #fff
    }
    .localNews .co-sidebar-post div.title{
      font-size: 16px;
      color: #666666;
      line-height: 1em
    }
    .localNews .co-sidebar-post div.title:hover{
      color: #00004d !important
    }
    /* .localNews .co-sidebar-post a .fullname{
      text-transform: capitalize;
      font-size: 12px;
      line-height: 1em
    } */
    .localNews .co-sidebar-post a .username{
      text-transform: lowercase;
      font-size: 12px;
      color: blue;
      line-height: 1em
    }
    .localNews .co-sidebar-post a .datetime{
      text-transform: lowercase;
      font-size: 11px;
      color: #00004d;
      line-height: 1em
    }
    .comment_text_area h5{
      font-size: 18px;
      font-weight: 600;
      text-decoration: underline;
      margin-bottom: 20px
    }
    .comment_text_area h6{
      font-size: 14px;
      font-weight: 600;
      text-decoration: underline;
      margin-bottom: 17px
    }
    .comment_text_area h6 span.newslike{
      font-size: 16px;
      color: #737373;
    }
    .comment_text_area .comment_list button{
      padding: 7px;
      margin-top: 5px;
      border: 2px solid #00004d;
      border-radius: 5px;
      background: #e1e1e1;/**/
      color: #00004d;
    }
    .comment_text_area .comment_list button:hover{
      background: #fff;
      color: #fff;
    }
    .comt_section{
      background: #e1e1e1;
      border-bottom: 2px solid #fff;
      padding-left: 3%;
      padding-right: 3%;
    }
    .img_box{
      width:46px;
      height:46px;
      border: 2px solid #e1e1e1;
      border-radius: 50px;
      padding: 2px;
      overflow: hidden;
    }
    .img_box img{
      border-radius: 50px;
    }
    .message{
      color: #666666;
      font-family: serif;
    }
    .time{
      font-size: 11px;
      color: blue
    }
    </style>
</head>

<body>

  <?php if (isset($_SESSION['Id'])): ?>
    <input type="hidden" id="userID" value="<?php echo $userID; ?>">
  <?php endif; ?>


<!-- Header Section Start -->
<div class="header-section section">
    <!-- Header Top Start -->
    <header id="header"><!--header-->
      <div class="header_top"><!--header_top-->
        <div class="container">
          <div class="row" style="background:#00004d">
            <div class="col-sm-6">
              <div class="contactinfo">
                <ul class="nav nav-pills me">
                  <li><a href="#"><i class="fa fa-phone"></i> +706 654 1485</a></li>
                  <li><a href="#"><i class="fa fa-envelope"></i> oweipadeijoshie@gmail.com</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div><!--/header_top-->

      <div class="header-middle"><!--header-middle-->
        <div class="container">
          <div class="row">
            <div class="col-sm-7">
              <div class="logo pull-left text-center">
                <div class="" style="padding-top:3px">
                  <a href="profile-page.php" style="color:#2f4f4f">
                    <img src="images/logos/box-logo.png" class="logo-img" alt="logo" width="40" height="40">
                    <h1 class="logo-name"><span style="color:red">E </span>- PROGRESS</h1><br>
                    <h6 class="logo-motto">Essential minds for an excellent career</h6>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!--/header-middle-->
    </header><!--/header-->

    <!-- Header Top End -->
</div>
<!-- Header Section End -->

<div class="clearfix"></div>

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <!-- Bread crumb -->
      <div class="row page-titles " align="">
        <div class="col-sm-12 ">
          <h3 class="fuo_head text-center">FUO | CampusGist</h3>
          <div class="breadcrumb">
            <ul>
              <li style="font-size:18px; font-weight:600"><span>News Details</span></li>
              <!-- <li><span>CampusGist</span></li> -->
            </ul>
          </div>
          </div>
        <div class="col-sm-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" style="color:blue">News</li>
          </ol>
        </div>
      </div>
      <!-- End Bread crumb -->
    </div>
  </div>
</div>

<!-- Related Product Section Start -->
<div class="section" style="margin-bottom:20px; margin-top:20px">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="product-slider-wrap product-slider-arrow-one">
          <div class="product-slider product-slider-4">
            <!-- for main news -->
            <?php
              while ($row = mysqli_fetch_array($query)) {
             ?>
             <div class="col pb-20 pt-10">
               <div class="ee-product">
                 <div class="image">
                   <a class="img"><img src="/myProject/admin-panel/uploaded_images/<?php echo $row['news_img']; ?>" alt="Product Image"></a>
                 </div>
               </div>
             </div>
              <?php
                }
               ?>

               <!-- for single news -->
               <?php
                 if (isset($single_newsImg)) {
                ?>
                <div class="col pb-20 pt-10">
                  <div class="ee-product">
                    <div class="image" style="width:500px; margin:auto">
                      <a class="img"><img src="/myProject/admin-panel/uploaded_images/<?php echo $single_newsImg; ?>" alt="Product Image" height="300px" width="100%"></a>
                    </div>
                  </div>
                </div>
                 <?php
                   }
                  ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="clearfix"></div>

<!-- Single Product Section Start -->
<div style="margin-bottom:325px">
  <div class="container">
      <div class="col-lg-6 col-12 mb-50">
        <!-- Content -->
        <div class="single-product-content">
          <!-- Category & Title -->
          <div class="head-content">
            <div class="category-title">
              <h5 class="title"><?php if(isset($main_newsTitle)){ echo $main_newsTitle; }else { echo $single_newsTitle; } ?></h5>
            </div>
          </div>

          <div class="single-product-description">
            <div class="desc">
              <p><?php if(isset($main_newsDesc)){ echo $main_newsDesc; }else { echo $single_newsDesc; } ?></p>
            </div>
            <div class="share">
              <h5>Share: </h5>
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-google-plus"></i></a>
            </div>

              <?php
              // getting the IP Address of visiting users
              function getIp() {
                $ip = $_SERVER['REMOTE_ADDR'];

                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                  $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }

                return $ip;
              }
              $ip_address = getIp();

                $sql5 = "SELECT * FROM news_likes WHERE (news_unique_no = '".$_row['unique_no']."' OR news_unique_no = '".$_row['Id']."') AND ip_address = '$ip_address'";
                $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
                if ($query5) {
                  if (mysqli_num_rows($query5) == 1) {
                    $yes = " ";
                    ?>
                    <button id="lik_<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>"
                      like="<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>"
                      class="pull-right like_btn news_like">
                      <i class="fa fa-heart-o" id="heart_<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>" style="color:#ff0000"></i>
                    </button>
                    <?php
                  } else {
                    $no = " ";
                    ?>
                    <button id="lik_<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>"
                      like="<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>"
                      class="pull-right like_btn news_like">
                      <i class="fa fa-heart-o" id="heart_<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>"></i> 
                    </button>
                    <?php
                  }
                }
               ?>
          </div>

          <div class="comment_text_area">
            <div class="comment_list">
              <?php if (isset($_SESSION['Id'])): ?>

              <h5>Leave a comment</h5>
              <textarea id="news_comment_<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>" comment_text="<?php if(isset($newsDesc)){ echo $_row['Id']; } ?>" class="form-control" rows="1"></textarea>
              <button id="<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>" type="button" class=" pull-right send_news_comment">Send comment</button>

              <?php endif; ?>
            </div>

            <div class="clearfix"></div>
            <!-- displays all new comments -->

            <?php
              $sql3 = "SELECT * FROM news_comments WHERE unique_no = '".$_row['unique_no']."' OR unique_no = '".$_row['Id']."'";
              $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
              if ($query3) {
                if (mysqli_num_rows($query3) > 0) {
                  $comment_count = mysqli_num_rows($query3);
                  $sql4 = "SELECT * FROM news_likes WHERE news_unique_no = '".$_row['unique_no']."' OR news_unique_no = '".$_row['Id']."'";
                  $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                  if ($query4) {
                    $likes_count = mysqli_num_rows($query4);
                    ?>
                    <h6><?php echo $comment_count; ?> Comments <span class="newslike"><?php echo $likes_count; ?> LIKES</span> </h6>
                    <?php
                  }

                  while ($users_news = mysqli_fetch_array($query3)) {
                    $news_comment = $users_news['comment'];
                    $time = $users_news['time'];
                    $user_id = $users_news['userId'];

                    $sql4 = "SELECT * FROM users_account WHERE Id = '$user_id'";
                    $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                    if ($query4) {
                      if ($user = mysqli_fetch_array($query4)) {

                        $dateTime = strtotime($time);
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

              ?>
              <div class="comt_section">
                <a>
                  <div class="pull-left">
                    <a class="img_box" href="friends/friend_profile.php?friend_id=<?php echo $user['Id']; ?>">
                      <img src="/myProject/uploaded_images/<?php echo $user['profile_img']; ?>" alt="img" width="100%" height="100%"/>
                    </a>
                  </div>
                  <div class="pull-left" style="margin-left:3%; padding-top:15px">
                     <span style="text-transform:capitalize; color:#666666; font-family: serif;">
                         <?php echo $user['first_name']." ".$user['last_name']." <sapn style='text-transform:lowercase; font-size:11px; color:#c1c1c1'><i class='fa fa-at'></i>".$user['username']."</span>"; ?>
                     </span>
                  </div>
                  <div class="clearfix"></div>
                  <div class="message"><?php echo $news_comment; ?>
                    <!-- <div class="clearfix"></div> -->
                    <span class="time"><?php echo " - ".$date." ".$CurrentMonth." '".$year." <em><strong>at</strong></em> ".$time; ?></span>
                  </div>
                </a>
              </div>
              <?php
                      }
                    }
                  }
                }
              }
             ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- Single Product Section End -->




<!-- JS
============================================ -->

<!-- jQuery JS -->
<script src="assets/news/js/vendor/jquery-1.12.4.min.js"></script>
<!-- Popper JS -->
<script src="assets/news/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="assets/news/js/bootstrap.min.js"></script>
<!-- Plugins JS -->
<script src="assets/news/js/plugins.js"></script>

<!-- Main JS -->
<script src="assets/news/js/main.js"></script>
<!-- CUSTOM -->
<script src="js/custom/main.js"></script>

</body>

</html>
