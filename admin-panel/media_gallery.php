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

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="build/css/plugins/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include ('includes/header.php'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Buy & Sell </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Items on Sales </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">

                      <p>All current items that are on sales</p>

                      <?php
                        $sql = "SELECT * FROM selling_item ORDER BY Id DESC";
                        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        if ($query) {
                          while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <div class="col-md-55">
                              <div class="thumbnail">
                                <div class="image view view-first">
                                  <img style="width: 100%; display: block;" src="/FUOBoxMedia/uploaded_images/selling_images/<?php echo $row['itemImage']; ?>" alt="image" />
                                  <div class="mask">
                                    <p><?php echo $row['itemPrice']; ?></p>
                                    <div class="tools tools-bottom">
                                      <?php echo $row['itemName']; ?>
                                    </div>
                                  </div>
                                </div>
                                <div class="caption">
                                  <p><?php echo $row['itemDesc']; ?></p>
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
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
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

    <!-- Custom Theme Scripts -->
    <script src="build/js/plugins/custom.min.js"></script>
  </body>
</html>
