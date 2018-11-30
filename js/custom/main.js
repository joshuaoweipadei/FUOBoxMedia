$(document).ready(function(){

  // sending main news - event
  $('.send_news_comment').click(function(event){
  event.preventDefault();
  var unique_id = $(this).attr('id');
  var text = $('#news_comment_'+unique_id).val();
  var user_id = $('#userID').val();
// alert(user_id);
    if (text != " " && text.length > 0) {
      $.ajax({
        url : "/myProject/ajax/news/main_news_event.php",
        method : "POST",
        data : {
          action : "news_comment",
          userID : user_id,
          uniqueid : unique_id,
          news_comment : text,
        },
        success:function(data){
          $('#news_comment_'+unique_id).val(' ');
          $('#news_comm'+unique_id).html(data);
        }
      });
    } else {
      $('#news_comment_'+unique_id).focus();
    }
  });

  // sending main news - likes
  $('.news_like').click(function(event){
  event.preventDefault();
  var like_id = $(this).attr('like');

    $.ajax({
      url : "/myProject/ajax/news/main_news_event.php",
      method : "POST",
      data : {
        action : "news_likes",
        news_id : like_id
      },
      beforeSend:function(){
        $('#lik_'+like_id).attr('diabled', 'disabled');
      },
      success:function(data){
        if (data == 1) {
          $('#heart_'+like_id).css('color', '#ff0000');
        } else {
          $('#heart_'+like_id).css('color', '#666666');
        }

      }
    });

  });

});
