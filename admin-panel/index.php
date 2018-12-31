<?php
session_start();

if (isset($_SESSION['Id']) && isset($_SESSION['email'])) {

  $adminId = $_SESSION['Id'];
  $FirstName = $_SESSION['first_name'];
  $LastName = $_SESSION['last_name'];
  $Email = $_SESSION['email'];
  $Active = $_SESSION['active'];
  $ProImg = $_SESSION['profile_img'];

} else {
  header('location: login.php');
}


include ('functions/function.php');
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Admin | Panel</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/plugins/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include ('includes/header.php'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count"><?php totalUsers(); ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php Average_totalUsers(); ?> </i> per week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
              <div class="count">123</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php Average_totalUsers(); ?> </i> per week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
              <div class="count green"><?php totalMaleUsers(); ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php Average_totalMaleUsers(); ?> </i> per week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
              <div class="count"><?php totalFemaleUsers(); ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php Average_totalFemaleUsers(); ?> </i> per week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Online Users</span>
              <div class="count"><?php onlineUsers(); ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php Average_onlineUsers(); ?> </i> per week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Offline Users</span>
              <div class="count"><?php offlineUsers(); ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?php Average_offlineUsers(); ?> </i> per week</span>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-database"></i></div>
                <div class="count"><?php totalStatus(); ?></div>
                <h3>Total Status</h3>
                <p>Lorem ipsum psdea itgum rixt.</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-comments-o"></i></div>
                <div class="count"><?php totalComments(); ?></div>
                <h3>Total Comments</h3>
                <p>Lorem ipsum psdea itgum rixt.</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                <div class="count">179</div>
                <h3>New Sign ups</h3>
                <p>Lorem ipsum psdea itgum rixt.</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                <div class="count">179</div>
                <h3>New Sign ups</h3>
                <p>Lorem ipsum psdea itgum rixt.</p>
              </div>
            </div>
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-xs-12 table">
              <div class="">
                <h3>Posted Status</h3>
              </div>
              <table class="table table-striped">
                <?php
                  $sqlStatus = "SELECT * FROM status_post ORDER BY date_posted DESC";
                  $queryStatus = mysqli_query($conn, $sqlStatus) or die(mysqli_error($conn));
                  if ($queryStatus) {
                    echo '<thead>
                            <tr>
                              <th>S/N</th>
                              <th>User Full Name</th>
                              <th>No. Comnts</th>
                              <th>No. Likes</th>
                              <th style="width: 50%">Status</th>
                              <th>Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          ';

                      $i = 0;
                      while ($rowStatus = mysqli_fetch_array($queryStatus)) {
                        $i++;
                        $status_id = $rowStatus['status_id'];
                        $user_id = $rowStatus['userId'];

                        // getting the user of the status
                        $sql_user = "SELECT * FROM users_account WHERE Id = '$user_id'";
                        $query_user = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));
                        if ($query_user) {
                          if ($row_user = mysqli_fetch_array($query_user)) {

                            // getting the No. Comments
                            $sql_comments = "SELECT * FROM comments WHERE statusId = '$status_id'";
                            $query_comments = mysqli_query($conn, $sql_comments) or die(mysqli_error($conn));
                            if ($query_comments) {
                              $comment_count = mysqli_num_rows($query_comments);

                              // getting the No. Likes
                              $sql_likes = "SELECT * FROM like_unlike WHERE statusId = '$status_id'";
                              $query_likes = mysqli_query($conn, $sql_likes) or die(mysqli_error($conn));
                              if ($query_likes) {
                                $likes_count = mysqli_num_rows($query_likes);

                                echo '<tbody>
                                        <tr>
                                          <td>'.$i.'</td>
                                          <td>'.$row_user['first_name'].' '.$row_user['last_name'].'</td>
                                          <td>'.$comment_count.'</td>
                                          <td>'.$likes_count.'</td>
                                          <td>'.$rowStatus['status'].'</td>
                                          <td>'.$rowStatus['date_posted'].'</td>
                                          <td>
                                          <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle btn-sm" type="button" aria-expanded="false">Delete <span class="caret"></span>
                                            </button>
                                            <ul role="menu" class="dropdown-menu" style="width:2px">
                                              <li><a href="#">No</a>
                                              </li>
                                              <li class="divider"></li>
                                              <li><a href="functions/delete.php?delete_status='.$rowStatus['status_id'].'" delete_status">Yes</a>
                                              </li>
                                            </ul>
                                            </div>
                                        </td>
                                        </tr>
                                      </tbody>
                                ';

                              }
                            }
                          }
                        }
                      }
                  }
                 ?>


              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">


            <div class="col-md-8 col-sm-8 col-xs-12">
              <div class="row">
                <!-- Start to do list -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>To Do List <small>Sample tasks</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <div class="">
                        <ul class="to_do">
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Schedule meeting with new client </p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Create email address for new intern</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Create email address for new intern</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End to do list -->
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Federal University Otuoke - BoxMedia by Joshua Oweipadei Bayefa
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/plugins/custom.min.js"></script>

  </body>
</html>
