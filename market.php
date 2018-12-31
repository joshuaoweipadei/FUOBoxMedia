<?php

  session_start();

  // Check if user is logged in using the session variable
  if (isset($_SESSION['Id']) && isset($_SESSION['active'])) {

    //SESSION VARIABLE DECLARED
    // Makes it easier to read
    $userID = $_SESSION['Id'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];

  }

include ('database.php');

?>


<?php// require_once $_SERVER['DOCUMENT_ROOT'] . '/FUOBoxMedia/defines.php'; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FUO | MarketPlace</title>

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
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <!-- popup style -->
    <link href="css/plugins/dist/custom.css" rel="stylesheet">

    <!-- main custom style -->
    <link rel="stylesheet" href="css/custom/main.css">
    <link rel="stylesheet" href="css/custom/style.css">
    <link rel="stylesheet" href="css/custom/market.css">


    <script type="text/javascript" src="js/custom/user_scriptsheet.js"></script>
    <!-- <script type="text/javascript" src="js/plugins/bootstrap-4.0.0/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="js/plugins/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/comment/comment-insert.js?t=<?php echo time(); ?> "></script>








    <!--  -->
    <link rel="stylesheet" href="pixal/css/ionicons.min.css">
    <link rel="stylesheet" href="pixal/css/et-line.css">
    <!-- Plugins css file -->
    <link rel="stylesheet" href="pixal/css/plugins.css">
    <!-- Theme main style -->
    <!-- <link rel="stylesheet" href="pixal/style.css"> -->
    <!-- Responsive css -->
    <link rel="stylesheet" href="pixal/css/responsive.css">
    <!-- Modernizr JS -->
    <script src="pixal/js/vendor/modernizr-2.8.3.min.js"></script>

</head>
<body>

  <!--PAGE HEADER-->
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
          <div class="col-xs-12 col-sm-6">
            <?php if (isset($_SESSION['Id'])) { ?>
            <ul class="nav navbar-nav navbar-right ">
              <!-- SMALL PROFILE DETAILS -->
              <li class="dropdown" style="padding:0px 18px 0px 18px; margin:0px">
                <a href="javascript:;" class="profile_icon pull-right" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/me/josh1.jpg" alt="">John Doe
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
              <li role="presentation" class="dropdown" style="padding:0px 18px 0px 18px; margin:0px">
                <a class="info-number pull-left" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="All Notificcations">
                  <i class="fa fa-bell" style="font-size:21px"></i>
                  <span class="badge bg-green"><?php echo $notic_count; ?></span>
                </a>
              </li>
              <?php
                  } else {
              ?>
              <li role="presentation" class="dropdown" style="padding:0px 18px 0px 18px; margin:0px">
                <a class="info-number pull-left" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="All Notifications">
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
              <li role="presentation" class="dropdown" style="padding:0px 18px 0px 18px; margin:0px">
                <a class="info-number pull-left" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="MESSAGES">
                  <i class="fa fa-envelope-o" style="font-size:21px"></i>
                  <span class="badge bg-green"><?php echo $unread_count; ?></span>
                </a>
              </li>
              <?php
                  } else {
              ?>
              <li role="presentation" class="dropdown" style="padding:0px 18px 0px 18px; margin:0px">
                <a class="info-number pull-left" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="MESSAGES">
                  <i class="fa fa-envelope-o" style="font-size:21px"></i>
                  <span class="badge bg-green"></span>
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
                <div class="logo text-center">
                  <div class="text-center">
                    <a href="profile-page.php" style="color:#2f4f4f">
                      <img src="images/advert/logo.png" class="logo-img" alt="logo" width="180" height="140">
                      <br>
                      <h3 class="logo-name"><span class="a">FUO</span><span class="b">BoxMedia</span></h3>
                      <span class="logo-quote">Chat with other students bafore the event to create relationships and make the best of your time on campus.</span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="shop-menu">
                  <ul class="nav navbar-nav pull-right">
                    <!-- <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li> -->
                    <!-- <li><a href="checkout.php"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                    <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li> -->

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
                <div class="front_img">
                  <img src="images/advert/a2.jpg" alt="">
                  <h4>Made it easy to chat up a friend on campus</h4>
                </div>
                <div class="col-md-6">
                  <div class="item_search">
                    <div class="search_box">
                      <form action="results.php" method="GET" enctype="multipart/form-data">
                        <input class="search" type="text" name="search" placeholder="Your searching item..."/>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="background:#000">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>

                <div class="mainmenu pull-left">
                  <ul class="nav navbar-nav collapse navbar-collapse">
                    <?php
                      if (isset($_SESSION['Id'])) {
                        echo "<li><a href='profile_page.php' class='list' style='font-family: 'Roboto', sans-serif;'>Dashboard</a></li>";
                      }
                     ?>
                     <li><a href="index.php" class="list" style="font-family: 'Roboto', sans-serif;">News</a></li>
                     <li><a href="market.php" class="list" style="font-family: 'Roboto', sans-serif;">buy</a></li>
                     <li><a href="business/upload.php" class="list" style="font-family: 'Roboto', sans-serif;">sell</a></li>
                    <!-- <li class="menubar dropmenu"><a href="javascript:void(0)" class="list dropMenuBtn" style="font-family: 'Roboto', sans-serif;" onclick="headerMenu1()">Market</a>
                      <div class="dropmenu-content ty" id="menuDropdown">
                        <a href="market.php" style="font-family:cursive; font-size:11px">Buy stuffs</a>
                        <a href="business/upload.php" style="font-family:cursive; font-size:11px">Sell stuffs</a>
                      </div>
                    </li> -->
                  </ul>
                </div>
              </div>

            </div>
          </div>
        </div><!--/header-bottom-->
      </div>
    </div>
  </header><!--/header-->
  <!-- END OF HEADER -->



  <section>
    <div class="container">
      <!-- LEFT SIDE -->
      <div class="row">
        <div class="ads">
          <h3><span> <i class="fa fa-cubes"></i> Your online marketsplace</span>
          </h3>
        </div>

        <div class="col-sm-12" style="padding:0">
          <div class="">
            <?php
              $sql = "SELECT * FROM selling_item ORDER BY Id DESC LIMIT 0,6";
              $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
              if ($query) {
                while ($item = mysqli_fetch_array($query)) {
                  ?>
                  <div class="col-sm-2" style="padding:2px">
                    <div class="panel panel-default">
                      <div class="panel-body profile">
                        <div class="profile-image">
                            <img src="/FUOBoxMedia/uploaded_images/selling_images/<?php echo $item{'itemImage'} ?>" alt="Dmitry Ivaniuk" width="100%" height="200px"/>
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name text-center"><b><?php echo $item{'itemName'} ?></b></div>
                        </div>
                        <div class="profile-controls">
                          <p><i class="fa fa-money"></i> <?php echo $item{'itemPrice'} ?></p>
                          <p><i class="fa fa-info"></i> <?php echo $item{'itemDesc'} ?></p>
                          <p><i class="fa fa-phone"></i> <?php echo $item{'sellerMobile'} ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              }
             ?>
        </div>

        <div class="">
          <?php
            $sql = "SELECT * FROM selling_item ORDER BY Id DESC LIMIT 6,4";
            $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            if ($query) {
              while ($item = mysqli_fetch_array($query)) {
                ?>
                <div class="col-sm-3" style="padding:2px">
                  <div class="panel panel-default">
                    <div class="panel-body profile">
                      <div class="profile-image">
                          <img src="/FUOBoxMedia/uploaded_images/selling_images/<?php echo $item{'itemImage'} ?>" alt="Dmitry Ivaniuk" width="100%" height="200px"/>
                      </div>
                      <div class="profile-data">
                          <div class="profile-data-name text-center"><b><?php echo $item{'itemName'} ?></b></div>
                      </div>
                      <div class="profile-controls">
                        <p><i class="fa fa-money"></i> <?php echo $item{'itemPrice'} ?></p>
                        <p><i class="fa fa-info"></i> <?php echo $item{'itemDesc'} ?></p>
                        <p><i class="fa fa-phone"></i> <?php echo $item{'sellerMobile'} ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
           ?>
      </div>
    </div>


    <div class="row sec">
      <div class="col-sm-4">
        <div class="A">
          <i class="fa fa-phone"></i>
          <h4>0706 6654 1458</h4>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="B">
          <i class="fa fa-envelope"></i>
          <h4>oweipadeijoshie@gmail.com</h4>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="C">
          <i class="fa fa-map-marker"></i>
          <h4>Federal University Otuoke</h4>
        </div>
      </div>
    </div>

    <div class="col-sm-12" style="padding:0">
      <div class="">
        <?php
          $sql = "SELECT * FROM selling_item ORDER BY Id DESC LIMIT 10,12";
          $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
          if ($query) {
            while ($item = mysqli_fetch_array($query)) {
              ?>
              <div class="col-sm-2" style="padding:2px">
                <div class="panel panel-default">
                  <div class="panel-body profile">
                    <div class="profile-image">
                        <img src="/FUOBoxMedia/uploaded_images/selling_images/<?php echo $item{'itemImage'} ?>" alt="Dmitry Ivaniuk" width="100%" height="200px"/>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name text-center"><b><?php echo $item{'itemName'} ?></b></div>
                    </div>
                    <div class="profile-controls">
                      <p><i class="fa fa-money"></i> <?php echo $item{'itemPrice'} ?></p>
                      <p><i class="fa fa-info"></i> <?php echo $item{'itemDesc'} ?></p>
                      <p><i class="fa fa-phone"></i> <?php echo $item{'sellerMobile'} ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          }
         ?>
    </div>
    </div>

  </div>
</div>


    <!--Corporate 1 Client Section-->
    <div class="mp-client-section section pt-100 pb-100">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">
                    <!--Client Slider-->
                    <div class="mp-client-slider text-center">
                        <div class="single-client"><img src="pixal/img/minimal/client/1.png" alt=""></div>
                        <div class="single-client"><img src="pixal/img/minimal/client/2.png" alt=""></div>
                        <div class="single-client"><img src="pixal/img/minimal/client/3.png" alt=""></div>
                        <div class="single-client"><img src="pixal/img/minimal/client/4.png" alt=""></div>
                        <div class="single-client"><img src="pixal/img/minimal/client/3.png" alt=""></div>
                        <div class="single-client"><img src="pixal/img/minimal/client/2.png" alt=""></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!--slider-->
<section id="slider">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div id="slider-carousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#slider-carousel" data-slide-to="1"></li>
            <li data-target="#slider-carousel" data-slide-to="2"></li>
          </ol>

          <div class="carousel-inner">
            <div class="item active">
              <div class="col-sm-12" style="padding:0">
                <div class="item_box">
                  <img src="images/advert/market_slide1.jpg" class="" alt="" height="400px" width="100%"/>
                  <!-- <h3>Get someone to buy your item here on campus <span></span></h3>
                  <a href="business/upload.php" class="btn btn-primary">upload item</a> -->
                </div>
              </div>
            </div>

            <div class="item">
              <div class="col-sm-12" style="padding:0">
                <div class="item_box">
                  <img src="images/advert/market_slide2.jpg" class="" alt="" height="400px" width="100%"/>
                  <!-- <h3>You have problems in your studies, you can ask questions and get instant answers.. <br>You can offer assist students campus by render the best answers to their questions </h3>
                  <a href="" class="btn btn-primary">FAQ</a> -->
                </div>
              </div>
            </div>

            <div class="item">
              <div class="col-sm-12" style="padding:0">
                <div class="item_box">
                  <img src="images/advert/market_slide3.jpg" class="" alt="" height="400px" width="100%"/>
                  <!-- <h3>We bring to you all the latest gist on campus and Chat up your friends here in campus. </h3> -->
                </div>
              </div>
            </div>
          </div>
          <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/slider-->




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
<script src="pixal/js/vendor/jquery-3.1.1.min.js"></script>
<!-- Bootstrap js -->
<script src="pixal/js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="pixal/js/plugins.js"></script>
<!-- Ajax Mail js -->
<script src="pixal/js/ajax-mail.js"></script>
<!-- Main js -->
<script src="pixal/js/main.js"></script>
























<script src="js/plugins/jquery/jquery.js"></script>

    <script src="js/plugins/jquery.scrollUp.min.js"></script>
    <script src="js/custom/main.js"></script>
    <script src="js/plugins/jquery-slim.min.js"></script>
    <script src="js/plugins/popper.min.js"></script>

    <script src="js/plugins/util.js"></script>
    <script src="js/plugins/tab.js"></script>
    <script src="js/plugins/dropdown.js"></script>
    <script src="js/plugins/collapse.js"></script>




    <script src="js/plugins/dist/jquery.min.js"></script>
<script src="js/plugins/bootstrap.min.js"></script>
    <script src="js/custom/dist/custom.min.js"></script>


</body>
</html>
