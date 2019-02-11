<?php

session_start();

 ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FUOBoxMedia | Upload Sales Items</title>

    <link rel="stylesheet" href="css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="css/plugins/font-awesome/css/font-awesome.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="css/custom/main.css">
    <style media="screen">
     .upload_item{
      margin-bottom: 190px;
      padding: 2px;
      background: #fff;
    }
    .upload_item h3{
     text-transform: ;
     font-family: arial;
     font-size: 23px;
     color: #595959;
    }
    .upload_item h5{
      font-size: 15px;
      font-family: arial;
      color: rgba(93,84,240,8.5);
    }
    .form{
      margin-top: 38px;
    }

    </style>
</head>

<?php include_once 'includes/database.php'; ?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['upload_item'])) {

      // Escape all $_POST variables to protect against SQL injections
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $sellerName = test_input($_POST['seller_name']);
      $itemName = test_input($_POST['item_name']);
      $itemDesc = test_input($_POST['desc']);
      $itemPrice = test_input($_POST['price']);
      $sellerMobile = test_input($_POST['seller_mobile']);

      if (empty($sellerName) || empty($itemName) || empty($itemDesc) || empty($itemPrice) || empty($sellerMobile) ) {
        $MessageErr = "All Fields are Required";
      } else {
        if (isset($_FILES["item_image"]["name"]) && $_FILES["item_image"]["name"] != '') {
          if (is_numeric($itemPrice)) {
            if (is_numeric($sellerMobile) && strlen($sellerMobile) == 11) {

              //Getting File(image) Arrays
              $profileImage_Name = $_FILES['item_image']['name'];
              $profileImage_TmpName = $_FILES['item_image']['tmp_name'];
              $profileImage_Size = $_FILES['item_image']['size'];
              $profileImage_Error = $_FILES['item_image']['error'];
              $profileImage_Type = $_FILES['item_image']['type'];

              //Get the Extension of the image
              $ImageExt = explode('.', $profileImage_Name);
              $ImageActualExt = strtolower(end($ImageExt));
              //Give the type of image extention the user can upload
              $allowed = array('jpg', 'jpeg', 'png');

              if (in_array($ImageActualExt, $allowed)) {
                if ($profileImage_Error === 0) {
                  if ($profileImage_Size <= 2000000) {
                    $profileImage_NameNew = "seller_".$sellerName."_".time().".".$ImageActualExt;

                    //image file directory
                    $target = "images/uploaded_images/sales_photos/".$profileImage_NameNew;

                    if (move_uploaded_file($profileImage_TmpName, $target)) {
                      $sql = "INSERT INTO selling_item (sellerName, sellerMobile, itemName, itemDesc, itemPrice, itemImage, date_entered)
                                VALUE ('$sellerName', '$sellerMobile', '$itemName', '$itemDesc', '$itemPrice', '$profileImage_NameNew', CURTIME())";
                      $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                      if ($query) {
                        $MessageSuccess = "Your Item has been uploaded successfully, <strong>thank you for choosing us.</strong>";
                      }
                    }

                  } else {
                    $MessageErr = "Image is too large.";
                  }
                } else {
                  $MessageErr = "Error uploading Image.";
                }
              }

            } else {
              $MessageErr = "Invalid phone No. (max 11)";
            }
          } else {
            $MessageErr = "Invalid Price Value.";
          }
        } else {
          $MessageErr = "Select an Image of the Item you wish to sell.";
        }
      }

    }
  }
 ?>


<body>
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
          <div class="col-md-12" style="padding:0; margin:0">
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

  <section class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-">
        <div class="upload_item">
          <h3><i class="fa fa-truck" style="color:#009900"></i> We offer students the opportunity to sell any of their items on campus with stress free.</h3>
          <h5>Fill in all the required field E.g name of the item, item description, price, and your mobile contact.
            <a href="javascript:history.back()" style="color:#ff0000; border:none"> Go back</a>
          </h5>

          <div class="form">
            <form action=" " method="POST" enctype="multipart/form-data">
              <div>
                <div style="font-size:15px; font-family:arial; color:#ff0000">
                  <?php if (isset($MessageErr)): ?>
                    <?php echo $MessageErr ?>
                  <?php endif; ?>
                </div>

                <div style="font-size:15px; font-family:arial; color:#00cc00">
                  <?php if (isset($MessageSuccess)): ?>
                    <?php echo $MessageSuccess ?>
                  <?php endif; ?>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <label for="">Full Name:</label>
                    <input type="text" name="seller_name" class="form-control" placeholder="Full Name">
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <label for="">Name of Item:</label>
                    <input type="text" name="item_name" class="form-control" placeholder="Name of Item">
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <label for="">Description of Item:</label>
                    <textarea name="desc" class="form-control" placeholder="Description"></textarea>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <label for="">Image:</label>
                    <input type="file" name="item_image" id="fileUpload">
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <label for="">Amount:</label>
                    <input type="text" name="price" class="form-control" placeholder="Amount">
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <label for="">Contact Number:</label>
                    <input type="text" name="seller_mobile" class="form-control" placeholder="Phone Number">
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <button type="submit" name="upload_item" class="btn btn-success pull-right" style="background:rgba(93,84,240,8.5); border:none"> Upload item</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="clearfix"></div>
        </div>

      </div>
    </div>
  </section>

</body>
</html>
