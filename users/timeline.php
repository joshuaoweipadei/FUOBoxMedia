<?php

if (!isset($_SESSION['Id'])) {
  header('location: ../profile_page.php');
};
 ?>
<div class="w3-row-padding">
  <div class="">
    <div class="w3-card">
      <div class="w3-container w3-padding">
        <h4 class="w3-opacity who-says">Status</h4>
        <p class="w3-padding">
          <!-- <input id="fileUpload" type="file" name="images[]" multiple accept="image/x-png, image/gif, image/jpeg, image/jpg"> -->
          <textarea contenteditable="false" id="comment-post-text" class="comment-insert-text" placeholder="Write something"></textarea>
          <br>
          <button type="button" id="comment-post-btn" class="btn pull-right">Post</button>
          <div class="clearfix"></div>

          <input type="hidden" id="userID" value="<?php echo $userID ?>">
          <input type="hidden" id="userEmail" value="<?php echo $email ?>">
          <!-- FORM TO UPLOAD IMAGES WITH STATUS -->
          <!-- <form method="post" action="" id="wrapper" enctype="multipart/form-data">
            <button type="submit" id="bbtn">upload</button>
            <button type="reset" name="button">reset</button>
            <input id="fileUpload" type="file" name="images" multiple accept="image/x-png, image/gif, image/jpeg, image/jpg">
            <br>
            <div id="image-holder"></div>
            <div id="response">uuigiu</div>
            <div id="image-list"></div>
          </form> -->

        </p>
      </div>
    </div>
  </div>
</div>

<!-- <h3 class="">NEWS FEEDS</h3>
<div class="comment-insert">
  <h3 class="who-says"><strong>Says:</strong> Joshua</h3>
  <!--COMMENT AREA-->
  <!-- <div class="comment-insert-container">
    <div class="col-md-10"> -->
      <!-- <textarea id="comment-post-text" class="comment-insert-text"></textarea> -->
      <!-- <div class="add_photo">
        <i class="fa fa-picture-o" style="font-size:17px"></i> Add Photos
      </div>
    </div>
    <!--COMMENT POST BUTTON-->
    <!-- <div class="col-md-2">
      <div id="comment-post-btn" class="comment-post-btn-wrapper"><i class="fa fa-share" style="font-size:12px"></i> Status</div>
    </div>
  </div>
</div> -->

<div class="comments-list">
  <!--COMMENT BOX-->
  <ul class="comments-holder-ul">
    <!--COMMENTS LIST-->
    <?php
    include_once 'database.php';
    include 'ajax/status.php';
    ?>
    <?php $statuss = Status::getStatus( ); ?>
    <?php require_once 'status-box.php'; ?>
  </ul>
</div>
