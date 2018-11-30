<?php

include_once 'database.php';

session_start();

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="veiwport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="css/flexboxgrid.css">-->
  <title>Search Field</title>
  <style media="screen">
    .container-fluid{ margin:auto; overflow-x:hidden; }
    .major-row{ width:100%; overflow-x:hidden; margin:auto; }
    .header{padding:15px 0px 20px 3%; background:url(images/wallpapers/wallpaper7.jpg); background-repeat:
      no-repeat; background-size:cover; background-position:center; text-align:left; }
    .header h1{ color:#fff; font-weight:700; font-size:200%; }

    .search_field{
      width: 100%;
      background: #d0d0d0;
      padding: 10px 0px 10px 2%;
    }
    .search_field input{
      line-height: 35px;
      font-size: 130%;
      width: 80%
    }
    .searchBtn{
      padding: 9px 3px 1px 7px;
      border: none;
    }
    .chatBox{
      height: auto;
      background: #fff;
      padding: 25px;
      margin: 10px auto;
      box-shadow: 0 3px #ccc;
    }
    .chatLog{
      padding: 10px;
      width: 100%;
      height: auto;
      overflow-x: hidden;
      overflow-y: hidden;
    }
    .chat{
      display: flex;
      flex-flow: row wrap;
      align-items: flex-start;
      margin-bottom: 10px;
    }
    .chat .user-photo{
      width: 100px;
      height: 100px;
      background: #ccc;
      border-radius: 50%;
      overflow: hidden;
    }
    .chat .user-photo img{
      width: 100%
    }
    .chat .chat-message{
      width: 70%;
      padding: 15px;
      margin: 20px 10px;
      background: #1ddced;
      border-radius: 10px;
      color: #fff;
      font-size: 20px;
    }
  </style>
</head>

<body>
  <div class="container-fliud">
    <div class="row center-xs center-sm center-md center-lg major-row">

      <div class="row major-row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="header">
              <h1>Search</h1>
            </div>
        </div>
      </div>

      <div class="row major-row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form class="search_field" action="search-result.php" method="POST">
              <input type="search" name="search" placeholder="Search...">
              <button type="submit" name="submit_search" class="searchBtn">
                <img src="images/gadget/search1.png" width="30">
              </button>
            </form>
        </div>
      </div>

      <div class="row major-row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h4>Searches</h4>
          <hr style="height:1px; background: #d0d0d0">
        </div>
      </div>

      <div class="row major-row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="user">

            <div class="chatBox">
              <div class="chatLog">

                <?php
                //SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
//INNER JOIN Customers
//ON Orders.CustomerID=Customers.CustomerID;
                $sql = "SELECT users_account.first_name, users_account.last_name, profile_picture.profilePicture
                FROM users_account INNER JOIN profile_picture ON profile_picture.user_id=users_account.id";

                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                while ($user = mysqli_fetch_array($result)) {
                  echo "<div class='chat friend'>";
                  echo "<div class='user-photo'> <img src='uploaded_images/".$user['profilePicture']."' > </div>";
                  echo "<p class='chat-message'>".$user['first_name']." ".$user['last_name']."</p>";
                  echo "</div>";
                }
                 ?>





                <div class="chat self">
                  <div class="user-photo"><img src="images/localNews/7.jpg"></div>
                  <p class="chat-message">i love coding!</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>


    </div>
  </div>
</body>
</html>
