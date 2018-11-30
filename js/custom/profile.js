// FOR UPLOADING PROFILE IMAGES
$(".Avatar").click(function(){
  $("#newAvatar").trigger("click");
  $("#change_pic").html("Selected a Picture");
});





//
// $("#fileUpload").on('change', function(){
//   var countFiles =$(this)[0].files.length;
//
//   var imgPath = $(this)[0].value;
//   var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
//   var image_holder = $("#image-holder");
//   image_holder.empty();
//
//   if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
//     if (typeof (FileReader) != "undefined") {
//
//       for (var i = 0; i < countFiles; i++) {
//         var reader = new FileReader();
//
//         if (countFiles < 3) {
//           reader.onload = function (e) {
//             $("<img />", {
//               "src": e.target.result,
//               "class": "thumb-image"
//             }).appendTo(image_holder);
//           }
//
//           $(".de").click(function (){
//             $.ajax({
//               url : "/myProject/ajax/add_comment.php",
//               method : "POST",
//               data : {
//                 task : "image",
//                 img : imgPath
//               },
//               success:function(data){
//                 console.log(" Username: ");
//               }
//             });
//           });
//
//
//
//         } else {
//           alert("life");
//         }
//
//         image_holder.show();
//         reader.readAsDataURL($(this)[0].files[i]);
//       }
//
//     } else {
//       alert("This browser does not support FileReader.");
//     }
//   } else {
//     alert("Please select onlt images");
//   }
// });




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
        url : "/myProject/users/change_pro_img.php",
        method : "POST",
        data : form_data,
        contentType : false,
        cache : false,
        processData : false,
        success:function(data){
          $('.img_container').html(data);
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
        url : "/myProject/ajax/friends/friend_request.php",
        method : "POST",
        data : {
          action : "send_friend",
          userID : user_id,
          friend : friend_id,
        },
        beforeSend:function(){
          $('.request').attr('disabled', 'disabled');
          $('.request').html('<img src"/myProject/images/advert/crate.gif">');
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
      url : "/myProject/ajax/friends/accept_friend_request.php",
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
      }
    });
  });



  // deleting friend request
  $('.delete_request').click(function(event){
    event.preventDefault();
    var delete_friend_id = $(this).attr('delete');
    var user_id = $('#userID').val();

    $.ajax({
      url : "/myProject/ajax/friends/delete_friend_request.php",
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
      }
    });
  });



  // send personal message
  $('.sending_msg').click(function(event){
    event.preventDefault();
    var msg_friend_id = $(this).attr('id');
    var user_id = $('#userID_msg').val();
    var message = $('#text_msg_'+msg_friend_id).val();

    if (message != null && message.length > 1) {
      $.ajax({
        url : "/myProject/ajax/message/personal_msg.php",
        method : "POST",
        data : {
          action : "send_message",
          userID : user_id,
          friend_id : msg_friend_id,
          msg : message,
        },
        beforeSend:function(){
          $('#sending_msg').attr('disabled', 'disabled');
          $('#sending_msg').html('Sending');
          $('#text_msg_'+msg_friend_id).val('');
        },
        success:function(data){
          $('#text_msg_'+msg_friend_id).val('');
          setInterval(function(){
            $('#sender_'+user_id).html(data);
          }, 1000);
        }
      });

    } else {
      $('.msg_area').css('border' , '1px solid #8c8c8c');
      $('.msg_area').focus();
      $('#text_msg_'+msg_friend_id).val('');
    }
  });



  // LIKES AND UNLIKES
  $('.like').click(function(event){
    event.preventDefault();
    var status_id = $(this).attr('id');
    var likes_value = $(this).attr('value');
    var user_id = $('#userID').val();

    $.ajax({
      url : "/myProject/ajax/likes/likes_unlikes.php",
      method : "POST",
      data : {
        action : "likes_unlikes",
        userId : user_id,
        statusId : status_id,
        value : likes_value
      },
      success:function(data){
        setInterval(function(){
          $('#like_'+status_id).html(data);
        }, 1000);
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
          url : "/myProject/ajax/news/quote.php",
          method : "POST",
          data : {
            action : "daily_quote",
            quote : text,
            userId : user_id,
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
      url : "/myProject/ajax/news/quote.php",
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
