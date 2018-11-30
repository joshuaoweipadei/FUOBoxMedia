<?php

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="../css/plugins/bootstrap-4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/plugins/font-awesome/css/font-awesome.min.css">
		<!--<link rel="stylesheet" href="css/flexboxgrid.css">-->
    <link rel="stylesheet" href="../css/custom/style_profile.css">
    <script type="text/javascript" src="/myProject/js/custom/user_scriptsheet.js"></script>
    <title></title>
</head>
<body>
	<header id="main_header" >
		<div class="container-fluid">

				<!--Header-->
				<div class="row center-xs center-sm start-md start-lg major-row" style="background-color:ed">
					<!--<div class="col-xs-15 col-sm-1 col-md-1 col-lg-1">
						<div class="side_menu">
								<a href="#" onclick="openSlideMenu()">
										<svg width="45" height="45">
												<path d="M0,5 45,5" stroke="#000" stroke-width="5"/>
												<path d="M0,16 45,16" stroke="#000" stroke-width="5"/>
												<path d="M0,27 45,27" stroke="#000" stroke-width="5"/>
												<path d="M0,38 45,38" stroke="#000" stroke-width="5"/>
										</svg>
								</a>
						</div>
					</div>-->

					<div class="col-xs-12 col-sm-8 col-md-7 col-lg-5" style="padding-top:5px">
						<a href="profile-page.php" style="color:#2f4f4f">
							<img src="images/logos/box-logo.png" class="logo-img" alt="logo" width="75" height="75">
							<h1 class="logo-name"><span style="color:orangered">E </span>- PROGRESS</h1><br>
							<h6 class="logo-motto">Essential minds for an excellent career</h6>
						</a>
					</div>
				</div>

        <!--MENU-->
        <!--DISPLAYS ON BIGGER sCREEN AND HIDE ON SMALLER SCREEN-->
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<nav>
							<ul class="menu">
								<li class="menubar"><a href="profile-page.php">Home</a></li>
                <!--THE FIRST HEADER MENU WITH DROPDOWN LIST-->
                <li class="menubar dropmenu">
                  <a href="javascript:void(0)" class="dropMenuBtn" onclick="headerMenu1()">Academics</a>
                  <div class="dropmenu-content" id="menuDropdown">
                    <a href="#" style="background-color:white">Express Learning</a>
                    <a href="#" style="background-color:white">Exam Past Questions</a>
                    <a href="#" style="background-color:white">Faculty list</a>
                  </div>
                </li>
								<li class="menubar"><a href="">Programs</a></li>
                <!--THE SECOND HEADER MENU WITH DROPDOWN LIST-->
                <li class="menubar dropmenu2">
                  <a href="javascript:void(0)" class="dropMenuBtn2" onclick="headerMenu2()">Buy & Sell</a>
                  <div class="dropmenu-content2" id="menuDropdown2">
                    <a href="#" style="background-color:white">Agents</a>
                    <a href="#" style="background-color:white">Sell on campus</a>
                    <a href="#" style="background-color:white">Buy on campus</a>
                  </div>
                </li>
								<li class="menubar"><a href="includes/about.author.php">About</a></li>
							</ul>
						</nav>
					</div>
        </div>

        <!--MENU FOR SMALLER SCREENS (Hidden from big screen)-->
        <!--DISPLAYS ON SMALLER sCREEN AND HIDE ON BIGGER SCREEN-->
				<div class="row start-xs start-sm start-md start-lg major-row" style="width:100%; overflow-x:hidden; position:relative">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="dropMenu">
              <button onclick="menu()" class="btn btn-primary dropbutton" style="display:">MENU</button>
              <div id="dropdown" class="menuList">
                <a href="#">Academics</a>
                <a href="#">Programs</a>
                <a href="#">Buy & Sell</a>
              </div>
            </div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <!--logout-->
						<a href="../myProject/logout.php" class="loginBtn">
							<button type="submit">
							<img src="images/logos/logout1.png" width="15" height="15"><i class="fa fa-home"></i> Log out
							</button>
						</a>
            <!--search-->
            <a href="search.php" class="search">
              <img src="images/gadget/search1.png" width="25">
            </a>
					</div>
				</div>

				<!--SIDE_BAR MENU
				<div id="side_menu" class="side_nav">
						<a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
						<a href="#"><img src="images/gadget/home1.png" width="35" /> Home</a>
						<a href="#"><img src="images/gadget/blog1.png" width="35" /> Blog</a>
						<a href="#"><img src="images/gadget/market1.png" width="35" /> FUOmarket</a>
						<a href="#"><img src="images/gadget/news2.png" width="35" /> News</a>
						<a href="#"><img src="images/gadget/calender1.png" width="35" /> Calender</a>
						<a href="#"><img src="images/user/friends2.png" width="35" /> Community</a>
						<a href="#"><img src="images/gadget/home2.png" width="35" /> Organization</a>
						<a href="#"><img src="images/gadget/forum1.png" width="35" /> Forum</a>
						<a href="#"><img src="images/gadget/settings1.png" width="35" /> Settings</a>
						<a href="#"><img src="images/gadget/logout1.png" width="35" />LogOut</a>
				</div>
				-->
		</div>
	</header>
</body>
</html>
