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


include ('../includes/database.php');




// DELETE A PRODUCT WITH ITS ID
if (isset($_GET['delete_status'])) {
  $deleteStatus_Id = $_GET['delete_status'];

  $deleteStatus = "DELETE FROM status_post WHERE status_id = '$deleteStatus_Id'";
  $query = mysqli_query($conn, $deleteStatus) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('Status deleted successfully!')</script>";
    echo "<script>window.open('../index.php', '_self')</script>";
  }
}




// DELETE A CATEGORY WITH ITS ID
if (isset($_GET['delete_cat'])) {
  $deleteCategory_Id = $_GET['delete_cat'];

  $deleteCategory = "DELETE FROM categories WHERE cat_Id = '$deleteCategory_Id'";
  $query = mysqli_query($conn, $deleteCategory) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('A Category Has Been Deleted..!')</script>";
    echo "<script>window.open('index.php?view_cat', '_self')</script>";
  }
}





// DELETE A BRAND WITH ITS ID
if (isset($_GET['delete_brand'])) {
  $deleteBrand_Id = $_GET['delete_brand'];

  $deleteBrand = "DELETE FROM brands WHERE brand_Id = '$deleteBrand_Id'";
  $query = mysqli_query($conn, $deleteBrand) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('A Brand Has Been Deleted..!')</script>";
    echo "<script>window.open('index.php?view_brands', '_self')</script>";
  }
}





// DELETE A CUSTOMER WITH THEIR ID
if (isset($_GET['delete_customer'])) {
  $deleteCustomer_Id = $_GET['delete_customer'];

  $deleteCustomer = "DELETE FROM customers WHERE customerId = '$deleteCustomer_Id'";
  $query = mysqli_query($conn, $deleteCustomer) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('This Customer Has Been Deleted..!')</script>";
    echo "<script>window.open('index.php?view_customers', '_self')</script>";
  }
}





// DELETE A AUCTION ITEM WITH ITS ID
if (isset($_GET['deldaf643234gfadete_aucd23437tigdfadon_itrer78665875hgry456rewqrem'])) {

  $deleteAuctionItem_Id = $_GET['deldaf643234gfadete_aucd23437tigdfadon_itrer78665875hgry456rewqrem'];

  $deleteAuctionItem = "DELETE FROM auction_items WHERE auctionItemId = '$deleteAuctionItem_Id'";
  $query = mysqli_query($conn, $deleteAuctionItem) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('An Auction Item Has Been Deleted..!')</script>";
    echo "<script>window.open('index.php?view_customers', '_self')</script>";
  }
}

 ?>
