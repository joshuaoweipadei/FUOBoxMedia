<?php

session_start();

// // Check if user is logged in using the session variable
if (!isset($_SESSION['Id']) && !isset($_SESSION['email'])) {
  header('location: /FUOBoxMedia/index.php');
}else {
  //SESSION VARIABLE DECLARED
  // Makes it easier to read
  $userID = $_SESSION['Id'];
  $email = $_SESSION['email'];

}


 function is_ajax(){
   return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
 }

 if (is_ajax()) {

   include '../database.php';

   if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != '') {

     //Getting File(image) Arrays
     $profileImage_Name = $_FILES['file']['name'];
     $profileImage_TmpName = $_FILES['file']['tmp_name'];
     $profileImage_Size = $_FILES['file']['size'];
     $profileImage_Error = $_FILES['file']['error'];
     $profileImage_Type = $_FILES['file']['type'];

     //Get the Extension of the image
     $ImageExt = explode('.', $profileImage_Name);
     $ImageActualExt = strtolower(end($ImageExt));

     //Give the type of image extention the user can upload                        , 'pdf'
     $allowed = array('jpg', 'jpeg', 'png');

     if (in_array($ImageActualExt, $allowed)) {
       if ($profileImage_Error === 0) {
         if ($profileImage_Size <= 2000000) {
           $profileImage_NameNew = "profilePic".$userID.".".$ImageActualExt;
           //image file directory
           $target = "../uploaded_images/".$profileImage_NameNew;

           if (move_uploaded_file($profileImage_TmpName, $target)) {

             //check if the user has a profile picture or not
             $sql_1 = "SELECT * FROM users_account WHERE Id = '$userID' AND email = '$email'";
             $sql_1Result = mysqli_query($conn, $sql_1) or die(mysqli_error($conn));
             if ($sql_1Result) {
               if (mysqli_num_rows($sql_1Result) == 1) {
                 $sql_2 = "UPDATE users_account SET profile_img = '$profileImage_NameNew' WHERE Id = '$userID'";
                 $query = mysqli_query($conn, $sql_2) or die(mysqli_error($conn));

                 if ($query) {

                   echo "<img src='uploaded_images/".$profileImage_NameNew."' width='100%' height='100%'>";
                 }
               }
             }

           } else {
             echo "1";
           }
         } else {
           echo "2";
         }
       } else {
         echo "3";
       }
     }



     } else {
       header('Location: /FUOBoxMedia/profile_page.php?timline');
     }
   } else {
     header('Location: /FUOBoxMedia/profile_page.php?timline');
   }




  ?>
