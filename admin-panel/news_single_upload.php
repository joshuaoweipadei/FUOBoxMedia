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


include ('includes/database.php');

 ?>
 <!-- Living Faith Church, Otuoke
The Security Unit of LFC Otuoke holds their unity thanksgiving this Sunday.
Everyone is invited.
Venune : Church Auditorium. -->

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['upload_news'])) {

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $Fullname = test_input($_POST['full_name']);
    $newsTitle = test_input($_POST['news_title']);
    $newsDesc = mysqli_real_escape_string($conn, $_POST['news_desc']);
    $newsUniqueNo = test_input($_POST['unique_NO']);

    if (isset($Fullname) && isset($newsTitle) && isset($newsDesc) && isset($newsUniqueNo)) {
      if (empty($Fullname) || empty($newsTitle) || empty($newsDesc) || empty($newsUniqueNo)) {
        $imgError = "All fills must be fill up!";
      } else {

        if (is_numeric($newsUniqueNo)) {

          //Getting File(image) Arrays
          $profileImage_Name = $_FILES['image']['name'];
          $profileImage_TmpName = $_FILES['image']['tmp_name'];
          $profileImage_Size = $_FILES['image']['size'];
          $profileImage_Error = $_FILES['image']['error'];
          $profileImage_Type = $_FILES['image']['type'];

          //Get the Extension of the image
          $ImageExt = explode('.', $profileImage_Name);
          $ImageActualExt = strtolower(end($ImageExt));

          //Give the type of image extention the user can upload                        , 'pdf'
          $allowed = array('jpg', 'jpeg', 'png');

          if (in_array($ImageActualExt, $allowed)) {
            if ($profileImage_Error === 0) {
              if ($profileImage_Size <= 2000000) {
                $profileImage_NameNew = "single_news".time().".".$ImageActualExt;
                //image file directory
                $target = "uploaded_images/".$profileImage_NameNew;

                if (move_uploaded_file($profileImage_TmpName, $target)) {

                  $sql = "INSERT INTO news_single (full_name, unique_no, news_title, news_desc, news_img, `date`) VALUES
                        ('$Fullname', '$newsUniqueNo', '$newsTitle', '$newsDesc', '$profileImage_NameNew', NOW())";
                  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                  if ($query) {
                    $success = "<span style='color:#00cc00'>Your News has been upload successfully</span>";
                  }

                } else {

                  $imgError = "<span style='color:#ff4d4d'>Failed to upload image(s)!</span>";
                }
              } else {

                $imgError = "<span style='color:#ff4d4d'>Your image is too big!</span>";
              }
            } else {

              $imgError = "<span style='color:#ff4d4d'>Error in uploading image!</span>";
            }
          } else {

            $imgError = "<span style='color:#ff4d4d'>Please select an image!</span>";
          }
        } else {

          $imgError = "<span style='color:#ff4d4d'>Invalid customer unique No.</span>";
        }

      }
    }
  }
}



 ?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>News Upload | Single</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
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
                <h3>Single News </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Upload</h2>
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
                      <span class="pull-right" style="color:#ff8080">**All News fields must be properly filled up.</span>
                      <form class="" action="" method="POST" enctype="multipart/form-data">
                        <table class="table table-striped table-bordered:none" >
                          <tr>
                            <th>Customer Full Name :</th>
                            <td>
                              <div class="form-group">
                                <input type="text" name="full_name" class="form-control">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <th>Event or News Title :</th>
                            <td>
                              <div class="form-group">
                                <input type="text" name="news_title" class="form-control">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <th>Description :</th>
                            <td>
                              <div class="form-group">
                                <textarea type="text" name="news_desc" class="form-control"></textarea>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <th>Images :</th>
                            <td>
                              <div class="form-group">
                                <input type="file" name="image">
                              </div>
                              <div class="">
                                <?php if (isset($imgCount)) {
                                  echo $imgCount;
                                } ?>
                                <?php if (isset($imgError)) {
                                  echo $imgError;
                                } ?>
                                <?php if (isset($sizeType)) {
                                  echo $sizeType;
                                } ?>
                                <?php if (isset($success)) {
                                  echo $success;
                                } ?>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <th>Customer Unique No:</th>
                            <td>
                              <div class="form-group">
                                <input type="text" name="unique_NO" class="form-control">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <th></th>
                            <td><button type="submit" name="upload_news" class="btn btn-primary">Upload News</button></td>
                          </tr>
                        </table>
                      </form>
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
