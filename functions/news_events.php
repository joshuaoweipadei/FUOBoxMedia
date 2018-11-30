<?php

function trendingNews($full = false){
  global $conn;

  $SQL = "SELECT * FROM news ORDER BY Id DESC LIMIT 1";
  $QUERY = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
  if ($QUERY) {
    $row = mysqli_fetch_array($QUERY);
    $newsTitle = $row['news_title'];

      $sql = "SELECT * FROM news WHERE news_title = '$newsTitle' ORDER BY RAND() LIMIT 3";
      $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
      if ($query) {
        if ($_row = mysqli_fetch_array($query)) {
          $news_id = $_row['unique_no'];
          echo '<div class="localNews">
                  <h3 class="header"><i class="fa fa-language" style="color:#00004d"></i> Trending news & events</h4>
                  ';
              while ($row = mysqli_fetch_array($query)) {
              echo '<div class="col-xs-6">
                      <div class="news_img_box">
                        <img src="/myProject/admin-panel/uploaded_images/'.$row['news_img'].'" alt="" width="100%">
                      </div>
                    </div>';
              }
                echo '<div class="news">
                        <h4><a href="news_details.php?news_id='.$_row['unique_no'].'">'.$_row['news_title'].'</a></h4>
                        <div style="padding-bottom:0px; border-bottom:1px solid #e1e1e1">
                          <p>'.$_row['news_desc'].'</p>
                        </div>';

                    echo '<div class="views_likes_comments">';
                            if (isset($_SESSION['Id'])) {
                              $sql5 = "SELECT * FROM news_comments WHERE unique_no = '$news_id'";
                              $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
                              if ($query5) {
                                $news_comment_count = mysqli_num_rows($query5);
                                echo '<div class="pull-right" style="margin-right:1%; font-size:16px">
                                        <button id="compose" class="single_news_comment">'.$news_comment_count.' <i class="fa fa-comments-o" style="font-size:22px"></i> Comments</button>
                                      </div>
                                      ';
                              }
                            } else {
                              $sql5 = "SELECT * FROM news_comments WHERE unique_no = '$news_id'";
                              $query5 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
                              if ($query5) {
                                $news_comment_count = mysqli_num_rows($query5);
                                echo '<div class="pull-right" style="margin-right:1%; font-size:16px">
                                        <button class="single_news_comment">'.$news_comment_count.' <i class="fa fa-comments-o" style="font-size:22px"></i> Comments</button>
                                      </div>
                                      ';
                              }
                            }
                            // getting the IP Address of visiting users
                            function getIp() {
                              $ip = $_SERVER['REMOTE_ADDR'];

                              if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                $ip = $_SERVER['HTTP_CLIENT_IP'];
                              } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                              }

                              return $ip;
                            }
                            $ip_address = getIp();

                            $news_id = $_row['unique_no'];    // the news id
                            // checking if the ip address is on he database
                            $sql4 = "SELECT * FROM news_likes WHERE news_unique_no = '$news_id' AND ip_address = '$ip_address'";
                            $query4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
                            if ($query4) {
                              if (mysqli_num_rows($query4) == 1) {
                                $news_likes_count = mysqli_num_rows($query4);
                                echo '<div class="pull-right" style="margin-right:1%; font-size:14px">
                                        <button id="lik_'.$_row['unique_no'].'" like="'.$_row['unique_no'].'" class="single_news_comment news_like">
                                        <span id="news_likes_'.$_row['unique_no'].'" style="color:#00004d">'.$news_likes_count.'</span>
                                          <i class="fa fa-heart-o" style="color:#ff0000; font-size:22px" id="heart_'.$_row['unique_no'].'"></i>
                                        </button>
                                      </div>';
                              } else {
                                $news_likes_count = mysqli_num_rows($query4);
                                echo '<div class="pull-right" style="margin-right:1%">
                                        <button id="lik_'.$_row['unique_no'].'" like="'.$_row['unique_no'].'" class="single_news_comment news_like">
                                          <span id="news_likes_'.$_row['unique_no'].'">'.$news_likes_count.'</span>
                                            <i class="fa fa-heart-o" style="color:#666666; font-size:22px" id="heart_'.$_row['unique_no'].'"></i>
                                        </button>
                                      </div>';
                              }
                            }


                    echo' </div>
                          <div class="clearfix"></div>
                          <h5 style="font-family:cursive; color:rgba(93,84,240,0.5);">Comments - </h5>';

                echo '<!-- compose -->
                        <div class="compose col-md-6 col-xs-12">
                          <div class="compose-header">
                            Leave a comment
                            <button type="button" class="close compose-close">
                              <span style="color:#fff">x</span>
                            </button>
                          </div>
                          <!--reply comment-->
                          <div class="compose-body">
                          <h5>Be the first to comment on the news</h5>
                            <textarea id="news_comment_'.$_row['unique_no'].'" comment_text="'.$_row['unique_no'].'" name="name" class="form-control"  rows="1"></textarea>
                          </div>
                          <!-- send button -->
                          <div class="compose-footer pull-right">
                            <button id="'.$_row['unique_no'].'" class="btn btn-sm btn-success send_news_comment" type="button">Send</button>
                          </div>
                        </div>
                      <!-- /compose -->

                      <div class="clearfix"></div>

                      <div class="">
                        <div class="">
                          <!-- returning data from ajax -->
                          <div id="news_comm'.$_row['unique_no'].'"></div>';

                          $sql2 = "SELECT * FROM news_comments WHERE unique_no = '$news_id' ORDER BY Id DESC LIMIT 3";
                          $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                          if ($query2) {
                            while ($news_comm = mysqli_fetch_array($query2)) {
                              $Id = $news_comm['userId'];

                              $sql3 = "SELECT * FROM users_account WHERE Id = '$Id'";
                              $query3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
                              if ($query3) {
                                if ($user = mysqli_fetch_array($query3)) {
                                  $dateTime = strtotime($news_comm['time']);

                                    $date = date('d', $dateTime);
                                    $month = date('m', $dateTime);
                                    $year = date('y', $dateTime);
                                    $time = date('H:i A', $dateTime);

                                    switch ($month) {
                                        case "1":
                                            $CurrentMonth = "Jan";
                                            break;
                                        case "2":
                                            $CurrentMonth = "Feb";
                                            break;
                                        case "3":
                                            $CurrentMonth = "Mar";
                                            break;
                                        case "4":
                                            $CurrentMonth = "Apr";
                                            break;
                                        case "5":
                                            $CurrentMonth = "May";
                                            break;
                                        case "6":
                                            $CurrentMonth = "Jun";
                                            break;
                                        case "7":
                                            $CurrentMonth = "Jul";
                                            break;
                                        case "8":
                                            $CurrentMonth = "Aug";
                                            break;
                                        case "9":
                                            $CurrentMonth = "Sep";
                                            break;
                                        case "10":
                                            $CurrentMonth = "Oct";
                                            break;
                                        case "12":
                                            $CurrentMonth = "Nov";
                                            break;
                                        default:
                                            $CurrentMonth = "Dec";
                                    }
                                  echo '<li class="comment_comment_box">
                                          <div class="content">
                                            <div class="title">'.$news_comm['comment'].'</div>
                                            <a href="friends/friend_profile.php?friend_id='.$user['Id'].'" style="padding-left:4%">
                                              <span class="username">@'.$user['username'].' - </span>
                                              <span class="datetime">'.$date.' '.$CurrentMonth.' '.$year.' by '.$time.'</span>
                                            </a>
                                          </div>
                                        </li>';
                                }
                              }
                            }
                          }

                        echo '

                            </div>
                          </div>
                  </div>
              </div>';
            }
          }
        }
      }


 ?>
