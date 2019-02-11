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
              <a href="index.php">
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
