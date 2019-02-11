//COMMENT INSERT JAVASCRIPT CODES
//This will fire up when the page is fully loaded
$( document ).ready(function(){

  //COMMENT BUTTON FUNCTION
  $('#comment-post-btn').click(function(){

    //call this function when the status/post button is clicked
    comment_post_btn_click();

  });

  //call this function when the delete button is clicked
  add_delete_handlers();

  // CALLING FUUCTION TO ADD COMMENTS TO STATUS POST WHEN PAGE IS FULLY LOADED
  add_comment();

  // delting comments
  delete_comment();

  // CMMENT COUNT
  comment_count();

});



// //status/post functionsw
function comment_post_btn_click(){
  //Text within textarea which the person has entered
  var _status = $('#comment-post-text').val();
  var _userId = $('#userID').val();
  var _userEmail = $('#userEmail').val();


  if (_status.length > 2 && _userEmail != null && _userId != null) {
    //The textarea is not empty
    $('.comment-insert-text').css('border' , '1px solid #4d4d4d');
      console.log(_status + " Username: " + _userEmail + " User ID: " + _userId);

    //PROCESS WITH AJAX CALLBACK
    //PASSING TO THE SERVER USING AJAX(to the PHP Script)
    jQuery.post("/welcome/ajax/status-insert.php",{
      task: "status_insert",
      status: _status,
      userId: _userId,
      userEmail: _userEmail,
    }).fail(
      function(){
        console.log("Error: ");
      }).done(
        function(data) {
          //SUCCESS
          //Task: insert html into the ul/li
          status_insert(jQuery.parseJSON(data));
          // console.log("ResponseText: " + data);

          setInterval(function(){
            window.location.reload();
          }, 4000);

        });
        console.log("ResponseText: " + _status +" "+ _userId +" "+ _userEmail);

  } else {
    //The textarea is empty
    //Remove the text from the textarea, ready for another comment!
    //Possibly...
    $('.comment-insert-text').css('border' , '1px solid #ff9999');
    console.log("The text field is empty");
  }
  //Remove the text from the textarea, ready for another comment!
  //Possibly...
  $('#comment-post-text').val("");
}



//ADD COMMENTS function
function add_comment(){
  $('.send_comment').each(function(){
    var send = this;
    var comment_id = send.id;
    $(send).click(function(){

      var _comment = $('#comment_' + comment_id).val();
      var _userId = $('#userID').val();
      var _userEmail = $('#userEmail').val();

      if (_comment != null && _comment.length > 0) {
        $.ajax({
          url : "/welcome/ajax/add_comment.php",
          method : "POST",
          data : {
            task : "adding_comment",
            commentId : comment_id,
            comment : _comment,
            userId : _userId,
            userEmail : _userEmail
          },
          success:function(data){
            $('#comment_' + comment_id).val("");
            comment(jQuery.parseJSON(data));
          }
        });

      } else {
        $('#comment_' + send.id).focus();
      }
    });
  });
}
//COMMENT insert function to populate the field
function comment(data){

    var c = '';
    //comment reply
    c += '<div class="comment-cont">';
      c += '<img src="images/uploaded_images/profile_photos/'+data.user_img+'"/>';
        c += '<p class="comment-head">';
          c += '<a href="friends/friend_profile.php?friend_id='+data.user_id+'">'+data.user_first+' '+data.user_last+'</a> <span class="text-muted" style="font-size:11px">@'+data.user_name+'</span>';
        c += '</p>';
        c += '<p>'+data.comment+'</p>';
          c += '<small class="text-muted">Just Now</small>';
    c += '</div>';

    $('#adding_comment_'+data.commentId).prepend(c);

}






// DELETING A COMMENTS IN A PARTICULAR STATUS
  function delete_comment() {
    $('.delete_comment').each(function(){
      var del = this;
      var comment_id = del.id;
      $(del).click(function(){
        var _status_id = $('#statusId').val();
        var _userId = $('#commented_userID').val();
        // alert(comment_id);
        $.ajax({
          url : "/welcome/ajax/delete_comment.php",
          method : "POST",
          data : {
            action : "delete_comment",
            StatusId : _status_id,
            CommentId : comment_id,
            userId : _userId
          },
          success:function(data){
            $('#del_'+comment_id).detach();
          }
        });
      });
    });
  }







// //FETCH COMMENTS FUNCTION
// function comment_reply(){
//   $('.comment-holder').each(function(){
//     var send = this;
//     var comment_id = send.id;
//         $.ajax({
//           url : "/FUOBoxMedia/ajax/add_comment.php",
//           method : "POST",
//           data : {
//             task : "fetch_comment",
//             Id : comment_id,
//           },
//           success:function(data){
//             $('#adding_comment_' + comment_id).html(data);
//           }
//         });
//   });
// }





//COUNT COMMENTS FUNCTION
function comment_count(){
  $('.status-id').each(function(){
    var send = this;
    var comment_id = send.id;
        $.ajax({
          url : "/welcome/ajax/add_comment.php",
          method : "POST",
          data : {
            count : "count_comment",
            count_Id : comment_id,
          },
          success:function(data){
            if (data == 0) {
              $('#comment_count_'+comment_id).html("<span style='font-size:10px; color:#c1c1c1'>Be the first to comment on this.</span>");
            }else {
              $('#comment_count_'+comment_id).html(data+"<a href='single_status_timeline.php?status-post-id="+comment_id+"'> More Comment(s)</a>");
            }
          }
        });
  });
}






//delete HANDLER function
function add_delete_handlers(){
  $('.delete-btn').each(function() {
    var btn = this;
    $(btn).click(function(){

      status_delete(btn.id);

    });
  });
}





//delete STATUS function
function status_delete(_status_id){
  $.post("/welcome/ajax/status-delete.php",
    {
      task : "status_delete",
      status_id : _status_id,
    }).done(function(data){
      $('#del_status_' + _status_id).detach();
    });
}






//status insert function to populate the field
function status_insert(data){

  var t = '';

  t += '<li class="comment-holder timeline-item" id="'+data.status.status_id+'">';

  t += '<div class="container-area" style="padding-bottom:10px; padding-top:10px">';
    //user image
    t += '<div class="user-img">';
      t += '<a href="#" style="text-decoration:none"><img src="images/uploaded_images/profile_photos/'+data.user.profile_img+'" class="user-img-pic" alt="upload picture"></a>';
    t += '</div>';
  //comment body
    t += '<div class="comment-body" style="padding-bottom: 10px; border-bottom:1px solid rgba(93,84,240,8.5)">';
      t += '<h3 class="username-field"><a href="#" style="text-decoration:none">'+data.user.first_name+' '+data.user.last_name+'</a></h3>';

    t += '<div class="comment-text">';
      t += '<p>'+data.status.status+'</p>';
    t += '</div>';

    t += '<div class="date">';
      t += '<span> <i class="fa fa-globe"></i> | </span>';
      t += '<span class="everyone">Everyone <i class="fa fa-eye"></i> </span>';
      t += '<span class="pull-right" style="color:#595959"> Just Now </span>';
    t += '</div>';

    t += '</div>';
  t += '</div>';

  t += '<div class="comment-button-holder">';
  t += '<ul>';
  t += '<li id="'+data.status.status_id+'" class="delete-btn"><i class="fa fa-trash"></i></li>';
  t += '</ul>';
  t += '</div>';
  t += '</li>';

  $('.comments-holder-ul').prepend(t);
  add_delete_handlers();
}
