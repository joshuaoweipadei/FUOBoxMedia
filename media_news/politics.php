<?php

if (!isset($_SESSION['Id'])) {
  header('location: ../index.php');
};

 ?>
<div class="tab">
  <div class="tab-content">
    <div class="localNews">
      <h4>About Politics</h4>
        <div class="col-xs-6">
          <img src="images/education/image3.jpg" alt="" width="100%">
        </div>
        <div class="col-xs-6">
          <img src="images/education/image3.jpg" alt="" width="100%">
        </div>
      <div class="news">
        <p>nbrbfjkbsdkjfksdfkjsdkjfbdskjfbkjsdb fjkdbskjfbsdkjfbkjsdfbks djsddddddddddddddd</p>
        <p>nbrbfjkbsdkjfksdfkjsdkjfbdskjfbkjsdbfjkdbskjfbsdkj,njhghcgsdsss nbjkjkbjh h uu u u ufbkjsdfbksdj</p>
        <ul class="nav navbar-nav collapse navbar-collapse pull-left">
          <li class="pull-right"><a><i class="fa fa-star-half-full "></i><i class="fa fa-star-half-full "></i><i class="fa fa-star-half-full "></i> Rate Us</a></li>
        </ul>
        <ul class="nav navbar-nav collapse navbar-collapse pull-right">
          <li><a><i class="fa fa-globe"></i> Public</a></li>
          <li><a><i class="fa fa-share-square-o"></i> Share</a></li>
          <li><a id="compose"><i class="fa fa-comments"></i> Comments</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
