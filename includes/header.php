
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
                  <?php
                    if (isset($_SESSION['Id'])) {
                      echo "<li><a href='profile_page.php' style='padding:4px 8px;'><i class='fa fa-user'></i> My Dashboard</a></li>";
                    }
                   ?>
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
                  <li><a href="index.php" class="list" style="font-family: 'Roboto', sans-serif;">Home</a></li>
                  <li class="menubar dropmenu"><a href="javascript:void(0)" class="list dropMenuBtn" style="font-family: 'Roboto', sans-serif;" onclick="headerMenu1()">Programs</a>
                    <div class="dropmenu-content ty" id="menuDropdown">
                      <a href="#" style="font-family:cursive; font-size:11px">Express Learning</a>
                      <a href="#" style="font-family:cursive; font-size:11px">Exam Past Questions</a>
                      <a href="#" style="font-family:cursive; font-size:12px">Faculties</a>
                    </div>
                  </li>
                  <li><a href="market.php" class="list" style="font-family: 'Roboto', sans-serif;">Market</a></li>
                  <li><a href="business/upload.php" class="list" style="font-family: 'Roboto', sans-serif;">Uploads</a></li>
                  <li><a href="#stove" class="list" style="font-family: 'Roboto', sans-serif;">Search</a></li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div><!--/header-bottom-->
    </div>
  </div>

</header><!--/header-->
