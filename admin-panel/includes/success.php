<?php
session_start();

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="img/fav.png">
		<meta name="author" content="codepixer">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta charset="UTF-8">
    <title>Account Activation Successful</title>
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h5 style="color:green; padding-top:40px" class="text-center"><?php if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
          } ?></h5>

          <div class="text-center">
            <a href="../login.php" class="btn btn-primary"> Home</a>
          </div>
        </div>

      </div>
    </div>
  </body>
</html>
