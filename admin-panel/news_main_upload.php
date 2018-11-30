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

          // FOR MULTIPLE IMAGE UPLOAD
          $j = 0;
          $error = array();
          $extension = array("jpeg", "jpg", "png", "gif");
          foreach ($_FILES["file"]["tmp_name"] as $key => $tmp_name) {
            $file_name = $_FILES["file"]["name"][$key];
            $file_tmp = $_FILES["file"]["tmp_name"][$key];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $j = $j + 1;

            if (($_FILES['file']['size'][$key] < 1000024) ) {
              if (in_array($ext, $extension)) {
                $filename = basename($file_name, $ext);
                $newFileName = $filename.time().".".$ext;

                if (move_uploaded_file($file_tmp, "uploaded_images/".$newFileName)) {

                  $sql = "INSERT INTO newss (full_name, unique_no, news_title, news_desc, news_img, `date`) VALUES
                        ('$Fullname', '$newsUniqueNo', '$newsTitle', '$newsDesc', '$newFileName', NOW())";
                        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        if ($query) {
                          $success = "Your News has been upload successfully";
                        }

                } else {
                  $imgError = '<span id="error">Please try again or Select an image(s).</span><br>';
                }

              } else {
                $imgError = '<span id="error">You have not selected any image(s).</span><br>';
              }

            } else {
              $sizeType = $j.'<span id="error"> Image(s) : ***Invalid file size or type***</span><br>';
            }
          }

        } else {
          $imgError = "Invalid customer unique No.";
        }



        // $j = 0;
        // $targetPath = "uploaded_images/";
        // for ($i=0; $i < count($_FILES['file']['name']); $i++) {
        //   $validExtensions = array("jpeg", "jpg", "png");
        //   $ext = explode('.', basename($_FILES['file']['name'][$i]));
        //   $file_extension = end($ext);
        //
        //   $targetPath = $targetPath.md5(rand(0,1000000)).".".$ext[count($ext) - 1];
        //   $j = $j + 1;
        //
        //   if (($_FILES['file']['size'][$i] < 1000000) && in_array($file_extension, $validExtensions)) {
        //
        //     $images = $_FILES['file']['tmp_name'][$i];
        //     if (move_uploaded_file($images, $targetPath)) {
        //       $imgCount = $j.').<span id="no_error">Image uploaded successfully!.</span><br>';
        //
        //       $sql = "INSERT INTO news (full_name, news_title, news_desc, news_img, `date`) VALUES
        //               ('$Fullname', '$newsTitle', '$newsDesc', '$images', NOW())";
        //       $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        //       if ($query) {
        //         $success = "Your News has been upload successfully";
        //       }
        //
        //     } else {
        //       $imgError = $j.').<span id="error">Please try again or Select an image(s).</span><br>';
        //     }
        //   } else {
        //     $sizeType = $j.').<span id="error">Please select an images  OR  ***Invalid file size or type***</span><br>';
        //   }
        // }

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

    <title>News Upload | Main</title>

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
                <h3>Main News</h3>
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
                                <input type="file" name="file[]" multiple>
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
