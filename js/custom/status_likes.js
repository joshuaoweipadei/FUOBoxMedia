$(document).ready(function(){

  // LIKES AND UNLIKES
  // status likes and unlikes
  $('.like').click(function(event){
    event.preventDefault();
    var status_id = $(this).attr('id');
    var likes_value = $(this).attr('value');
    var user_id = $('#userID').val();

    $.ajax({
      url : "/welcome/ajax/likes/likes_unlikes.php",
      method : "POST",
      data : {
        action : "likes_unlikes",
        userId : user_id,
        statusId : status_id,
        value : likes_value
      },
      success:function(data){
        $('#'+likes_value+'_'+status_id).html(data);
      }
    });
  });



}); //end
