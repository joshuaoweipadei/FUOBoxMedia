//MAIN MENU BAR FOR BIGGER SCREENS
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
/*THE FIRST HEADER MENU WITH DROPDOWN LIST*/
function headerMenu1() {
    document.getElementById("menuDropdown").classList.toggle("show");
// Close the dropdown if the user clicks outside of it
  window.onclick = function(e) {
    if (!e.target.matches('.dropMenuBtn')) {

      var dropdowns = document.getElementsByClassName("dropmenu-content");
      for (var d = 0; d < dropdowns.length; d++) {
        var openDropdown = dropdowns[d];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
}
/*THE SECOND HEADER MENU WITH DROPDOWN LIST*/
function headerMenu2() {
    document.getElementById("menuDropdown2").classList.toggle("show");
// Close the dropdown if the user clicks outside of it
  window.onclick = function(e) {
    if (!e.target.matches('.dropMenuBtn2')) {

      var dropdowns = document.getElementsByClassName("dropmenu-content2");
      for (var d = 0; d < dropdowns.length; d++) {
        var openDropdown = dropdowns[d];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
}


//MENU BAR FOR SMALLER SCREENS
//MENU BAR FOR SMALLER SCREENS
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function menu() {
    document.getElementById("dropdown").classList.toggle("show");

  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbutton')) {

      var dropdowns = document.getElementsByClassName("menuList");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');

        }
      }
    }
  }
}
//END OF HEADER MENU



/******FACULTY DROPDOWN BUTTONS ONE******/
// When the user clicks on the button, toggle between hiding and showing the dropdown content
function faculties1() {
    document.getElementById("dropdown1").classList.toggle("show");

    // Close the dropdown menu if the user ckicks outside of it
    window.onclick = function(event){
        if(!event.target.matches('.faculty_btn1')){

            var dropdowns = document.getElementsByClassName("dropdown_content1");
            var i;
            for(i = 0; i < dropdowns.length; i++){
                var opendropdown = dropdowns[i];
                if(opendropdown.classList.contains('show')){
                    opendropdown.classList.remove('show');
                }
            }
        }
    }
}//--Ends--

/******FACULTY DROPDOWN BUTTONS TWO******/
// When the user clicks on the button, toggle between hiding and showing the dropdown content
function faculties2() {
    document.getElementById("dropdown2").classList.toggle("show");

    // Close the dropdown menu if the user ckicks outside of it
    window.onclick = function(event){
        if(!event.target.matches('.faculty_btn2')){

            var dropdowns = document.getElementsByClassName("dropdown_content2");
            var i;
            for(i = 0; i < dropdowns.length; i++){
                var opendropdown = dropdowns[i];
                if(opendropdown.classList.contains('show')){
                    opendropdown.classList.remove('show');
                }
            }
        }
    }
}//--Ends--

/******FACULTY DROPDOWN BUTTONS THREE******/
// When the user clicks on the button, toggle between hiding and showing the dropdown content
function faculties3() {
    document.getElementById("dropdown3").classList.toggle("show");

    // Close the dropdown menu if the user ckicks outside of it
    window.onclick = function(event){
        if(!event.target.matches('.faculty_btn3')){

            var dropdowns = document.getElementsByClassName("dropdown_content3");
            var i;
            for(i = 0; i < dropdowns.length; i++){
                var opendropdown = dropdowns[i];
                if(opendropdown.classList.contains('show')){
                    opendropdown.classList.remove('show');
                }
            }
        }
    }
}//--Ends--

/******FACULTY DROPDOWN BUTTONS FOUR******/
// When the user clicks on the button, toggle between hiding and showing the dropdown content
function faculties4() {
    document.getElementById("dropdown4").classList.toggle("show");

    // Close the dropdown menu if the user ckicks outside of it
    window.onclick = function(event){
        if(!event.target.matches('.faculty_btn4')){

            var dropdowns = document.getElementsByClassName("dropdown_content4");
            var i;
            for(i = 0; i < dropdowns.length; i++){
                var opendropdown = dropdowns[i];
                if(opendropdown.classList.contains('show')){
                    opendropdown.classList.remove('show');
                }
            }
        }
    }
}//--Ends--

/******FACULTY DROPDOWN BUTTONS FIVE******/
// When the user clicks on the button, toggle between hiding and showing the dropdown content
function faculties5() {
    document.getElementById("dropdown5").classList.toggle("show");

// Close the dropdown menu if the user ckicks outside of it
    window.onclick = function(event){
        if(!event.target.matches('.faculty_btn5')){

            var dropdowns = document.getElementsByClassName("dropdown_content5");
            var i;
            for(i = 0; i < dropdowns.length; i++){
                var opendropdown = dropdowns[i];
                if(opendropdown.classList.contains('show')){
                    opendropdown.classList.remove('show');
                }
            }
        }
    }
}//--Ends--
