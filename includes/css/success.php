
<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="veiwport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../bootstrap-4.0.0/css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="css/flexboxgrid.css">-->
  <title>Reset Your Password</title>
  <style media="screen">
    .container-fluid{ margin:auto; overflow-x:hidden; }
    .major-row{ width:100%; overflow-x:hidden; margin:auto; }
    .header{ margin:25px 0px 55px 0px; padding:20px 0px; background-color:green; text-align:center; }
    .header h1{ color:#fff; font-weight:700; font-size:200%; }
    .message p{font-size:130%; text-align:center;}
  </style>
</head>

<body>
  <div class="container-fliud">
    <div class="row center-xs center-sm center-md center-lg major-row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="header">
            <h1>Success</h1>
          </div>
          <div class="message">
            <p><?php echo "Your password has been reset successfully!"; ?></p>
          </div>
      </div>
    </div>
  </div>
</body>
</html>
