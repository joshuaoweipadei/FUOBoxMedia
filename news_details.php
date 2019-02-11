<?php

  session_start();

  // Check if user is logged in using the session variable
  if (isset($_SESSION['Id']) && isset($_SESSION['email'])) {

    //SESSION VARIABLE DECLARED
    $userID = $_SESSION['Id'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];

  }

include ('includes/database.php');

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
              $single_newsDate = $_row['date'];

              date_default_timezone_set("Africa/Lagos");
              $dateTime = strtotime($single_newsDate);
                $date = date('d', $dateTime);
                $month = date('m', $dateTime);
                $year = date('y', $dateTime);
                $time = date('H:i a', $dateTime);

                switch ($month) {
                    case "1":
                        $CurrentMonth = "January";
                        break;
                    case "2":
                        $CurrentMonth = "Febuary";
                        break;
                    case "3":
                        $CurrentMonth = "March";
                        break;
                    case "4":
                        $CurrentMonth = "April";
                        break;
                    case "5":
                        $CurrentMonth = "May";
                        break;
                    case "6":
                        $CurrentMonth = "June";
                        break;
                    case "7":
                        $CurrentMonth = "July";
                        break;
                    case "8":
                        $CurrentMonth = "August";
                        break;
                    case "9":
                        $CurrentMonth = "September";
                        break;
                    case "10":
                        $CurrentMonth = "October";
                        break;
                    case "12":
                        $CurrentMonth = "November";
                        break;
                    default:
                        $CurrentMonth = "December";
                }


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

    <link rel="stylesheet" href="css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom/main.css">
    <style media="screen">
    /*************************
    *******Header CSS******
    **************************/
    .fuo_head{
      font-weight: 700;
      font-size: 240%;
      text-align: center;
    }
    .like_btn{
      background: #fff;
      border: 1px solid #f2f2f2;
      padding: 4px 31px;
      border-radius: 4px;
      margin-top: 5px;
    }
    .news_box .news_title h5{
      font-size: 20px;
      font-weight: 600;
      color: #595959;
      font-family: arial;
    }
    .news_box .news_desc p{
      font-size: 14px;
      font-family: arial;
      text-align: justify;
      color: #595959;
    }
    .comm_and_like .feedback{
      font-size: 17px;
      font-weight: 500;
      font-size: arial;
      font-style: italic;
      color: #ff0000;
    }
    .comm_and_like a{
      margin-right: 10px;
      font-size: 17px;
    }
    .comm_and_like a:hover{
      text-decoration: none;
    }
    .comment_text_area{
      margin-bottom:100px;
      margin-top: 80px;
    }
    .comment_text_area h5{
      font-size: 18px;
      font-weight: 600;
      font-family: arial;
      color: rgba(93,84,240,8.5);
      margin-bottom: 10px
    }
    .comment_text_area .comment_list button{
      font-weight: 600;
      font-size: 15px;
      font-family: arial;
      padding: 7px;
      margin-top: 5px;
      margin-bottom: 17px;
      border: 2px solid rgba(185,0,255,0.9);
      border-radius: 3px;
      color: rgba(185,0,255,0.9);
      background: #fff;
    }
    .comment_text_area .comment_list button:hover{
      background: rgba(185,0,255,0.9);
      color: #fff;
    }
    .comt_section{
      background: #fff;
      border-bottom: 1px solid #e1e1e1;
      padding: 2px 13px;
    }
    .comt_section .img_box{
      width: 60px;
      height: 60px;
      border: 2px solid #e1e1e1;
      border-radius: 50px;
      padding: 2px;
      overflow: hidden;
    }
    .img_box img{
      width: 100%;
      height: 100%;
      border-radius: 50px;
    }
    .message{
      color: #595959;
      font-family: arial;
      margin-top: 10px;
    }
    .time{
      font-family: arial;
      font-size: 11px;
      color: #c1c1c1;
    }
    </style>
</head>

<body>

  <?php if (isset($_SESSION['Id'])): ?>
    <input type="hidden" id="userID" value="<?php echo $userID; ?>">
  <?php endif; ?>



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
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="">
          <a href="javascript:history.back()" class="btn btn-default" style="background:inherit; border:none; color:rgba(93,84,240,8.5);">
            <i class="fa fa-arrow-left"></i> back
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="header-middle">
    <div class="cover_wall">
      <div class="showcase">
        <div class="container">
          <div class="col-md-12" style="padding:0; margin:0">
            <div class="logo">
              <div class="text-center">
                <a href="profile-page.php">
                  <img src="images/advert/logo.png" class="logo-img" alt="logo" width="150" height="110">
                  <h3 class="logo-name"><span class="a">FUO</span><span class="b">BoxMedia</span></h3>
                  <span class="logo-quote">Chat with other students bafore the event to create relationships and make the best of your time on campus.</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <!-- Bread crumb -->
        <div class="row" align="">
          <div class="col-sm-12 ">
            <h3 class="fuo_head">Federal University Otuoke Campus Gist
              <i class="fa fa-star pull-" style="font-size:18px; color:#ff0000"></i>
              <i class="fa fa-star pull-" style="font-size:18px; color:#ff0000"></i>
              <i class="fa fa-star pull-" style="font-size:18px; color:#ff0000"></i>
              <i class="fa fa-star-half pull-" style="font-size:18px; color:#ff0000"></i>
            </h3>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb" style="background:rgba(185,0,255,0.9)">
              <li class="breadcrumb-item">Author</li>
              <li class="breadcrumb-item"><a href="aboutus.php" style="color:#fff">FUOBoxMedia Team</a></li>
              <li class="breadcrumb-item pull-right" style="color:#fff; font-size:13px">
                <?php if(isset($single_newsDate)){ echo $time." | ".$date." ".$CurrentMonth." 20".$year;} ?>
              </li>
              <div class="clearfix"></div>
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
               <div class="container">
                 <div class="col-md-12">
                   <div class="">
                     <a class=""><img src="/FUOBoxMedia/admin-panel/uploaded_images/<?php echo $row['news_img']; ?>" alt="Image"></a>
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
                  <div class="container">
                    <div class="col-md-12">
                      <div class="" >
                        <a class=""><img src="/FUOBoxMedia/admin-panel/uploaded_images/<?php echo $single_newsImg; ?>" alt="image" height="400px" width="72%"></a>
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
        <div class="col-lg-6 col-12 ">
          <div class="news_box">
            <div class="news_title">
              <h5><?php if(isset($main_newsTitle)){ echo $main_newsTitle; }else { echo $single_newsTitle; } ?></h5>
            </div>

            <div>
              <div class="news_desc">
                <p><?php if(isset($main_newsDesc)){ echo $main_newsDesc; }else { echo $single_newsDesc; } ?></p>
              </div>
              <div class="comm_and_like">
                <span class="feedback">Feedbacks:<span>
                <?php
                // news commments count
                $sql3 = "SELECT * FROM news_comments WHERE unique_no = '".$_row['unique_no']."' OR unique_no = '".$_row['Id']."'";
                $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                if ($query3) {
                  if (mysqli_num_rows($query3) > 0) {
                    $comment_count = mysqli_num_rows($query3);
                    echo '<a>'.$comment_count.' <i class="fa fa-comments"></i>Comments</a>';
                  } else {
                    echo '<a>0 <i class="fa fa-comments"></i>Comments</a>';
                  }

                  // news like count
                  $sql4 = "SELECT * FROM news_likes WHERE news_unique_no = '".$_row['unique_no']."' OR news_unique_no = '".$_row['Id']."'";
                  $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                  if ($query4) {
                    if (mysqli_num_rows($query4) > 0) {
                      $likes_count = mysqli_num_rows($query4);
                      echo '<a><span class="newslike">'.$likes_count.' <i class="fa fa-thumbs-o-up"></i>Likes</span></a>';
                    }else {
                      echo '<a><span class="newslike">0 <i class="fa fa-thumbs-o-up"></i>Likes</span></a>';
                    }
                    ?>
                    <a><i class="fa fa-share-alt"></i>Share</a>
                    <a><i class="fa fa-globe"></i></a>
                    <?php
                  }
                }
                 ?>
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
                        <i class="fa fa-thumbs-o-up" id="heart_<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>" style="color:#ff0000; font-size:26px"></i>
                      </button>
                      <?php
                    } else {
                      $no = " ";
                      ?>
                      <button id="lik_<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>"
                        like="<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>"
                        class="pull-right like_btn news_like">
                        <i class="fa fa-thumbs-o-up" id="heart_<?php if(isset($main_newsDesc)){ echo $_row['unique_no']; }else{ echo $_row['Id']; } ?>" style="color:#595959; font-size:26px"></i>
                      </button>
                      <?php
                    }
                  }
                 ?>
            </div>

            <div class="comment_text_area">
              <div class="comment_list">
                <?php if (isset($_SESSION['Id'])): ?>

                <h5>Leave your comment(s) below</h5>
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
                  <div class="pull-left img_box">
                    <a class="" href="friends/friend_profile.php?friend_id=<?php echo $user['Id']; ?>">
                      <img src="/FUOBoxMedia/images/uploaded_images/profile_photos/<?php echo $user['profile_img']; ?>" alt="photos"/>
                    </a>
                  </div>
                  <div class="pull-left" style="margin-left:3%; padding-top:10px; padding-bottom:10px">
                     <span style="text-transform:capitalize; color:rgba(93,84,240,8.5); font-size:18px; font-family:arial; font-weight:600">
                        <?php echo $user['first_name']." ".$user['last_name']." <sapn style='text-transform:lowercase; font-size:11px; color:#565656'><i class='fa fa-at'></i>".$user['username']."</span>"; ?>
                     </span>
                     <br>
                     <div class="message"><?php echo $news_comment; ?>
                       <p class="time"><?php echo "<i class='fa fa-calendar'></i> ".$date." ".$CurrentMonth." '".$year." <em><strong>at</strong></em> ".$time; ?></p>
                     </div>
                  </div>
                  <div class="clearfix"></div>
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
<!-- jQuery -->
<script src="js/plugins/jquery/jquery-3.3.1.min.js"></script>
<!--  -->
<script type="text/javascript" src="js/plugins/bootstrap.min.js"></script>
<!-- custom new js -->
<script type="text/javascript" src="js/custom/news.js"></script>

</body>

</html>
