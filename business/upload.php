<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Welcome | Market Place</title>

    <!-- <link rel="stylesheet" href="css/plugins/bootstrap-4.0.0/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="css/plugins/theme-default.css"> -->
    <link rel="stylesheet" href="../css/plugins/font-awesome/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="css/plugins/w3css/w3css.css"> -->
    <!-- <link rel="stylesheet" href="css/plugins/default/theme-default.css"> -->
    <link href="../css/plugins/font-awesome.min.css" rel="stylesheet">
    <link href="../css/plugins/prettyPhoto.css" rel="stylesheet">
    <link href="../css/plugins/price-range.css" rel="stylesheet">
    <link href="../css/plugins/animate.css" rel="stylesheet">
    <link href="../css/plugins/responsive.css" rel="stylesheet" media="all">
    <link href="../css/plugins/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <!-- popup style -->
    <link href="../css/plugins/dist/custom.css" rel="stylesheet">

    <!-- main custom style -->
    <link rel="stylesheet" href="../css/custom/main.css">
    <link rel="stylesheet" href="../css/custom/style.css">
    <link rel="stylesheet" href="../css/custom/market.css">

    <script type="text/javascript" src="../js/custom/user_scriptsheet.js"></script>
    <script type="text/javascript" src="../js/plugins/jquery/jquery-3.3.1.min.js"></script>
</head>

<?php include_once '../database.php'; ?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['upload_item'])) {

      // Escape all $_POST variables to protect against SQL injections
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $sellerNameErr = $itemNameErr = $itemDescErr = $itemPriceErr = $sellerNumberErr = "";

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
                  $target = "../uploaded_images/selling_images/".$profileImage_NameNew;

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
  <section class="container-fliud">
    <div class="row">
      <div class="col-sm-3 empty">

      </div>
      <div class="col-sm-9">
        <div class="upload_item">
          <h3> <i class="fa fa-gift"></i> Upload your item you want to sell here!</h3>
          <h5>Fill in all the required field E.g name of the item, item description, price, and your mobile contact</h5>

          <div class="form">
            <form class="" action="" method="POST" enctype="multipart/form-data">
              <div class="">
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
                <table width="70%" style="background:#fff">
                  <tr>
                    <th><br><label for="">Full Name:</label> </th>
                    <td><br><input type="text" name="seller_name" class="form-control" placeholder="Full Name" width="100px"></td>
                  </tr>
                  <tr>
                    <th><br><label for="">Name of Item:</label> </th>
                    <td><br><input type="text" name="item_name" class="form-control" placeholder="Name of Item" width="100px"></td>
                  </tr>
                  <tr>
                    <th><br><label for="">Description of Item:</label> </th>
                    <td><br><textarea name="desc" class="form-control" placeholder="Description"></textarea> </td>
                  </tr>
                  <tr>
                    <th><br><label for="">Image:</label></th>
                    <td><br><input type="file" name="item_image" id="fileUpload">
                      <!-- <div id="image-holder"> </div>
                      <script>
                        $("#fileUpload").on('change', function(){
                          if (typeof (FileReader) != "undefined") {
                            var image_holder = $("#image-holder");
                            image_holder.empty();

                            var reader = new FileReader();
                            reader.onload() = function (e){
                              $("<img />", {
                                "src": e.target.result,
                                "class": "thumb-image"
                              }).appendTo(image_holder);
                            }
                            image_holder.show();
                            reader.readAsDataURL($(this)[0].files[0]);
                          } else{
                            alert("this browser does not support FileReader.");
                          }
                        });
                      </script> -->
                    </td>
                  </tr>
                  <tr>
                    <th><br><label for="">Amount:</label></th>
                    <td><br><input type="text" name="price" class="form-control" placeholder="Amount"></td>
                  </tr>
                  <tr>
                    <th><br><label for="">Contact Number:</label></th>
                    <td><br><input type="text" name="seller_mobile" class="form-control" placeholder="Phone Number"></td>
                  </tr>
                  <tr>
                    <th><br></th>
                    <td>
                      <br>
                      <a href="/FUOBoxMedia/market.php" class="btn btn-default bt"> <i class="fa fa-arrow-left"></i> back</a>
                      <input type="submit" name="upload_item" value="Upload Now" class="btn btn-success bt">
                    </td>
                  </tr>
                </table>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </section>



  <script src="../js/plugins/jquery/jquery.js"></script>

      <script src="../js/custom/main.js"></script>

      <script src="../js/plugins/dist/jquery.min.js"></script>
  <script src="../js/plugins/bootstrap.min.js"></script>
      <script src="../js/custom/dist/custom.min.js"></script>


  </body>
  </html>
