<header id="header"><!--header-->
  <div class="header_top"><!--header_top-->
    <div class="container">
      <div class="row" style="background:rgba(93,84,240,8.5)">
        <div class="col-xs-6 col-sm-6">
          <div class="contactinfo">
            <ul class="nav nav-pills top-contact-address">
              <li><a href="#"><i class="fa fa-phone"></i> +706 654 1485</a></li>
              <li><a href="#"><i class="fa fa-envelope"></i> oweipadeijoshie@gmail.com</a></li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6">
          <?php if (isset($_SESSION['Id']) && isset($_SESSION['email'])) { ?>
          <ul class="nav navbar-nav navbar-right">
            <!-- SMALL PROFILE DETAILS -->
            <li class="dropdown pull-right" style="padding:0px 18px 0px 18px; margin:0px">
              <a href="javascript:;" class="profile_icon pull-right" style="padding-top:0px; padding-bottom:0px;font-size:14px;font-weight:400;font-family:arial" data-toggle="dropdown" aria-expanded="false">
                <img src="uploaded_images/<?php echo $profile_img; ?>" alt=""><?php echo $firstname." ".$lastname; ?>
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
            <li role="presentation" class="dropdown pull-left top-notification">
              <a class="info-number" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="All Notificcations">
                <i class="fa fa-bell" style="font-size:21px"></i>
                <span class="badge bg-green"><?php echo $notic_count; ?></span>
              </a>
            </li>
            <?php
                } else {
            ?>
            <li role="presentation" class="dropdown pull-left top-notification">
              <a class="info-number" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="All Notifications">
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
            <li role="presentation" class="dropdown pull-left top-notification">
              <a class="info-number" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="MESSAGES">
                <i class="fa fa-envelope-o" style="font-size:21px"></i>
                <span class="badge bg-green"><?php echo $unread_count; ?></span>
              </a>
            </li>
            <?php
                } else {
            ?>
            <li role="presentation" class="dropdown pull-left top-notification">
              <a class="info-number" style="padding-top:0px; padding-bottom:0px" data-toggle="dropdown" aria-expanded="false" title="MESSAGES">
                <i class="fa fa-envelope-o" style="font-size:21px"></i>
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
              <div class="front_img text-center">
                <img src="images/advert/a2.jpg" alt="">
                <h4 class="text-center">Made it easy to chat up a friend on campus</h4>
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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="background:rgb(93,84,240,8.5)">
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
                      echo "<li><a href='profile_page.php' class='list'>Dashboard</a></li>";
                    }
                   ?>
                   <li><a href="index.php" class="list active">News</a></li>
                   <li><a href="market.php" class="list">buy</a></li>
                   <li><a href="business/upload.php" class="list">sell</a></li>
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
