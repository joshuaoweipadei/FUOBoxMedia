<?php include('c_server.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="veiwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="css/flexboxgrid.css">-->
    <link rel="stylesheet" href="css/style_profile.css">
    <script type="text/javascript" src="js/user_scriptsheet.js"></script>
    <!--Add JQuery-->

    <title>Comment/post</title>
</head>
<body>
  <div class="wrapper">
    <?php echo $comments; ?>
    <form class="comment_form">
      <div class="">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
      </div>
      <div class="">
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" rows="5" cols="30"></textarea>
      </div>
      <button type="button" id="submit_btn">POST</button>
      <button type="button" id="update_btn" style="display:none;">UPDATE</button>
    </form>
  </div>


</body>
</html>

<script src="js/jquery-3.3.1.js"></script>
