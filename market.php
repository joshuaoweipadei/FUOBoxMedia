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
  <?php include 'includes/header.php'; ?>
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
