/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
    document.getElementById("mySidenav").style.width = "210px";
    document.getElementById("main").style.marginLeft = "210px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}
/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    document.body.style.backgroundColor = "white";
}
// // // Get the modal
// var modal = document.getElementById('myModal');
// // Get the button that opens the modal
// var btn = document.getElementById("myBtn");
// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];
// // When the user clicks on the button, open the modal
// btn.onclick = function() {
//     modal.style.display = "block";
// }
// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//     modal.style.display = "none";
// }
// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// }

$(document).ready(function(){

  $('.message_delete_btn').each(function(){
    var del = this;
    var delete_status_id = del.id;

    var span = $(".close_"+delete_status_id)[0];
    var modal = $('#myModal_'+delete_status_id);

    $(del).click(function(){
      modal.css('display', 'block');


      $('.del_this_message_'+delete_status_id).click(function(){
        alert(delete_status_id);
      });

      return false;
    });

    $(span).click(function(){
      modal.css('display', 'none');
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
        url : "/welcome/ajax/message/personal_msg.php",
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

}); //end
