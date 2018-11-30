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
    jQuery.post("/FUOBoxMedia/ajax/status-insert.php",{
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
          console.log("ResponseText: " + data);

        });
        console.log("ResponseText: " + _status +" "+ _userId +" "+ _userEmail);

        // HOW TO IMAGES WITH THE STATUS
        // I HAVE BEEN TRY HARD SINCE

        // var input = document.getElementById('fileUpload'),
        // formdata = false;
        //
        // if (window.FormData) {
        //   formdata = new FormData();
        //   document.getElementById("bbtn").style.display = "none";
        //   // document.getElementById("bbtn").innerHTML = "none";
        // }
        // input.addEventListener("change", function (evt){
        //   // document.getElementById("response").innerHTML = "Uploading . . .";
        //   var i = 0, len = this.files.length, img, reader, file;
        //
        //   for ( ; i < len; i++) {
        //     file = this.files[i];
        //
        //     if (!!file.type.match(/image.*/)) {
        //       if (formdata) {
        //         formdata.append("images[]", file);
        //       }
        //     }
        //   }
        //
        //   if (formdata && input) {
        //     $.ajax({
        //       url : "/FUOBoxMedia/ajax/add_comment.php",
        //       type : "POST",
        //       data : formdata,
        //       processData : false,
        //       contentType : false,
        //       success : function (res) {
        //         document.getElementById("image-holder").innerHTML = res;
        //       }
        //     });
        //   }
        // }, false);


  } else {
    //The textarea is empty
    //Remove the text from the textarea, ready for another comment!
    //Possibly...
    $('.comment-insert-text').css('border' , '1px solid #ff0000');
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
          url : "/FUOBoxMedia/ajax/add_comment.php",
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
      c += '<img src="uploaded_images/'+data.user_img+'"/>';
        c += '<p class="comment-head">';
          c += '<a href="friends/friend_profile.php?friend_id='+data.user_id+'">'+data.user_first+' '+data.user_last+'</a> <span class="text-muted">@'+data.user_name+'</span>';
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
          url : "/FUOBoxMedia/ajax/delete_comment.php",
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
  $('.comment-holder').each(function(){
    var send = this;
    var comment_id = send.id;
        $.ajax({
          url : "/FUOBoxMedia/ajax/add_comment.php",
          method : "POST",
          data : {
            count : "count_comment",
            count_Id : comment_id,
          },
          success:function(data){
            $('#comment_count_' + comment_id).html(data);
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
  $.post("/FUOBoxMedia/ajax/status-delete.php",
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
  t += '<div class="date">';
    t += '<span class="pull-right">Just Now</span>';
    t += '<span class="pull-left"> Public <i class="fa fa-globe"></i></span>';
  t += '</div>';
  t += '<div style="clear:both; margin-bottom:5px"></div>';
    //user image
    t += '<div class="user-img">';
    t += '<a href="#" style="text-decoration:none"><img src="uploaded_images/'+data.user.profile_img+'" class="user-img-pic" alt="upload picture"></a>';
    t += '</div>';
  //comment body
  t += '<div class="comment-body">';
  t += '<h3 class="username-field"><a href="#" style="text-decoration:none">'+data.user.username+'</a><span style="font-size:14px"> added article</span></h3>';
  t += '<div class="comment-text">'+data.status.status+'</div>';
  t += '</div>';

  //comment footer
  t += '<div class="timeline-footer">';
    t += '<div class="pull-right">';
      t += '<a href="#"><span class="fa fa-comment"></span> 35</a>';
      t += '<a href="#"><span class="fa fa-share"></span></a>';
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
