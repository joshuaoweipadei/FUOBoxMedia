<?php

include ('includes/database.php');

// GETTING THE TOTAL NUMBER OF USERS
function totalUsers(){
  global $conn;

  $sql = "SELECT * FROM users_account";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    echo mysqli_num_rows($query);
  }
}
// GETTING THE TOTAL average NUMBER OF USERS PER WEEK
function Average_totalUsers(){
  global $conn;

  $sql = "SELECT * FROM users_account";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    $count = mysqli_num_rows($query);
    echo $count*7/100;
  }
}


// GETTING THE TOTAL NUMBER OF MALE USERS
function totalMaleUsers(){
  global $conn;

  $sql = "SELECT * FROM users_account WHERE gender = 'Male'";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    echo mysqli_num_rows($query);
  }
}
// GETTING THE TOTAL average NUMBER OF USERS PER WEEK
function Average_totalMaleUsers(){
  global $conn;

  $sql = "SELECT * FROM users_account WHERE gender = 'Male'";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    $count = mysqli_num_rows($query);
    echo $count*7/100;
  }
}



// GETTING THE TOTAL NUMBER OF FEMALE USERS
function totalFemaleUsers(){
  global $conn;

  $sql = "SELECT * FROM users_account WHERE gender = 'Female'";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    echo mysqli_num_rows($query);
  }
}
// GETTING THE TOTAL average NUMBER OF USERS PER WEEK
function Average_totalFemaleUsers(){
  global $conn;

  $sql = "SELECT * FROM users_account WHERE gender = 'Female'";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    $count = mysqli_num_rows($query);
    echo $count*7/100;
  }
}



// GETTING THE TOTAL NUMBER OF ONLINE USERS
function onlineUsers(){
  global $conn;

  $sql = "SELECT * FROM users_account WHERE active = 1";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    echo mysqli_num_rows($query);
  }
}
// GETTING THE TOTAL average NUMBER OF USERS PER WEEK
function Average_onlineUsers(){
  global $conn;

  $sql = "SELECT * FROM users_account WHERE active = 1";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    $count = mysqli_num_rows($query);
    echo $count*7/100;
  }
}



// GETTING THE TOTAL NUMBER OF OFFLINE USERS
function offlineUsers(){
  global $conn;

  $sql = "SELECT * FROM users_account WHERE active = 0";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    echo mysqli_num_rows($query);
  }
}
// GETTING THE TOTAL average NUMBER OF USERS PER WEEK
function Average_offlineUsers(){
  global $conn;

  $sql = "SELECT * FROM users_account WHERE active = 0";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    $count = mysqli_num_rows($query);
    echo $count*7/100;
  }
}



// GETTING THE TOTAL NUMBER OF OFFLINE USERS
function totalStatus(){
  global $conn;

  $sql = "SELECT * FROM status_post";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    echo mysqli_num_rows($query);
  }
}

// GETTING THE TOTAL NUMBER OF OFFLINE USERS
function totalComments(){
  global $conn;

  $sql = "SELECT * FROM comments";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if ($query) {
    echo mysqli_num_rows($query);
  }
}

 ?>
