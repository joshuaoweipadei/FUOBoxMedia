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

include ('includes/database.php');

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
    <title>FUOBoxMedia | MarketPlace</title>
    <link rel="stylesheet" href="css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">

    <!-- light-box -->
    <link rel="stylesheet" type="text/css" href="css/plugins/jquery.fancybox.css" media="screen" />

    <!-- custom css -->
    <link rel="stylesheet" href="css/custom/main.css">
    <link rel="stylesheet" href="css/custom/market.css">

</head>
<body>
  <!--PAGE HEADER-->
  <div class="top-header">
    <div class="pull-left">
      <ul class="nav nav-pills">
        <li><a href="index.php"><span class="logo-name"><i class="fa fa-th-large" style="font-size:26px"></i> <span style="color:#fff" >FUO</span><span style="color:rgba(185,0,255,0.9)">BoxMedia</span></span></a></li>
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

  <div class="header-middle">
    <div class="cover_wall">
      <div class="showcase">
        <div class="container">
          <div class="col-md-6 header-hide" style="padding:0; margin:0;">
            <div class="text-center">
              <div class="front_img text-center">
                <img src="images/advert/a2.jpg" alt="front img">
                <h4 class="text-center">Made it easy to chat up a friend on campus</h4>
              </div>
            </div>
          </div>
          <div class="col-md-6" style="padding:0; margin:0">
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

  <div class="header-bottom"><!--header-bottom-->
    <ul class="topnav">
      <div class="container">
        <li><a href="index.php">Home</a></li>
        <?php
        if (isset($_SESSION['Id'])) {
          ?>
          <li><a href="index.php?timeline">Timeline</a></li>
          <?php
        }
         ?>
        <li><a href="buy_stuffs.php">Buy Stuffs</a></li>
        <li><a href="sell_item.php">Sell something</a></li>
        <?php
        if (isset($_SESSION['Id'])) {
          ?>
          <li><a href="profile_page.php">Dashboard</a></li>
          <li class="dropdown pull-left top-notification">
            <a href="user/send_message.php" class="info-number">
              Message <i class="fa fa-envelope-o" style="font-size:21px"></i>
              <span class="badge bg-green"><?php echo '51'; ?></span>
            </a>
          </li>
          <?php
        }
         ?>
        <li class="icon">
          <a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
        </li>
      </div>
    </ul>
  </div><!--/header-bottom-->
  <!-- END OF HEADER -->

<section>
  <div class="container">
    <div class="row">
      <div class="ads">
        <h3><span> <i class="fa fa-cubes"></i> Your online marketsplace</span></h3>
      </div>

      <div class="col-md-12" style="padding:0">
        <div class="">
          <?php
            $sql = "SELECT * FROM selling_item ORDER BY Id DESC LIMIT 0,4";
            $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            if ($query) {
              while ($item = mysqli_fetch_array($query)) {
                ?>
                <div class="col-sm-6 col-md-3" style="padding:2px">
                  <div class="panel panel-default">
                    <div class="panel-body profile">
                      <div class="profile-image">
                        <img src="/FUOBoxMedia/images/uploaded_images/sales_photos/<?php echo $item{'itemImage'} ?>" alt="Dmitry Ivaniuk" width="100%" height="200px"/>
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
              $sql = "SELECT * FROM selling_item ORDER BY Id DESC LIMIT 4,3";
              $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
              if ($query) {
                while ($item = mysqli_fetch_array($query)) {
                  ?>
                  <div class="col-sm-4" style="padding:2px">
                    <div class="panel panel-default">
                      <div class="panel-body profile">
                        <div class="profile-image">
                          <img src="/FUOBoxMedia/images/uploaded_images/sales_photos/<?php echo $item{'itemImage'} ?>" alt="Dmitry Ivaniuk" width="100%" height="200px"/>
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

          <div class="sec">
            <h3>Contact support here</h3>
            <div class="col-sm-4">
              <div class="A">
                <i class="fa fa-phone" style="color:#2eb82e"></i>
                <h4>0706 6654 1458</h4>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="B">
                <i class="fa fa-envelope" style="color:#0000ff"></i>
                <h4>oweipadeijoshie@gmail.com</h4>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="C">
                <i class="fa fa-map-marker" style="color:#ff0000"></i>
                <h4>Federal University Otuoke</h4>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="col-md-12" style="padding:0">
            <div class="">
              <?php
                $sql = "SELECT * FROM selling_item ORDER BY Id DESC LIMIT 8,12";
                $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if ($query) {
                  while ($item = mysqli_fetch_array($query)) {
                    ?>
                    <div class="col-sm-6 col-md-3" style="padding:2px">
                      <div class="panel panel-default">
                        <div class="panel-body profile">
                          <div class="profile-image">
                              <img src="/FUOBoxMedia/images/uploaded_images/sales_photos/<?php echo $item{'itemImage'} ?>" alt="Dmitry Ivaniuk" width="100%" height="200px"/>
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


  <!-- jQuery -->
  <script src="js/plugins/jquery/jquery-3.3.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/plugins/bootstrap.min.js"></script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom/main.js"></script>

</body>
</html>
