<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>particles.js</title>
  <meta name="description" content="particles.js is a lightweight JavaScript library for creating particles.">
  <meta name="author" content="Vincent Garreau" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" media="screen" href="css/particles/css/style.css">
  <link rel="stylesheet" href="css/plugins/bootstrap.min.css">

  <!-- NProgress -->
  <link href="admin-panel/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="admin-panel/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="admin-panel/vendors/jquery/dist/jquery.min.js"></script>
  <script src="js/plugins/parsleyJS/parsley.min.js"></script>

</head>
<body>

<!-- count particles -->
<!-- <div class="count-particles">
  <span class="js-count-particles">--</span> particles
</div> -->

<!-- particles.js container -->
<div id="particles-js">
  <div class="container">
    <div class="row">
      <div class="col-sm-12" style="position:absolute; width:100%">

        <div class="col-sm-6">
          <form id="sign_in" method="post">
            <div class="col-xs-6">
              <div class="form-group">
                <label for="fitnae">First Name: </label>
                <input type="text" id="fisrtname" name="fitnae" class="form-control" placeholder="Josh" required
                data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup">
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label for="lastname">Last Name: </label>
                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Baye" required
                data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="username">Email: </label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required
                data-parsley-type="email" data-parsley-trigger="keyup">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="username">Choose Username: </label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" required
                data-parsley-length="[3,16]" data-parsley-trigger="keyup">
              </div>
            </div>
            <div class="col-xs-12">
              <label>Gender :</label>
              <p>
                Male : <input type="radio" class="flat" name="gender" id="genderM" value="Male" checked="" required />
                Female : <input type="radio" class="flat" name="gender" id="genderF" value="Female" />
              </p>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="paasword">Password: </label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required
                data-parsley-length="[6,16]" data-parsley-trigger="keyup">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="fisrtname">Confirm Password: </label>
                <input type="password" id="confirm_password" name="verPassword" class="form-control" placeholder="Confirm Password" required
                data-parsley-equalto="#password" data-parsley-trigger="keyup">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <h1 id="message" style="font-size:15px; padding:2px 9px; color:#ff4d4d"></h1>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group pull-right">
                <button type="submit" id="submit" name="submit" class="btn btn-success">Sign up</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-sm-2">

        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <div id="company_logo">
              <a href="index.php"><img src="images/logos/b.png" alt="" width="100%" height="100%"></a>
            </div>
          </div>
        </div>
        <div class="col-sm-1">

        </div>
      </div>
    </div>
  </div>
</div>


<!-- PARSLEY VALIDATION WITH AJAX -->
<script>
  $(document).ready(function(){
    $('#sign_in').parsley();

    $('#sign_in').on('submit', function(event){
      event.preventDefault();
      if ($('#sign_in').parsley().isValid()) {
        $.ajax({
          url: "includes/signup.php",
          method: "POST",
          data:$(this).serialize(),
          beforeSend:function(){
            $('#submit').attr('disabled', 'disabled');
            $('#submit').val('Submitting...');
          },
          success:function(data){
            $('#sign_in')[0].reset();
            $('#sign_in').parsley().reset();
            $('#submit').attr('disabled', false);
            $('#submit').val('submit');

            $('#message').html(data);
          }
        });
      }
    });
  });
</script>



<!-- scripts -->
<!-- <script src="js/plugins/jquery/jquery.js"></script> -->
<script src="js/particles/particles.js"></script>
<script src="js/particles/js/app.js"></script>
<script>
  particlesJS.load('particles-js','js/particles/particles.json', function(){
    console.log('particles.json loading...');
  });
</script>




<!-- Bootstrap -->
<script src="admin-panel/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="admin-panel/vendors/iCheck/icheck.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="admin-panel/build/js/plugins/custom.js"></script>



<!-- stats.js -->
<!-- <script src="js/particles/js/lib/stats.js"></script> -->
<script>
  // var count_particles, stats, update;
  // stats = new Stats;
  // stats.setMode(0);
  // stats.domElement.style.position = 'absolute';
  // stats.domElement.style.left = '0px';
  // stats.domElement.style.top = '0px';
  // document.body.appendChild(stats.domElement);
  // count_particles = document.querySelector('.js-count-particles');
  // update = function() {
  //   stats.begin();
  //   stats.end();
  //   if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
  //     count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
  //   }
  //   requestAnimationFrame(update);
  // };
  // requestAnimationFrame(update);
</script>

</body>
</html>
