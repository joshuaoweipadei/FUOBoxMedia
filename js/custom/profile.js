// FOR UPLOADING PROFILE IMAGES
$(".Avatar").click(function(){
  $("#newAvatar").trigger("click");
  $("#change_pic").html("Selected a Picture");
});





$(document).ready(function(){

  // UPLOAD OR CHANGE PROFILE $ImagE
  $(document).on('change', '#newAvatar', function(){
    var name = document.getElementById("newAvatar").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1){
      alert("Invalid Images Type");
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("newAvatar").files[0]);
    var f = document.getElementById("newAvatar").files[0];
    var fsize = f.size||f.fileSize;
    if (fsize > 2000000) {
      alert("Image File Size is very big");
    } else {
      form_data.append("file", document.getElementById('newAvatar').files[0]);
      $.ajax({
        url : "/welcome/user/change_pro_img.php",
        method : "POST",
        data : form_data,
        contentType : false,
        cache : false,
        processData : false,
        success:function(data){
          $('.upload_pic').css('background', '#00cc00');
          setInterval(function(){
            $('.upload_pic').css('background', '#008000');
          }, 1000);
          // the time it takes for the profile picture to change and reloading the page
          setInterval(function(){
            window.location.reload();
          }, 2000);
        }
      });
    }
  });



  // SENDING friend REQUEST
  $('.request').click(function(event){
    event.preventDefault();
    var friend_id = $(this).attr('id');
    var user_id = $('#userID').val();

      $.ajax({
        url : "/welcome/ajax/friends/friend_request.php",
        method : "POST",
        data : {
          action : "send_friend",
          userID : user_id,
          friend : friend_id,
        },
        beforeSend:function(){
          $('.request').attr('disabled', 'disabled');
          $('.request').html('<div class="loader"></div>');
        },
        success:function(data){
          setInterval(function(){
          $('.request').html(data);
        }, 1000);
        }
      });
  });



  // accepting friend request
  $('.accept_request').click(function(event){
    event.preventDefault();
    var accept_friend_id = $(this).attr('accept');
    var user_id = $('#userID').val();

    $.ajax({
      url : "/welcome/ajax/friends/accept_friend_request.php",
      method : "POST",
      data : {
        action : "accept_request",
        userID : user_id,
        friend_id : accept_friend_id,
      },
      beforeSend:function(){
        $('#accept_'+accept_friend_id).attr('disabled', 'disabled');
        $('#delete_'+accept_friend_id).attr('disabled', 'disabled');
        $('#accept_'+accept_friend_id).html('Accepting...');
      },
      success:function(data){
        $('#accept_'+accept_friend_id).attr('disabled', 'disabled');
        $('#delete_'+accept_friend_id).hide();
        $('#accept_'+accept_friend_id).html(data);
        setInterval(function(){
          location.reload();
        }, 3000);
      }
    });
  });



  // deleting friend request
  $('.delete_request').click(function(event){
    event.preventDefault();
    var delete_friend_id = $(this).attr('delete');
    var user_id = $('#userID').val();

    $.ajax({
      url : "/welcome/ajax/friends/delete_friend_request.php",
      method : "POST",
      data : {
        action : "delete_request",
        userID : user_id,
        friend_id : delete_friend_id,
      },
      beforeSend:function(){
        $('#accept_'+delete_friend_id).attr('disabled', 'disabled');
        $('#delete_'+delete_friend_id).attr('disabled', 'disabled');
        $('#delete_'+delete_friend_id).html('Deleting...');
      },
      success:function(data){
        $('#delete_'+delete_friend_id).attr('disabled', 'disabled');
        $('#accept_'+delete_friend_id).hide();
        $('#delete_'+delete_friend_id).html(data);
        setInterval(function(){
          location.reload();
        }, 3000);
      }
    });
  });





  // daily quote line
  $('.quote').click(function(event){
    event.preventDefault();
    var text = $('.quote_text').val();
    if (text == "") {
      $('.quote_text').focus();
    } else {
      if (text.length > 2) {
        var user_id = $('#userID').val();

        $.ajax({
          url : "/welcome/ajax/news/quote.php",
          method : "POST",
          data : {
            action : "daily_quote",
            quote : text,
            userId : user_id,
          },
          beforeSend:function(){
            $('.quote_msg').html("Updating...")
          },
          success:function(data){
            $('.quote_msg').html(data);
          }
        });

      } else {
        $('.err').html("Textarea is empty (3 minimum)");
        $('.err').css("color", "red");
        $('.quote_text').focus();
      }
    }
  });



  // delete daily quote
  $('.delete_quote').click(function(event){
    event.preventDefault();
    var user_id = $('#userID').val();

    $.ajax({
      url : "/welcome/ajax/news/quote.php",
      method : "POST",
      data : {
        action : "delete_quote",
        userId : user_id,
      },
      success:function(data){
        $('.quote_msg').html(data);
        setInterval(function(){
          location.reload();
        }, 2000);
      }
    });
  });



}); //end
